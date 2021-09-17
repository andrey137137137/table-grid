<?php

/* @var $this yii\web\View */

use frontend\Reasanik;

// use yii\grid\GridView;
// use kartik\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Json;

$this->title = 'Vacancies';
$this->params['breadcrumbs'][] = $this->title;

Reasanik::$firstColumn = $firstColumn;
Reasanik::$secondColumn = $secondColumn;
Reasanik::$counters = $counters;

?>
<article id="post-<?= $this->title ?>" class="post-<?= $this->title ?> page type-page status-publish hentry">
  <!-- <header class="entry-header"> -->
  <!-- <h1 class="entry-title">ВАКАНСИИ</h1> -->
  <!-- </header>.entry-header -->

  <div class="entry-content" style="float: none">
    <!-- ?= GridView::widget([
      'dataProvider' => $dataProvider,
      'columns' => [
        [
          'attribute' => 'vacancieRank.name',
          'label' => 'Rank'
        ],
        [
          'attribute' => 'vesselType.name',
          'label' => 'Type of Vessel'
        ],
        'build_year',
        'dwt',
        'contract_duration',
        'ambarcation_date',
        'salary',
      ],
      'showPageSummary' => false
    ]); ? -->

    <?php foreach (Reasanik::$counters as $rsCounterId => $rsCounter) { ?>
      <b><?= $rsCounterId ?></b> = <?= $rsCounter ?><br />
    <?php }
    var_dump($this->context->actionParams);
    $actionParams = $this->context->actionParams;
    ?>

    <br />

    <div class="grid-view">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>
              <?php Reasanik::renderActionLink(['site/vacancies'], $actionParams); ?>
            </th>
            <th>
              <?php Reasanik::renderActionLink(['site/vacancies'], $actionParams, false); ?>
            </th>
            <th>Build Year</th>
            <th>Dwt</th>
            <th>Contract Duration</th>
            <th>Ambarcation Date</th>
            <th>Salary</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($vacancies as $rankId => $topItems) :
            Reasanik::renderRowSpanTd($rankId);

            foreach ($topItems as $vesselTypeId => $bottomItems) :
              Reasanik::renderRowSpanTd($rankId . '_' . $vesselTypeId, $vesselTypeId, false);

              foreach ($bottomItems as $buildYear => $items) :
                Reasanik::renderThirdTd($buildYear);

                foreach ($items as $attr => $field) :
                  Reasanik::renderTd($attr, $field);
                endforeach;

                Reasanik::renderCloseTr();
              endforeach;

              Reasanik::decCounter();
            endforeach;
          endforeach;
          ?>
        </tbody>
      </table>
    </div>
  </div><!-- .entry-content -->
  <script>
    console.log(JSON.parse('<?= Json::encode($vacancies) ?>'));
  </script>

</article><!-- #post-<?= $this->title ?> -->