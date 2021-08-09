<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Menu;
// <html lang="?= Yii::$app->language ?" class="js svg background-fixed">

AppAsset::register($this);

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
      <div class="custom-header">
        <div class="custom-header-media"></div>

        <div class="site-branding">
          <div class="wrap">

            <div class="site-branding-text">
              <?php if (Yii::$app->request->url == Yii::$app->homeUrl) : ?>
                <h1 class="site-title"><a href="<?php echo Url::to([Yii::$app->homeUrl]); ?>" rel="home">Elena</a></h1>
              <?php else : ?>
                <p class="site-title"><a href="<?php echo Url::to([Yii::$app->homeUrl]); ?>" rel="home">Elena</a></p>
              <?php endif; ?>

              <p class="site-description">CREW Odessa</p>
            </div><!-- .site-branding-text -->
          </div><!-- .wrap -->
        </div><!-- .site-branding -->
      </div><!-- .custom-header -->

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
              $menuItems = [
                ['label' => 'Home', 'url' => [Yii::$app->homeUrl]],
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

              echo Menu::widget([
                'items' => $menuItems,
                'options' => ['id' => 'top-menu', 'class' => 'menu'],
                'itemOptions' => ['class' => 'menu-item menu-item-type-custom menu-item-object-custom'],
                'labelTemplate' => '<a aria-current="page" href="{url}">{label}</a>',
                'activeCssClass' => 'current-menu-item current_page_item'
              ]);
              ?>
            </div><!-- .menu-main-container -->
          </nav><!-- #site-navigation -->
        </div><!-- .wrap -->
      </div><!-- .navigation-top -->
    </header><!-- #masthead -->

    <div class="site-content-contain">
      <div id="content" class="site-content">
        <div class="wrap">
          <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
              <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
              ]) ?>
              <?= Alert::widget() ?>
              <?= $content ?>
            </main><!-- #main -->
          </div><!-- #primary -->
        </div><!-- .wrap -->
      </div><!-- #content -->

      <footer id="colophon" class="site-footer" role="contentinfo">
        <div class="wrap">
          <nav class="social-navigation" role="navigation" aria-label="Footer Social Links Menu">
            <div class="menu-socials-container">
              <?php
              $socialItems = [
                ['label' => '', 'url' => ['']],
                ['label' => '', 'url' => ['']],
                ['label' => '', 'url' => ['']],
                ['label' => '', 'url' => ['']],
                ['label' => '', 'url' => ['']],
              ];
              echo Menu::widget([
                'items' => $socialItems,
                'options' => ['id' => 'social', 'class' => 'social-links-menu'],
                'itemOptions' => ['class' => 'menu-item menu-item-type-custom menu-item-object-custom'],
              ]);
              ?>
            </div>
          </nav><!-- .social-navigation -->

          <div class="site-info">
            <a href="" class="imprint"><?= Yii::powered() ?></a>
          </div><!-- .site-info -->

        </div><!-- .wrap -->
      </footer><!-- #colophon -->
    </div><!-- .site-content-contain -->
  </div><!-- #page -->

  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>