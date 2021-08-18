<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VesselType */

$this->title = 'Create Vessel Type';
$this->params['breadcrumbs'][] = ['label' => 'Vessel Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vessel-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
