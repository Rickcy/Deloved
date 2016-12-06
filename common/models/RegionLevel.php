<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "region_level".
 *
 * @property integer $id
 * @property integer $level
 * @property integer $parent_id
 * @property integer $type_id
 *
 * @property Region[] $regions
 * @property RegionLevel $parent
 * @property RegionLevel[] $regionLevels
 * @property RegionType $type
 */
class RegionLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'level', 'parent_id', 'type_id'], 'integer'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => RegionLevel::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RegionType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'level' => Yii::t('app', 'Level'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'type_id' => Yii::t('app', 'Type ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Region::className(), ['level_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(RegionLevel::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegionLevels()
    {
        return $this->hasMany(RegionLevel::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(RegionType::className(), ['id' => 'type_id']);
    }
}
