<?php

namespace backend;

use yii\helpers\Html;

class ReasanikVue
{
  private static $marginLeft = 'margin-left: 10px';

  public static function renderMinMax($form, $model, $name, $postfix = false, $min = 0, $max = false)
  {
    $inputValue = $model->attributes[$name] ? $model->attributes[$name] : '';

    echo $form->field($model, $name)->textInput([
      'maxlength' => true,
      'data-value' => $inputValue,
      'ref' => $name,
      // 'v-model.trim' => $name,
      ':value' => $name,
      '@blur' => $name . ' = $event.target.value',
    ]);

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
}
