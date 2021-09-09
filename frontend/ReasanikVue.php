<?php

namespace frontend;

use yii\helpers\Html;

class ReasanikVue
{
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
