<?php

namespace backend;

use yii\helpers\Html;

class ReasanikVue
{
  private static $marginLeft = 'margin-left: 10px';

  public static function beginFormRow()
  {
    return '<div class="form-group"><div class="row">';
  }

  public static function endFormRow()
  {
    return '</div></div>';
  }

  public static function beginFormGroup()
  {
    return '<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">';
  }

  public static function endFormGroup()
  {
    return '</div>';
  }

  public static function renderMinMax($form, $model, $name, $postfix = false, $min = 0, $max = false)
  {
    echo $form->field($model, $name)->textInput(['maxlength' => true, 'v-model' => $name]);

    echo '<div style="display: flex; align-items: center; justify-content: space-between">';
    self::_renderCounter(false, 'min_' . $name, $min);
    self::_renderCounter(true, 'max_' . $name, $min, $max);

    if ($postfix) {
      if (isset($postfix['list'])) {
        echo Html::dropDownList(
          $postfix['vModel'] . '_list',
          $postfix['default'],
          $postfix['list'],
          [
            'class' => 'form-control',
            'style' => self::$marginLeft,
            'v-model' => $postfix['vModel']
          ]
        );
      } else {
        echo '<span style="' . self::$marginLeft . '">' . $postfix . '</span>';
      }
    }

    echo '</div>';
  }

  private static function _renderCounter($isMax, $name, $min = 0, $max = false)
  {
    $labelOptions = [
      'class' => 'form-label'
    ];
    $inputOptions = [
      'class' => 'form-control',
      'style' => self::$marginLeft,
      'ref' => $name,
      'v-model.number' => $name,
      // 'min' => $min
    ];

    if ($isMax) {
      $labelOptions['style'] = self::$marginLeft;
    }

    // if ($max !== false) {
    //   $inputOptions['max'] = $max;
    // }

    $title = $isMax ? 'до' : 'От';

    echo Html::label($title . ':', $name, $labelOptions);
    echo Html::input('number', $name, '', $inputOptions);
  }

  public static function renderOutput($withPercent = false)
  {
    $title = $withPercent ? "С процентом" : "Без процента";
    $plotter = $withPercent ? "porWithPercent" : "porWithCourse";
    $list = $withPercent ? "calcListWithPercent" : "calcList";
?>
    <div class="col-md-6">
      <h3> <?= $title ?> </h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Название</th>
            <th>Значение</th>
          </tr>
        </thead>
        <tbody>
          <?php
          self::_renderOutputItem(1, 'Плоттер', '{{' . $plotter . '}}');
          self::_renderOutputItem('{{index + 2}}', '{{item.title}}', '{{item.value}}', ['v-for="(item, index) in ' . $list . '"']);
          ?>
        </tbody>
      </table>
    </div>
  <?php
  }

  private static function _renderOutputItem($number, $title, $value, $attrs = [])
  {
  ?>
    <tr <?= join(' ', $attrs) ?>>
      <th scope="row"> <?= $number ?> </th>
      <td> <?= $title ?> </td>
      <td> <?= $value ?> </td>
    </tr>
<?php
  }
}
