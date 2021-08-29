<?php

use frontend\ReasanikVue;

/* @var $this yii\web\View */

// use yii\grid\GridView;
// use kartik\grid\GridView;

$this->title = 'Vacancies';
$this->params['breadcrumbs'][] = $this->title;
ReasanikVue::$counters = $counters;

?>
<article id="post-<?= $this->title ?>" class="post-<?= $this->title ?> page type-page status-publish hentry">
  <header class="entry-header">
    <h1 class="entry-title">ВАКАНСИИ</h1>
  </header><!-- .entry-header -->

  <div class="entry-content">
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
    <?= var_dump(ReasanikVue::$counters) ?>
    <table class="table table-striped table-bordered" border="1">
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
        ?>
              </tr>
        <?php
            endforeach;

            ReasanikVue::decCounter(false);
          endforeach;

          ReasanikVue::decCounter();
        endforeach;
        ?>
      </tbody>
    </table>
  </div><!-- .entry-content -->

</article><!-- #post-<?= $this->title ?> -->