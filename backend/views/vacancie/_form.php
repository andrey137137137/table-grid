<?php

use backend\ReasanikVue;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Vacancie */
/* @var $lists lists of id from other common\models */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="minmaxForm" class="vacancie-form">

  <?php $form = ActiveForm::begin(); ?>

  <!-- ?= $form->field($model, 'rank')->textInput() ? -->
  <?= $form->field($model, 'rank')->dropDownList($lists['VacancieRank']) ?>

  <?= $form->field($model, 'vessel_type')->dropDownList($lists['VesselType']) ?>

  <!-- ?= $form->field($model, 'build_year')->textInput(['maxlength' => true]) ? -->
  <?php
  ReasanikVue::renderMinMax($form, $model, 'build_year');
  ReasanikVue::renderMinMax($form, $model, 'dwt');
  ReasanikVue::renderMinMax($form, $model, 'contract_duration', 'months');
  ReasanikVue::renderMinMax(
    $form,
    $model,
    'salary',
    [
      'default' => 'USD',
      'vModel' => 'currency',
      'list' => ['USD' => 'USD', 'EURO' => 'EURO']
    ]
  );
  ?>

  <?= $form->field($model, 'ambarcation_date')->textInput(['maxlength' => true]) ?>

  <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>