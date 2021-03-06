<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class AppController extends Controller
{
  protected $modelClass;
  protected $helperModels = [];

  private $isCreateView = false;
  private $modelNamespace = 'common\models';

  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['POST'],
          'delete-multiple' => ['POST'],
        ],
      ],
      'access' => [
        'class' => AccessControl::className(),
        // 'only' => [],
        'rules' => [
          // разрешаем аутентифицированным пользователям
          [
            'allow' => true,
            'roles' => ['@'],
          ],
          // всё остальное по умолчанию запрещено
        ],
      ],
    ];
  }

  /**
   * @inheritdoc
   */
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
    ];
  }

  /**
   * Lists all models.
   * @return mixed
   */
  public function actionIndex()
  {
    $modelClass = $this->_getModelClass();
    $dataProvider = new ActiveDataProvider(['query' => $modelClass::find()]);
    return $this->render('index', compact('dataProvider'));
  }

  /**
   * Displays a single model.
   * @param string $id
   * @return mixed
   */
  public function actionView($id)
  {
    return $this->render('view', ['model' => $this->_findModel($id)]);
  }

  /**
   * Creates a new VacancieRank model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $this->isCreateView = true;
    $modelClass = $this->_getModelClass();
    $model = new $modelClass;
    return $this->_renderView($model);
  }

  /**
   * Updates an existing model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param string $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
    $this->isCreateView = false;
    return $this->_renderView($this->_findModel($id));
  }

  /**
   * Deletes an existing model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param string $id
   * @return mixed
   */
  public function actionDelete($id)
  {
    $this->_findModel($id)->delete();
    return $this->redirect(['index']);
  }

  private function _renderView($model)
  {
    $view = $this->isCreateView ? 'create' : 'update';
    $lists = [];

    foreach ($this->helperModels as $key => $value) {

      if (is_string($key)) {
        $helperModelName = $key;
        $tempOrderField = $value;
      } else {
        $helperModelName = $value;
        $tempOrderField = 'name';
      }

      $helperModelClass = $this->_getModelClass($helperModelName);
      $tempList = $helperModelClass::find()
        ->select(['id', $tempOrderField])
        ->orderBy($tempOrderField)
        ->asArray()
        ->all();
      $lists[$helperModelName] = $this->_getArray($tempList, $tempOrderField, 'id');
    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect([$view, 'id' => $model->id, 'lists' => $lists]);
    }

    return $this->render($view, [
      'model' => $model,
      'lists' => $lists,
    ]);
  }

  private function _getArray($list, $label, $value)
  {
    $array = [];

    foreach (ArrayHelper::map($list, $value, $label) as $key => $val) {
      $array[$key] = $val;
    }

    return $array;
  }

  /**
   * Finds the model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param string $id
   * @return Image the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  private function _findModel($id)
  {
    $modelClass = $this->_getModelClass();

    if (($model = $modelClass::findOne($id)) === null) {
      throw new NotFoundHttpException('The requested page does not exist.');
    }

    return $model;
  }

  private function _getModelClass($className = false)
  {
    return $this->modelNamespace . '\\' . (!$className ? $this->modelClass : $className);
  }
}
