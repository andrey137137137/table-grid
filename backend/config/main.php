<?php
$params = array_merge(
  require(__DIR__ . '/../../common/config/params.php'),
  require(__DIR__ . '/../../common/config/params-local.php'),
  require(__DIR__ . '/params.php'),
  require(__DIR__ . '/params-local.php')
);

$Rs = new Reasanik;

return [
  'id' => 'app-backend',
  'basePath' => dirname(__DIR__),
  'homeUrl' => '/admin',
  'controllerNamespace' => 'backend\controllers',
  'bootstrap' => ['log'],
  'modules' => [
    'gridview' =>  [
      'class' => '\kartik\grid\Module'
    ]
  ],
  'components' => [
    'request' => [
      'csrfParam' => '_csrf-backend',
      'baseUrl' => '/admin',
    ],
    'user' => [
      'identityClass' => 'common\models\User',
      'enableAutoLogin' => true,
      'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
    ],
    'session' => [
      // this is the name of the session cookie used for login on the backend
      'name' => 'advanced-backend',
    ],
    'log' => [
      'traceLevel' => YII_DEBUG ? 3 : 0,
      'targets' => [
        [
          'class' => 'yii\log\FileTarget',
          'levels' => ['error', 'warning'],
        ],
      ],
    ],
    'errorHandler' => [
      'errorAction' => 'site/error',
    ],
    'urlManager' => [
      'rules' => [
        '<controller:' . $Rs->ctrlActionPtrn . '>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
        '<controller:' . $Rs->ctrlActionPtrn . '>/<id:\d+>' => '<controller>/view',
        '<controller:' . $Rs->ctrlActionPtrn . '>s' => '<controller>/index',
        $Rs->actionPtrn => Reasanik::$defaultController,
      ],
    ],
  ],
  'params' => $params,
];
