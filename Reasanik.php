<?php

class Reasanik
{
  public static $defaultRoute = 'site/index';
  public static $defaultController = 'site/<action>';

  public static $galleryPath = '/img/gallery/';
  public static $imageExtensions = ['gif', 'jpg', 'jpeg', 'png'];

  private $_patterns = [
    'ctrlAction' => '(\w|-)+',
    'vacanciesAction' => '<action:vacancies>',
    'vacancieFirst' => '<first:-?\w+>',
    'vacancieSecond' => '<second:\w+>',
    'vacancieSort' => '<sort:-?>',
  ];

  public function __get($prop)
  {
    $propPostfix = 'Ptrn';
    switch ($prop) {
      case 'action' . $propPostfix:
        return '<action:' . $this->_patterns['ctrlAction'] . '>';
      default:
        return $this->_patterns[str_replace($propPostfix, '', $prop)];
    }
  }
}
