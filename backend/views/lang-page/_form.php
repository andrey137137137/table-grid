<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LangPage */
/* @var $lists lists of id from other common\models */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lang-page-form">

  <?php $form = ActiveForm::begin(); ?>

  <!-- ?= $form->field($model, 'page_id')->textInput() ? -->
  <?= $form->field($model, 'page_id')->dropDownList($lists['Page']) ?>

  <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

  <?= $form->field($model, 'lang')->textInput(['maxlength' => true]) ?>

  <div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>