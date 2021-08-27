<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use common\models\Vacancie;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

  /**
   * Displays homepage.
   *
   * @return mixed
   */
  public function actionIndex()
  {
    return $this->render('index');
  }

  /**
   * Displays vacancies page.
   *
   * @return mixed
   */
  public function actionVacancies()
  {
    $query = Vacancie::find()
      ->orderBy('rank')
      ->asArray()
      ->all();
    $vacancies = ArrayHelper::index($query, 'build_year', [
      function ($element) {
        return $element['rank'];
      },
      'vessel_type'
    ]);

    return $this->render('vacancies', [
      'vacancies' => $vacancies,
    ]);

    // $dataProvider = new ActiveDataProvider(['query' => Vacancie::find()]);
    // return $this->render('vacancies', compact('dataProvider'));
  }

  /**
   * Displays contact page.
   *
   * @return mixed
   */
  public function actionContact()
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
}
