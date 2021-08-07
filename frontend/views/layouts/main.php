<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
// use yii\bootstrap\Nav;
// use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Menu;
// <html lang="?= Yii::$app->language ?" class="js svg background-fixed">

AppAsset::register($this);

// 'brandLabel' => Yii::$app->name,
// 'brandUrl' => Yii::$app->homeUrl,

$menuItems = [
  ['label' => 'Home', 'url' => ['/site/index']],
  ['label' => 'About', 'url' => ['/site/about']],
  ['label' => 'Contact', 'url' => ['/site/contact']],
];

if (Yii::$app->user->isGuest) {
  $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
  $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
  $menuItems[] = '<li>'
    . Html::beginForm(['/site/logout'], 'post')
    . Html::submitButton(
      'Logout (' . Yii::$app->user->identity->username . ')',
      ['class' => 'btn btn-link logout']
    )
    . Html::endForm()
    . '</li>';
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru-RU" class="js svg background-fixed">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>

<body class="home page-template-default page page-id-8 wp-embed-responsive twentyseventeen-front-page has-header-image page-two-column colors-light">
  <?php $this->beginBody() ?>

  <div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

    <header id="masthead" class="site-header" role="banner">

      <div class="navigation-top">
        <div class="wrap">
          <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Top Menu">
            <button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
              <?php for ($i = 0; $i < 3; $i++) : ?>
                <span></span>
              <?php endfor; ?>
            </button>
            <div class="menu-main-container">
              <?php
              echo Menu::widget([
                'items' => $menuItems,
                'options' => ['id' => 'main-menu', 'class' => 'menu'],
              ]);
              ?>
              <ul id="top-menu" class="menu">
                <?php

                foreach ($menuItems as $i => $item) :
                  $curClasses = !$i ? 'current-menu-item current_page_item' : '';
                  $curPage = !$i ? 'aria-current="page"' : '';

                  if (isset($item['label'])) : ?>
                    <li id="menu-item-<?= $i + 1 ?>" class="menu-item menu-item-type-custom menu-item-object-custom <?= !$i ? 'current-menu-item current_page_item' : '' ?> menu-item-<?= $i + 1 ?>">
                      <a href="<?= $item['url'][0] ?>" <?= !$i ? 'aria-current="page"' : '' ?>>
                        <?= $item['label'] ?>
                      </a>
                    </li>
                <?php else :
                    echo $item;
                  endif;
                endforeach; ?>

              </ul><!-- #top-menu -->
            </div><!-- menu-main-container -->
          </nav><!-- #site-navigation -->
        </div><!-- .wrap -->
      </div><!-- .navigation-top -->
    </header><!-- #masthead -->

    <div class=" site-content-contain">
      <div id="content" class="site-content">
        <div id="primary" class="content-area">
          <main id="main" class="site-main" role="main">
            <?= Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
          </main><!-- #main -->
        </div><!-- #primary -->
      </div><!-- #content -->

      <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="wrap">
          <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

          <p class="pull-right"><?= Yii::powered() ?></p>
        </div><!-- .wrap -->
      </footer><!-- #colophon -->
    </div><!-- .site-content-contain -->
  </div><!-- #page -->

  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>