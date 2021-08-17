<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Vacancie */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vacancie-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rank')->textInput() ?>

    <?= $form->field($model, 'vessel_type')->textInput() ?>

    <?= $form->field($model, 'build_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dwt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contract_duration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ambarcation_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
