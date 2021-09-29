<?php

use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

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

  <!-- ?= $form->field($model, 'text')->textarea(['rows' => 6, 'decode' => true]) ? -->
  <?= $form->field($model, 'text')->widget(Widget::className(), [
    'settings' => [
      'lang' => 'ru',
      'minHeight' => 200,
      'plugins' => [
        'clips',
        'fullscreen',
      ],
      'clips' => [
        ['Lorem ipsum...', 'Lorem...'],
        ['red', '<span class="label-red">red</span>'],
        ['green', '<span class="label-green">green</span>'],
        ['blue', '<span class="label-blue">blue</span>'],
      ],
    ],
  ]) ?>

  <?= $form->field($model, 'lang')->textInput(['maxlength' => true]) ?>

  <div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>