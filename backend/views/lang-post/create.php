<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LangPost */

$this->title = Yii::t('app', 'Create Lang Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lang Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lang-post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
