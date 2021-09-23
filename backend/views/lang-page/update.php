<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LangPage */

$this->title = Yii::t('app', 'Update Lang Page: {name}', [
  'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lang Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="lang-page-update">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= $this->render('_form', [
    'model' => $model,
    'lists' => $lists,
  ]) ?>

</div>