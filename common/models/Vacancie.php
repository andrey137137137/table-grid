<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%vacancie}}".
 *
 * @property int $id
 * @property int $rank_id
 * @property int $vessel_type_id
 * @property string $build_year
 * @property string $dwt
 * @property string $contract_duration
 * @property string $ambarcation_date
 * @property string $salary
 *
 * @property VacancieRank $rank
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
            [['rank_id', 'vessel_type_id', 'build_year', 'dwt', 'contract_duration', 'ambarcation_date', 'salary'], 'required'],
            [['rank_id', 'vessel_type_id'], 'integer'],
            [['build_year', 'dwt', 'contract_duration', 'salary'], 'string', 'max' => 150],
            [['ambarcation_date'], 'string', 'max' => 256],
            [['rank_id'], 'exist', 'skipOnError' => true, 'targetClass' => VacancieRank::className(), 'targetAttribute' => ['rank_id' => 'id']],
            [['vessel_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => VesselType::className(), 'targetAttribute' => ['vessel_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rank_id' => 'Rank ID',
            'vessel_type_id' => 'Vessel Type ID',
            'build_year' => 'Build Year',
            'dwt' => 'Dwt',
            'contract_duration' => 'Contract Duration',
            'ambarcation_date' => 'Ambarcation Date',
            'salary' => 'Salary',
        ];
    }

    /**
     * Gets query for [[Rank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRank()
    {
        return $this->hasOne(VacancieRank::className(), ['id' => 'rank_id']);
    }

    /**
     * Gets query for [[VesselType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVesselType()
    {
        return $this->hasOne(VesselType::className(), ['id' => 'vessel_type_id']);
    }
}
