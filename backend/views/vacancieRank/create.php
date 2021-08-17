<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VacancieRank */

$this->title = 'Create Vacancie Rank';
$this->params['breadcrumbs'][] = ['label' => 'Vacancie Ranks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacancie-rank-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
