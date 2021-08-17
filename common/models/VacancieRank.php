<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%vacancie_rank}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property Vacancie[] $vacancies
 */
class VacancieRank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vacancie_rank}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Vacancies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVacancies()
    {
        return $this->hasMany(Vacancie::className(), ['rank' => 'id']);
    }
}
