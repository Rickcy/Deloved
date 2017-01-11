<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property integer $id
 * @property string $image_name
 * @property string $file
 *
 * @property Goods[] $goods
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_name', 'file'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image_name' => Yii::t('app', 'Image Name'),
            'file' => Yii::t('app', 'File'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['photo_id' => 'id']);
    }
}
