<?php
$params = array_merge(
  require(__DIR__ . '/../../common/config/params.php'),
  require(__DIR__ . '/../../common/config/params-local.php'),
  require(__DIR__ . '/params.php'),
  require(__DIR__ . '/params-local.php')
);

return [
  'id' => 'app-frontend',
  'basePath' => dirname(__DIR__),
  'homeUrl' => '/',
  'bootstrap' => [
    'log',
    'languages'
  ],
  'defaultRoute' => 'site/index',
  'controllerNamespace' => 'frontend\controllers',
  'modules' => [
    'languages' => [
      'class' => 'common\modules\languages\Module',
      //Языки используемые в приложении
      'languages' => [
        'English' => 'en',
        'Русский' => 'ru',
        'Українська' => 'uk',
      ],
      'default_language' => 'ru', //основной язык (по-умолчанию)
      'show_default' => false, //true - показывать в URL основной язык, false - нет
    ],
  ],
  'components' => [
    'i18n' => [
      'translations' => [
        'app' => [
          'class' => 'yii\i18n\PhpMessageSource',
          //'forceTranslation' => true,
          'basePath' => '@common/messages',
        ],
      ],
    ],
    'request' => [
      'csrfParam' => '_csrf-frontend',
      'baseUrl' => '', // убрать frontend/web
      'class' => 'common\components\Request'
    ],
    // 'assetManager' => [
    //     'bundles' => [
    //         'yii\bootstrap\BootstrapAsset' => [
    //             'css' => [],
    //         ],
    //         'yii\bootstrap\BootstrapPluginAsset' => [
    //             'js' => []
    //         ],
    //         'yii\web\JqueryAsset' => [
    //             'js' => []
    //         ],
    //     ],
    // ],
    'user' => [
      'identityClass' => 'common\models\User',
      'enableAutoLogin' => true,
      'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
    ],
    'session' => [
      // this is the name of the session cookie used for login on the frontend
      'name' => 'advanced-frontend',
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
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'class' => 'common\components\UrlManager',
      'rules' => [
        'languages' => 'languages/default/index', //для модуля мультиязычности
        //далее создаем обычные правила
        '/' => 'site/index',
        'contacts' => 'site/contact',
        '<action:(about|vacancies)>' => 'site/<action>',
      ],
    ],
  ],
  'params' => $params,
];
