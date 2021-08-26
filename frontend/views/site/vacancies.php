<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Vacancies';
$this->params['breadcrumbs'][] = $this->title;
?>
<article id="post-<?= $this->title ?>" class="post-<?= $this->title ?> page type-page status-publish hentry">
  <header class="entry-header">
    <h1 class="entry-title">ВАКАНСИИ</h1>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?= GridView::widget([
      'dataProvider' => $dataProvider,
      'columns' => [
        'vacancieRank.name',
        'vesselType.name',
        'build_year',
        'dwt',
        'contract_duration',
        'ambarcation_date',
        'salary',
      ],
    ]); ?>
  </div><!-- .entry-content -->

</article><!-- #post-<?= $this->title ?> -->