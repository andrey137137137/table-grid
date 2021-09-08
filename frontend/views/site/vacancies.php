<?php

use frontend\ReasanikVue;

/* @var $this yii\web\View */

// use yii\grid\GridView;
// use kartik\grid\GridView;

$this->title = 'Vacancies';
$this->params['breadcrumbs'][] = $this->title;
ReasanikVue::$firstColumn = $firstColumn;
ReasanikVue::$secondColumn = $secondColumn;
ReasanikVue::$counters = $counters;

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

    <?php foreach (ReasanikVue::$counters as $rsCounterId => $rsCounter) { ?>
      <b><?= $rsCounterId ?></b> = <?= $rsCounter ?><br />
    <?php } ?>

    <br />

    <!-- <div class="grid-view"> -->
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Rank</th>
          <th>Type of Vessel </th>
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
          ReasanikVue::renderRowSpanTd($rankId);

          foreach ($topItems as $vesselTypeId => $bottomItems) :
            ReasanikVue::renderRowSpanTd($rankId . '_' . $vesselTypeId, $vesselTypeId, false);

            foreach ($bottomItems as $buildYear => $items) :
              ReasanikVue::renderThirdTd($buildYear);

              foreach ($items as $attr => $field) :
                ReasanikVue::renderTd($attr, $field);
              endforeach;

              ReasanikVue::renderCloseTr();
            endforeach;

            ReasanikVue::decCounter();
          endforeach;
        endforeach;
        ?>
      </tbody>
    </table>
    <!-- </div> -->
  </div><!-- .entry-content -->

</article><!-- #post-<?= $this->title ?> -->