<?php

namespace frontend;

class ReasanikVue
{
  public static $counters = [];

  private static $_topKey = '';
  private static $_bottomKey = '';
  private static $_firstRowSpanCounter = 0;
  private static $_secondRowSpanCounter = 0;
  private static $_openTd = '<td align="center">';

  public static function renderRowSpanTd($key, $value = false, $isFirstLevel = true)
  {
    if ($isFirstLevel && self::$_firstRowSpanCounter) {
      return;
    }

    if (self::$_secondRowSpanCounter) {
      return;
    }

    if ($isFirstLevel) {
      self::$_topKey = $key;
    } else {
      self::$_bottomKey = $key;
    }

    $itemsCount = self::_getCount($key);

    if ($isFirstLevel) {
      self::$_firstRowSpanCounter = $itemsCount;
    } else {
      self::$_secondRowSpanCounter = $itemsCount;
    }

    $calcValue = $value === false ? $key : $value;

    echo self::_getRowSpanTd($calcValue, $itemsCount, $isFirstLevel);
  }

  public static function renderThirdTd($value)
  {
    echo self::_getOpenTr(false, self::$_bottomKey) . self::$_openTd . $value . '</td>';
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

    echo self::$_openTd . $key . ': ' . $value . '</td>';
  }

  public static function decCounter($isFirstLevel = true)
  {
    $counter = $isFirstLevel
      ? self::$_firstRowSpanCounter
      : self::$_secondRowSpanCounter;

    if ($isFirstLevel) {
      self::$_firstRowSpanCounter = self::_getValidCounter($counter);
    } else {
      self::$_secondRowSpanCounter = self::_getValidCounter($counter);
    }
  }

  private static function _getRowSpanTd($value, $rowSpan, $isFirstLevel)
  {
    return self::_getOpenTr($isFirstLevel)
      . '<td align="center"' . ($rowSpan > 1 ? ' rowspan="' . $rowSpan . '"' : '') . '>'
      . $value
      . '</td>';
  }

  private static function _getOpenTr($isFirstLevel, $key = '')
  {
    $openTr = '<tr>';

    if ($isFirstLevel) {
      return $openTr;
    }

    $counter = !$key ? self::$_firstRowSpanCounter : self::$_secondRowSpanCounter;

    if (self::_getCount($key) > $counter) {
      return $openTr;
    }
  }

  private static function _getCount($key = '')
  {
    $calcKey = !$key ? self::$_topKey : $key;
    return isset(self::$counters[$calcKey]) ? self::$counters[$calcKey] : 1;
  }

  private static function _getValidCounter($counter)
  {
    $counter--;
    return $counter > 0 ? $counter : 0;
  }
}
