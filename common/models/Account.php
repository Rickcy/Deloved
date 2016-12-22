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
 * @property string $ogrn
 * @property string $legal_address
 * @property integer $date_reg
 * @property string $phone1

 * @property string $fax
 * @property string $web_address
 * @property string $email
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
 * @property Region $city
 * @property User $user
 * @property OrgForm $orgForm
 * @property Logo[] $logos
 */
class Account extends \yii\db\ActiveRecord
{
    const DEFAULT_RATING =100;


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
            [['org_form_id', 'date_reg', 'city_id', 'public_status', 'verify_status', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            ['rating', 'default', 'value' => self::DEFAULT_RATING],
            [['full_name', 'brand_name', 'inn', 'ogrn', 'legal_address', 'phone1', 'fax', 'web_address', 'email', 'description', 'director', 'work_time', 'address', 'keywords'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['org_form_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrgForm::className(), 'targetAttribute' => ['org_form_id' => 'id']],
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
            'ogrn' => Yii::t('app', 'OGRN'),
            'legal_address' => Yii::t('app', 'Legal Address'),
            'date_reg' => Yii::t('app', 'Date Reg'),
            'phone1' => Yii::t('app', 'Phone1'),
            'fax' => Yii::t('app', 'Fax'),
            'web_address' => Yii::t('app', 'Web Address'),
            'email' => Yii::t('app', 'Email'),
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

    public function getMainImage(){
        $user = User::findOne(Yii::$app->user->id);
        $account = $user->getAccounts()->one();
        $user_id = $account->id;
        $main_image =Logo::find()->where('user_id=:user_id',[':user_id'=>$user_id])->andWhere('main_image=:main_image',[':main_image'=>1])->one();
        
        return $main_image;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Region::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
    public function getOrgForm()
    {
        return $this->hasOne(OrgForm::className(), ['id' => 'org_form_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogos()
    {
        return $this->hasMany(Logo::className(), ['user_id' => 'id']);
    }

    public function getCategory(){

        return $this->hasMany(AccountCategory::className(),['account_id'=>'id']);
    }
}
