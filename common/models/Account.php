<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

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
 * @property string $city_name
 * @property string $address
 * @property string $keywords
 * @property integer $public_status
 * @property integer $verify_status
 * @property integer $rating
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Account extends ActiveRecord
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
            [['org_form_id', 'date_reg', 'logo_id', 'public_status', 'verify_status', 'rating', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['full_name', 'brand_name', 'inn', 'kpp', 'legal_address', 'phone1', 'phone2', 'fax', 'web_address', 'email', 'description', 'director', 'work_time', 'city_name', 'address', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'org_form_id' => 'Org Form ID',
            'brand_name' => 'Brand Name',
            'inn' => 'Inn',
            'kpp' => 'Kpp',
            'legal_address' => 'Legal Address',
            'date_reg' => 'Date Reg',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'fax' => 'Fax',
            'web_address' => 'Web Address',
            'email' => 'Email',
            'logo_id' => 'Logo ID',
            'description' => 'Description',
            'director' => 'Director',
            'work_time' => 'Work Time',
            'city_name' => 'City Name',
            'address' => 'Address',
            'keywords' => 'Keywords',
            'public_status' => 'Public Status',
            'verify_status' => 'Verify Status',
            'rating' => 'Rating',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
