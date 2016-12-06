<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "region_type".
 *
 * @property integer $id
 * @property string $code
 *
 * @property RegionLevel[] $regionLevels
 */
class RegionType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegionLevels()
    {
        return $this->hasMany(RegionLevel::className(), ['type_id' => 'id']);
    }
}
