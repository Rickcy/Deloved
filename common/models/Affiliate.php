<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "affiliate".
 *
 * @property integer $id
 * @property string $address
 * @property integer $city_id
 * @property string $email
 * @property string $phone
 * @property integer $account_id
 *
 * @property Region $city
 * @property Account $account
 */
class Affiliate extends \yii\db\ActiveRecord
{


    public $city_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'affiliate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'account_id'], 'integer'],
            [['address', 'email','city_name', 'phone'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['account_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['account_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'address' => Yii::t('app', 'Address'),
            'city_id' => Yii::t('app', 'City ID'),
            'city_name' => Yii::t('app', 'City Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'account_id' => Yii::t('app', 'Account ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Region::className(), ['id' => 'city_id']);
    }

    public function returnCity_id($city_name){
        $name = $city_name;
        $region_id=[];
        $region_id[] = Region::find()->select('id')->where(['name'=>$name])->one();
        return $region_id[0]['id'];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'account_id']);
    }
    
    
}
