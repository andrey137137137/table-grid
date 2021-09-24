<?php
return [
  'aliases' => [
    '@bower' => '@vendor/bower-asset',
    '@npm'   => '@vendor/npm-asset',
  ],
  'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
  'defaultRoute' => Reasanik::$defaultRoute,
  // 'modules' => [
  //   'gridview' =>  [
  //     'class' => '\kartik\grid\Module'
  //   ]
  // ],
  'components' => [
    'cache' => [
      'class' => 'yii\caching\FileCache',
    ],
    'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'enableStrictParsing' => false,
      'rules' => [
        '/' => Reasanik::$defaultRoute,
      ],
    ],
  ],
];
