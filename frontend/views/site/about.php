<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
// <code>?= __FILE__ ?</code>
?>
<article id="post-<?= $this->title ?>" class="post-<?= $this->title ?> page type-page status-publish hentry">
    <header class="entry-header">
        <h1 class="entry-title"><?= Html::encode($this->title) ?></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <p>This is the About page. You may modify the following file to customize its content:</p>
    </div><!-- .entry-content -->

</article><!-- #post-<?= $this->title ?> -->