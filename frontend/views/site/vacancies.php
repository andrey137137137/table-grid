<?php

/* @var $this yii\web\View */

// use yii\grid\GridView;
// use kartik\grid\GridView;

$this->title = 'Vacancies';
$this->params['breadcrumbs'][] = $this->title;

$firstRowSpanCounter = 0;
$secondRowSpanCounter = 0;

function getValidCounter($counter)
{
  $counter--;
  return $counter > 0 ? $counter : 0;
}

function decCounter($isFirstLevel = true)
{
  global $firstRowSpanCounter, $secondRowSpanCounter;

  $counter = $isFirstLevel
    ? $firstRowSpanCounter
    : $secondRowSpanCounter;

  if ($isFirstLevel) {
    $firstRowSpanCounter = getValidCounter($counter);
  } else {
    $secondRowSpanCounter = getValidCounter($counter);
  }
}

function rsRenderRowspanTd($items, $field, $isFirstLevel = true)
{
  global $firstRowSpanCounter, $secondRowSpanCounter;

  if ($isFirstLevel && $firstRowSpanCounter) {
    return;
  }

  if ($secondRowSpanCounter) {
    return;
  }

  $itemsCount = count($items);

  if ($isFirstLevel) {
    foreach ($items as $subItems) {
      $subItemsCount = count($subItems);

      if ($subItemsCount > $itemsCount) {
        $itemsCount = $subItemsCount;
      }
      break;
    }
  }

  if ($itemsCount == 1) : ?>

    <td> <?= $field ?> </td>

  <?php
    return;
  endif;

  if ($isFirstLevel) {
    $firstRowSpanCounter = $itemsCount;
  } else {
    $secondRowSpanCounter = $itemsCount;
  }
  ?>

  <td rowspan="<?= $itemsCount ?>">
    <?= $field ?>
  </td>

<?php
}

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
        <?php foreach ($vacancies as $rankId => $topItems) : ?>
          <tr>
            <?php rsRenderRowspanTd($topItems, $rankId);

            foreach ($topItems as $vesselId => $bottomItems) :
              rsRenderRowspanTd($bottomItems, $vesselId, false);

              foreach ($bottomItems as $buildYear => $items) : ?>
                <td><?= $buildYear ?></td>

                <?php foreach ($items as $attr => $field) :
                  if ($attr == 'id' || $attr == 'rank' || $attr == 'vessel_type' || $attr == 'build_year') :
                    continue;
                  endif; ?>
                  <td><?= $attr ?>: <?= $field ?></td>
            <?php endforeach;

              endforeach;

              decCounter(false);
            endforeach; ?>

          </tr>
        <?php decCounter();
        endforeach; ?>
      </tbody>
    </table>
  </div><!-- .entry-content -->

</article><!-- #post-<?= $this->title ?> -->