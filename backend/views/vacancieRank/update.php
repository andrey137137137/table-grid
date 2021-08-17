<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VacancieRank */

$this->title = 'Update Vacancie Rank: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Vacancie Ranks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vacancie-rank-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
