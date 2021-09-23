<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%lang_page}}".
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property string $lang
 * @property int|null $page_id
 *
 * @property Page $page
 */
class LangPage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lang_page}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text', 'lang'], 'required'],
            [['text'], 'string'],
            [['page_id'], 'integer'],
            [['title', 'lang'], 'string', 'max' => 255],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['page_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'lang' => Yii::t('app', 'Lang'),
            'page_id' => Yii::t('app', 'Page ID'),
        ];
    }

    /**
     * Gets query for [[Page]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }
}
