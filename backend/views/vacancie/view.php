<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Vacancie */

$this->title = $model->rank->name . ' - ' . $model->salary;
$this->params['breadcrumbs'][] = ['label' => 'Vacancies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="vacancie-view">

  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
      'class' => 'btn btn-danger',
      'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
      ],
    ]) ?>
  </p>

  <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
      'id',
      // ['attribute' => 'rank.name', 'label' => 'Rank'],
      ['attribute' => 'vesselType.name', 'label' => 'Type of Vessel'],
      'build_year',
      'dwt',
      'contract_duration',
      'ambarcation_date',
      'salary',
    ],
  ]) ?>

</div>