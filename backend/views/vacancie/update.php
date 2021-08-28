<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Vacancie */

$title = $model->rank->name . ' - ' . $model->salary;
$this->title = 'Update Vacancie: ' . $title;
$this->params['breadcrumbs'][] = ['label' => 'Vacancies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vacancie-update">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= $this->render('_form', [
    'model' => $model,
    'lists' => $lists,
  ]) ?>

</div>