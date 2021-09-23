<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LangPage */

$this->title = Yii::t('app', 'Create Lang Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lang Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lang-page-create">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= $this->render('_form', [
    'model' => $model,
    'lists' => $lists,
  ]) ?>

</div>