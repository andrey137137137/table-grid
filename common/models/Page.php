<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%page}}".
 *
 * @property int $id
 * @property string $url
 * @property string $author
 *
 * @property LangPage[] $langPages
 */
class Page extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return '{{%page}}';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['url', 'author'], 'required'],
      [['url', 'author'], 'string', 'max' => 255],
      [['url'], 'unique'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => Yii::t('app', 'ID'),
      'url' => Yii::t('app', 'Url'),
      'author' => Yii::t('app', 'Author'),
    ];
  }

  /**
   * Gets query for [[LangPages]].
   *
   * @return \yii\db\ActiveQuery
   */
  public function getLangPages()
  {
    return $this->hasMany(LangPage::className(), ['page_id' => 'id']);
  }

  /*
 * Возвращает массив объектов модели Post
 */
  public function getPages()
  {
    return $this->find()->all();
  }

  /*
  * Возвращает данные для указанного языка
  */
  public function getDataPages()
  {
    $language = Yii::$app->language;
    $data_lang = $this->getLangPages()->where(['lang' => $language])->one();
    return $data_lang;
  }

  /*
  * Возвращает объект поста по его url
  */
  public function getPage($url)
  {
    return $this->find()->where(['url' => $url])->one();
  }
}
