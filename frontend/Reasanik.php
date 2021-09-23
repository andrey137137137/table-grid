<?php

namespace frontend;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class Reasanik
{
  public static $actionParams = [];
  public static $firstColumn = [];
  public static $secondColumn = [];
  public static $counters = [];

  private static $_isEven = false;
  private static $_firstColumnKey = '';
  private static $_secondColumnKey = '';
  private static $_firstColumnCounter = 0;
  private static $_secondColumnCounter = 0;
  private static $_openTd = '<td align="center">';
  private static $_closeTd = '</td>';
  private static $_actionTitle = '';

  public static function getEncodeTrans($category, $message, $params = [], $language = null)
  {
    return Html::encode(\Yii::t($category, $message, $params, $language));
  }

  public static function renderActionLink($to, $isFirstColumn = true)
  {
    $url = self::_getActionUrl($to, $isFirstColumn);
    echo Html::beginTag('a', ['href' => Url::to($url)])
      . self::_getActionTitle()
      . Html::endTag('a');

    if (!$isFirstColumn) {
      $options = [];

      if (self::_isDescSorted()) {
        $options['style'] = 'transform: rotate(180deg)';
      }

      $url = self::_getActionUrl($to, false, true);
      echo Html::a('^', $url, $options);
    }
  }

  private static function _isDescSorted()
  {
    return self::$actionParams['sort'] == '-';
  }

  private static function _getActionUrl($to, $isFirstColumn, $isSortColumn = false)
  {
    $filterParams = self::_filterActionParams($isFirstColumn, $isSortColumn);
    $addParams = [];

    if (!$isSortColumn) {
      self::$_actionTitle = $filterParams['first'];
    }

    if (($isFirstColumn && self::_isDescSorted())
      || ($isSortColumn && !self::_isDescSorted())
    ) {
      $addParams['sort'] = '-';
    }

    return ArrayHelper::merge([$to], $filterParams, $addParams);
  }

  private static function _filterActionParams($isFirstColumn, $isSortColumn)
  {
    $cond = $isFirstColumn || $isSortColumn;
    $firstKey = 'first';
    $secondKey = 'second';
    $firstValue = self::$actionParams[$cond ? $firstKey : $secondKey];

    if ($isSortColumn) {
      $firstCompValue = $firstValue;
    } elseif ($isFirstColumn) {
      $firstCompValue = self::_getInverseAction($firstValue);
    } else {
      $firstCompValue = self::clearMinus($firstValue);
    }

    $secondCompKey = $cond ? $secondKey : $firstKey;

    return [
      $firstKey => $firstCompValue,
      $secondKey => self::clearMinus(self::$actionParams[$secondCompKey]),
    ];
  }

  private static function _getInverseAction($attr)
  {
    return self::withMinus($attr) ? self::removeMinus($attr) : self::addMinus($attr);
  }

  private static function _getActionTitle()
  {
    return strpos(self::$_actionTitle, 'rank') !== false ? 'Rank' : 'Type of Vessel';
  }

  public static function withMinus($attr)
  {
    return strpos($attr, '-') === 0;
  }

  public static function addMinus($attr)
  {
    return '-' . $attr;
  }

  public static function removeMinus($attr)
  {
    return substr_replace($attr, '', 0, 1);
  }

  public static function clearMinus($attr)
  {
    return self::withMinus($attr) ? self::removeMinus($attr) : $attr;
  }

  public static function renderRowSpanTd($key, $value = false, $isFirstColumn = true)
  {
    if ($isFirstColumn && self::$_firstColumnCounter) {
      return;
    }

    if (self::$_secondColumnCounter) {
      return;
    }

    if ($isFirstColumn) {
      self::$_firstColumnKey = $key;
    } else {
      self::$_secondColumnKey = $key;
    }

    $itemsCount = self::_getCount($key);
    $calcValue = $value === false ? $key : $value;

    if ($isFirstColumn) {
      self::$_firstColumnCounter = $itemsCount;
    } else {
      self::$_secondColumnCounter = $itemsCount;
    }

    echo self::_getRowSpanTd($calcValue, $itemsCount, $isFirstColumn);
  }

  public static function renderThirdTd($value)
  {
    echo self::_getOpenTr(false, self::$_secondColumnKey)
      . self::$_openTd
      . Html::encode($value)
      . self::$_closeTd;
  }

  public static function renderTd($key, $value)
  {
    switch ($key) {
      case 'id':
      case 'rank_id':
      case 'vessel_type_id':
      case 'build_year':
        return;
    }

    if ($key != 'salary') {
      echo self::$_openTd . Html::encode($value) . self::$_closeTd;
    } else {
      echo self::$_openTd . 'counter <br />'
        . Html::encode(self::$_firstColumnCounter)
        . ' - '
        . Html::encode(self::$_secondColumnCounter)
        . self::$_closeTd;
    }
  }

  public static function renderCloseTr()
  {
    echo '</tr>';
  }

  public static function decCounter()
  {
    self::$_firstColumnCounter = self::_getValidDecCounter(
      self::$_firstColumnCounter
    );
    self::$_secondColumnCounter = self::_getValidDecCounter(
      self::$_secondColumnCounter
    );

    if (!self::$_firstColumnCounter) {
      self::$_isEven = !self::$_isEven;
    }
  }

  private static function _getRowSpanTd($value, $rowSpan, $isFirstColumn)
  {
    return self::_getOpenTr($isFirstColumn)
      . '<td align="center"'
      . ($rowSpan > 1 ? ' rowspan="' . Html::encode($rowSpan) . '"' : '')
      . '>'
      . Html::encode($isFirstColumn
        ? self::$firstColumn[$value]
        : self::$secondColumn[$value])
      . self::$_closeTd;
  }

  private static function _getOpenTr($isFirstColumn, $key = '')
  {
    $openTr = '<tr' . (!self::$_isEven ? ' style="background: #f9f9f9"' : '') . '>';

    if ($isFirstColumn) {
      return $openTr;
    }

    $counter = !$key ? self::$_firstColumnCounter : self::$_secondColumnCounter;

    if (self::_getCount($key) > $counter) {
      return $openTr;
    }

    return '';
  }

  private static function _getCount($key = '')
  {
    $calcKey = !$key ? self::$_firstColumnKey : $key;
    return isset(self::$counters[$calcKey]) ? self::$counters[$calcKey] : 1;
  }

  private static function _getValidDecCounter($counter)
  {
    $counter--;
    return $counter > 0 ? $counter : 0;
  }
}
