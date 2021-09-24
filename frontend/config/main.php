<?php
$params = array_merge(
  require(__DIR__ . '/../../common/config/params.php'),
  require(__DIR__ . '/../../common/config/params-local.php'),
  require(__DIR__ . '/params.php'),
  require(__DIR__ . '/params-local.php')
);

$Rs = new Reasanik;

return [
  'sourceLanguage' => 'ru', // использован в качестве ключей переводов
  'id' => 'app-frontend',
  'basePath' => dirname(__DIR__),
  'homeUrl' => '/',
  'controllerNamespace' => 'frontend\controllers',
  'bootstrap' => [
    'log',
    'languages'
  ],
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
        // 'app' => [
        '*' => [
          'class' => 'yii\i18n\PhpMessageSource',
          //'forceTranslation' => true,
          'basePath' => '@frontend/messages',
          // 'fileMap' => [
          //   'app' => 'app.php',
          //   'app/hjghjghj' => 'main.php',
          //   'app/error' => 'error.php',
          // ],
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
      'class' => 'common\components\UrlManager',
      'rules' => [
        //для модуля мультиязычности
        'languages' => 'languages/default/index',
        //далее создаем обычные правила
        $Rs->vacanciesActionPtrn . '/'
          . $Rs->vacancieFirstPtrn . '/'
          . $Rs->vacancieSecondPtrn . '/'
          . $Rs->vacancieSortPtrn => Reasanik::$defaultController,
        $Rs->vacanciesActionPtrn . '/'
          . $Rs->vacancieFirstPtrn . '/'
          . $Rs->vacancieSecondPtrn => Reasanik::$defaultController,
        $Rs->actionPtrn => Reasanik::$defaultController,
      ],
    ],
  ],
  'params' => $params,
];
