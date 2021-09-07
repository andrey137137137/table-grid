<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    // 'css/colors-dark.css',
    // 'css/editor-blocks.css',
    // 'css/editor-style.css',
    'css/site.css',
    'css/blocks.css',
  ];
  public $js = [
    'js/customize-controls.js',
    'js/customize-preview.js',
    'js/global.js',
    // 'js/html5.js',
    'js/jquery.scrollTo.js',
    'js/navigation.js',
    'js/skip-link-focus-fix.js',
  ];
  // public $depends = [
  //   'yii\web\YiiAsset',
  //   'yii\bootstrap\BootstrapAsset',
  // ];
}
