<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
// use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
// use yii\helpers\Json;
use common\models\Page;
use common\models\Vacancie;
use frontend\models\ContactForm;
use frontend\Reasanik;

/**
 * Site controller
 */
class SiteController extends Controller
{
  private static $_vacancieOrderFirstKey = '';

  public function actions()
  {
    return [
      'page' => [
        'class' => \yii\web\ViewAction::className(),
        'viewPrefix' => 'lang/' . Yii::$app->language
      ]
    ];
  }

  /**
   * Displays homepage.
   *
   * @return mixed
   */
  public function actionIndex()
  {
    $model = new Page();
    //пост соответствующий переданному url
    $page = $model->getPage('home');
    //данные поста из связанной таблицы lang_post
    $lang_data = $page->getDataPages();

    return $this->render('index', [
      'page' => $page,
      'lang_data' => $lang_data,
    ]);
  }

  /**
   * Displays vacancies page.
   *
   * @return mixed
   */
  public function actionVacancies($first = 'rank', $second = 'vesselType', $sort = '')
  {
    // $query = Vacancie::find()
    //   ->orderBy('rank_id')
    //   // ->asArray()
    //   ->all();
    // $vacancies = ArrayHelper::index($query, 'build_year', [
    //   function ($element) {
    //     return $element['rank_id'];
    //   },
    //   'vessel_type_id'
    // ]);
    // $ranks = ArrayHelper::map($query, 'rank_id', 'rank.name');
    // $vesselTypes = ArrayHelper::map($query, 'vessel_type_id', 'vesselType.name');
    // $counters = [];

    // foreach ($vacancies as $rankId => $topItems) {
    //   $counters[$rankId] = count($topItems);
    //   $counter = 0;

    //   foreach ($topItems as $vesselTypeId => $bottomItems) {
    //     $count = count($bottomItems);

    //     if ($count > 1) {
    //       $counters[$rankId . '_' . $vesselTypeId] = $count;
    //     }

    //     $counter += $count;
    //   }

    //   if ($counter > $counters[$rankId]) {
    //     $counters[$rankId] = $counter;
    //   }
    // }

    return $this->render('vacancies', self::_getVacanciesVars($first, $second, $sort));

    // $dataProvider = new ActiveDataProvider(['query' => Vacancie::find()]);
    // return $this->render('vacancies', compact('dataProvider'));
  }

  /**
   * Displays contact page.
   *
   * @return mixed
   */
  public function actionContacts()
  {
    $model = new ContactForm();

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
      if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
        Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
      } else {
        Yii::$app->session->setFlash('error', 'There was an error sending your message.');
      }

      return $this->refresh();
    } else {
      return $this->render('contact', [
        'model' => $model,
      ]);
    }
  }

  /**
   * Displays about page.
   *
   * @return mixed
   */
  public function actionAbout()
  {
    return $this->render('about');
  }

  private static function _getVacanciesVars($first, $second, $sort)
  {
    // self::$_vacancieOrderFirstKey = self::_getAttrByRelationship($first);
    // $secondKey = self::_getAttrByRelationship($second);

    if ($sort == '-') {
      $second = $sort . $second;
    }

    $orderArray = self::_getOrderArray([$first, $second]);
    $isFirstAttr = true;

    foreach ($orderArray as $attr => $value) {
      if ($isFirstAttr) {
        self::$_vacancieOrderFirstKey = $attr;
      } else {
        $secondKey = $attr;
      }

      $isFirstAttr = false;
    }
    // var_dump(self::$_vacancieOrderFirstKey);
    // var_dump($secondKey);

    $query = Vacancie::find()
      // ->orderBy([self::$_vacancieOrderFirstKey => SORT_ASC, $secondKey => SORT_DESC])
      ->orderBy($orderArray)
      ->all();
    $vacancies = ArrayHelper::index($query, 'build_year', [
      function ($element) {
        return $element[self::$_vacancieOrderFirstKey];
      },
      $secondKey
    ]);

    $firstColumn = self::_getColumn($query, $first);
    $secondColumn = self::_getColumn($query, $second);
    $counters = [];

    foreach ($vacancies as $firstId => $firstItems) {
      $counters[$firstId] = count($firstItems);
      $counter = 0;

      foreach ($firstItems as $secondId => $secondItems) {
        $count = count($secondItems);

        if ($count > 1) {
          $counters[$firstId . '_' . $secondId] = $count;
        }

        $counter += $count;
      }

      if ($counter > $counters[$firstId]) {
        $counters[$firstId] = $counter;
      }
    }
    // var_dump($vacancies);
    // var_dump(Json::encode($vacancies));
    // var_dump(json_last_error() == JSON_ERROR_NONE);

    return compact('vacancies', 'firstColumn', 'secondColumn', 'counters');
  }

  private static function _getAttrByRelationship($relationship, $attr = 'id')
  {
    $result = preg_replace('/([A-Z])/', '_$1', $relationship);
    return strtolower($result) . '_' . $attr;
  }

  private static function _getColumn($query, $model)
  {
    $attr = Reasanik::clearMinus($model);
    return ArrayHelper::map($query, $attr . '.id', $attr . '.name');
  }

  private static function _getOrderArray($attrs)
  {
    $result = [];
    $tempAttr = '';
    $tempOrder = SORT_ASC;

    foreach ($attrs as $attr) {
      $tempAttr = self::_getAttrByRelationship($attr);

      if (Reasanik::withMinus($tempAttr)) {
        $tempOrder = SORT_DESC;
        $tempAttr = Reasanik::removeMinus($tempAttr);
      }

      $result[$tempAttr] = $tempOrder;
      $tempOrder = SORT_ASC;
    }

    return $result;
  }
}
