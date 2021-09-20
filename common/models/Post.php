<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property string $url
 * @property string $author
 *
 * @property LangPost[] $langPosts
 */
class Post extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return '{{%post}}';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['url', 'author'], 'required'],
      [['url', 'author'], 'string', 'max' => 255],
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
   * Gets query for [[LangPosts]].
   *
   * @return \yii\db\ActiveQuery
   */
  public function getLangPosts()
  {
    return $this->hasMany(LangPost::className(), ['post_id' => 'id']);
  }
  /*
 * Возвращает массив объектов модели Post
 */
  public function getPosts()
  {
    return $this->find()->all();
  }
  /*
 * Возвращает данные для указанного языка
 */
  public function getDataPosts()
  {
    $language = Yii::$app->language;
    $data_lang = $this->getLangPosts()->where(['lang' => $language])->one();
    return $data_lang;
  }

  /*
 * Возвращает объект поста по его url
 */
  public function getPost($url)
  {
    return $this->find()->where(['url' => $url])->one();
  }
}
