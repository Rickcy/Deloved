<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "delivery_methods".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Goods[] $goods
 */
class DeliveryMethods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_methods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['delivery_methods_id' => 'id']);
    }
}
