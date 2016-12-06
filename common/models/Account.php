<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "account".
 *
 * @property integer $id
 * @property string $full_name
 * @property integer $org_form_id
 * @property string $brand_name
 * @property string $inn
 * @property string $kpp
 * @property string $legal_address
 * @property integer $date_reg
 * @property string $phone1
 * @property string $phone2
 * @property string $fax
 * @property string $web_address
 * @property string $email
 * @property integer $logo_id
 * @property string $description
 * @property string $director
 * @property string $work_time
 * @property integer $city_id
 * @property string $address
 * @property string $keywords
 * @property integer $public_status
 * @property integer $verify_status
 * @property integer $rating
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property Region $city
 */
class Account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['org_form_id', 'date_reg', 'logo_id', 'city_id', 'public_status', 'verify_status', 'rating', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['full_name', 'brand_name', 'inn', 'kpp', 'legal_address', 'phone1', 'phone2', 'fax', 'web_address', 'email', 'description', 'director', 'work_time', 'address', 'keywords'], 'string', 'max' => 255],
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
            'full_name' => Yii::t('app', 'Full Name'),
            'org_form_id' => Yii::t('app', 'Org Form ID'),
            'brand_name' => Yii::t('app', 'Brand Name'),
            'inn' => Yii::t('app', 'Inn'),
            'kpp' => Yii::t('app', 'Kpp'),
            'legal_address' => Yii::t('app', 'Legal Address'),
            'date_reg' => Yii::t('app', 'Date Reg'),
            'phone1' => Yii::t('app', 'Phone1'),
            'phone2' => Yii::t('app', 'Phone2'),
            'fax' => Yii::t('app', 'Fax'),
            'web_address' => Yii::t('app', 'Web Address'),
            'email' => Yii::t('app', 'Email'),
            'logo_id' => Yii::t('app', 'Logo ID'),
            'description' => Yii::t('app', 'Description'),
            'director' => Yii::t('app', 'Director'),
            'work_time' => Yii::t('app', 'Work Time'),
            'city_id' => Yii::t('app', 'City ID'),
            'address' => Yii::t('app', 'Address'),
            'keywords' => Yii::t('app', 'Keywords'),
            'public_status' => Yii::t('app', 'Public Status'),
            'verify_status' => Yii::t('app', 'Verify Status'),
            'rating' => Yii::t('app', 'Rating'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Region::className(), ['id' => 'city_id']);
    }
}
