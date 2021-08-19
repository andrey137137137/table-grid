<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%vacancie}}".
 *
 * @property int $id
 * @property int $rank
 * @property int $vessel_type
 * @property string $build_year
 * @property string $dwt
 * @property string $contract_duration
 * @property string $ambarcation_date
 * @property string $salary
 *
 * @property VacancieRank $vacancieRank
 * @property VesselType $vesselType
 */
class Vacancie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vacancie}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rank', 'vessel_type', 'build_year', 'dwt', 'contract_duration', 'ambarcation_date', 'salary'], 'required'],
            [['rank', 'vessel_type'], 'integer'],
            [['build_year', 'dwt', 'contract_duration', 'salary'], 'string', 'max' => 150],
            [['ambarcation_date'], 'string', 'max' => 256],
            [['rank'], 'exist', 'skipOnError' => true, 'targetClass' => VacancieRank::className(), 'targetAttribute' => ['rank' => 'id']],
            [['vessel_type'], 'exist', 'skipOnError' => true, 'targetClass' => VesselType::className(), 'targetAttribute' => ['vessel_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rank' => 'Rank',
            'vessel_type' => 'Vessel Type',
            'build_year' => 'Build Year',
            'dwt' => 'Dwt',
            'contract_duration' => 'Contract Duration',
            'ambarcation_date' => 'Ambarcation Date',
            'salary' => 'Salary',
        ];
    }

    /**
     * Gets query for [[VacancieRank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVacancieRank()
    {
        return $this->hasOne(VacancieRank::className(), ['id' => 'rank']);
    }

    /**
     * Gets query for [[VesselType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVesselType()
    {
        return $this->hasOne(VesselType::className(), ['id' => 'vessel_type']);
    }
}
