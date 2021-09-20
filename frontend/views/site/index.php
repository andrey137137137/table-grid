<?php

/* @var $this yii\web\View */

use frontend\Reasanik;

$this->title = 'home';
?>
<article id="post-<?= $this->title ?>" class="post-<?= $this->title ?> page type-page status-publish hentry">
  <header class="entry-header">
    <h1 class="entry-title"><?= Reasanik::getEncodeTrans('main', 'Главная') ?></h1>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <p>Выступая связующим звеном между судовладельцем и моряком мы уделяем огромное внимание подбору и поиску моряков для того чтобы удовлетворить требования наших судовладельцев и в то же время всегда принимаем во внимание (учитываем) пожелания и интересы моряков.</p>
    <p>Нашей компанией производится тщательный отбор моряков, потенциальные резюме и характеристики внимательно изучаются для определения опыта, профессиональной пригодности и знания английского языка перед трудоустройством.</p>
  </div><!-- .entry-content -->

</article><!-- #post-<?= $this->title ?> -->