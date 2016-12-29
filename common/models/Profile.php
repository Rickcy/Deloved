<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property integer $id
 * @property string $fio
 * @property string $email
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $chargeStatus
 * @property integer $chargeTill
 * @property integer $user_id
 *  @property integer $city_id
 *
 * @property Region $city
 * @property Experience $experience
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    public $date;
    public $city_name;
    public $experience;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['city_name','trim'],
            [['created_at','city_id', 'updated_at', 'chargeStatus', 'chargeTill', 'user_id'], 'integer'],
            ['fio', 'required'],
            [['fio','experience', 'email','city_name','date'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fio' => Yii::t('app', 'Fio'),
            'email' => Yii::t('app', 'Email'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'chargeStatus' => Yii::t('app', 'Charge Status'),
            'date' => Yii::t('app', 'Charge Till'),
            'user_id' => Yii::t('app', 'User ID'),
            'city_id' => Yii::t('app', 'User City ID'),
            'city_name'=>Yii::t('app','City name')
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

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

    public function returnDate($date){
        $date_registration =$date;
        $date = explode("/", $date_registration);
        $timestamp = mktime(0, 0, 0, $date['0'], $date['1'], $date['2']);
        return $timestamp;
    }

    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['profile_id'=>'id']);
    }

    public function getExperience()
    {
        return $this->hasOne(Experience::className(), ['profile_id' => 'id']);
    }

    public function getRegions()
    {
        return $this->hasMany(ProfileRegion::className(), ['profile_id' =>'id']);
    }

}
