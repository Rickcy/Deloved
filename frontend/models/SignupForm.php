<?php
namespace frontend\models;

use common\models\Account;
use common\models\Profile;
use common\models\Region;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $repassword;

    public $address;
    public $brand_name;

    public $date_reg;
    public $description;
    public $director;
    public $full_name;
    public $fax;
    public $inn;
    public $keywords;
    public $kpp;
    public $legal_address;
    public $phone1;
    public $phone2;
    public $org_form_id;
    public $fio;
    public $cellPhone;
    public $chargeStatus;
    public $chargeTill;
    public $user_id;
    public $work_time;
    public $web_address;
    public $public_status;
    public $verify_status;
    public $rating;

    public $city_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username','email'], 'trim'],
            
            [['username','password','org_form_id','email','full_name','director','city_name','address'], 'required'],
            
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['email', 'email'],
       

            
            ['password', 'string', 'min' => 4],
            ['repassword', 'compare','compareAttribute'=>'password'],


            [['org_form_id', 'date_reg', 'public_status', 'verify_status', 'rating',  'chargeStatus', 'chargeTill', ], 'integer'],

            [['full_name','city_name', 'brand_name', 'inn', 'kpp', 'legal_address', 'phone1', 'phone2', 'fax', 'web_address', 'email', 'description', 'director', 'work_time', 'address', 'keywords','fio', 'cellPhone'], 'string', 'max' => 255],




        ];
    }

    public function returnCity_id(){
        $name = $this->city_name;
        $region_id=[];
        $region_id[] = Region::find()->select('id')->where(['name'=>$name])->one();
        return $region_id[0]['id'];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws \yii\base\InvalidParamException
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $profile =new Profile();
        $account =new Account();

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->save();

        $profile->fio=$this->fio;
        $profile->chargeTill=null;
        $profile->chargeStatus=0;
        $profile->cellPhone=$this->cellPhone;
        $profile->email=$user->email;
        $profile->user_id=$user->id;
        $profile->avatar_id=null;
        $profile->created_at=time();
        $profile->updated_at=time();
        $profile->save();

        $account->full_name=$this->full_name;
        $account->address=$this->address;
        $account->brand_name=$this->brand_name;
        $account->city_id=$this->returnCity_id();
        $account->date_reg=time();
        $account->description=$this->description;
        $account->director=$this->director;
        $account->fax=$this->fax;
        $account->inn=$this->inn;
        $account->keywords=$this->keywords;
        $account->kpp=$this->kpp;
        $account->legal_address=$this->legal_address;
        $account->org_form_id=$this->org_form_id;
        $account->phone1=$this->phone1;
        $account->phone2=$this->phone2;
        $account->public_status=0;
        $account->verify_status=0;
        $account->rating=100;
        $account->web_address=$this->web_address;
        $account->work_time=$this->work_time;
        $account->email=$this->email;
        $account->created_at=time();
        $account->updated_at=time();
        $account->user_id=$user->id;
        $account->save();
     






        return $user->save() ? $user : null;
    }
}
