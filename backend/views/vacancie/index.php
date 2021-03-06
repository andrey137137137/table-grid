<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vacancies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancie-index">

  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <?= Html::a('Create Vacancie', ['create'], ['class' => 'btn btn-success']) ?>
  </p>

  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
      ['class' => 'yii\grid\SerialColumn'],

      'id',
      ['attribute' => 'rank.name', 'label' => 'Rank'],
      ['attribute' => 'vesselType.name', 'label' => 'Type of Vessel'],
      'build_year',
      'dwt',
      'contract_duration',
      'ambarcation_date',
      'salary',

      ['class' => 'yii\grid\ActionColumn'],
    ],
  ]); ?>

</div>