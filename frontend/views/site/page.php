<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $lang_data->title;
?>
<article id="post-<?= $page->url ?>" class="post-<?= $page->url ?> page type-page status-publish hentry">
  <header class="entry-header">
    <h1 class="entry-title"><?= Html::decode($this->title) ?></h1>
  </header><!-- .entry-header -->
  <div class="entry-content">
    <?= Html::decode($lang_data->text) ?>
  </div><!-- .entry-content -->
</article><!-- #post-<?= $this->title ?> -->