<?php
namespace frontend\models;

use common\models\Account;
use common\models\AccountCategory;
use common\models\Profile;
use common\models\Region;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\helpers\Url;

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

    public $description;
    public $director;
    public $full_name;
    public $fax;
    public $inn;
    public $keywords;
    public $ogrn;
    public $legal_address;
    public $phone1;
    public $org_form_id;
    public $fio;
    public $chargeStatus;
    public $chargeTill;
    public $user_id;
    public $work_time;
    public $web_address;
    public $public_status;
    public $verify_status;
    public $show_main;
    public $account_category_goods;
    public $account_category_service;

    public $verifyCode;
    
    
    public $date;
    public $city_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['username','password','email','full_name','city_name','date', 'brand_name', 'inn', 'ogrn', 'legal_address', 'phone1', 'fax', 'web_address', 'email', 'description', 'director', 'work_time', 'address', 'keywords','fio'], 'trim'],
            [['username','password','inn', 'ogrn','org_form_id','email','full_name','fio','city_name','address','date','legal_address','director','phone1'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя занято.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email занят'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],
            ['password', 'string', 'min' => 4],
            ['repassword', 'compare','compareAttribute'=>'password'],

            [['org_form_id', 'public_status','show_main' ,'verify_status',  'chargeStatus', 'chargeTill', ], 'integer'],
            [['full_name','city_name','date', 'brand_name', 'inn', 'ogrn', 'legal_address', 'phone1', 'fax', 'web_address', 'email',  'director', 'work_time', 'address', 'fio' ], 'string', 'max' => 100],
            [['account_category_goods','account_category_service'], 'string', 'max' => 1055],
            [['description','keywords'], 'string', 'max' => 2055],

            ['verifyCode', 'captcha','captchaAction'=>Url::to(['/front/captcha'])],


        ];
    }

    public function returnCity_id(){
        $name = $this->city_name;
        $region_id=[];
        $region_id[] = Region::find()->select('id')->where(['name'=>$name])->one();
        return $region_id[0]['id'];
    }

    public function returnCategoties_id(){
        $categories_goods = $this->account_category_goods;
        $categories_service = $this->account_category_service;
        $arr1 = explode(", ", $categories_goods);
        $arr2 = explode(", ", $categories_service);

        return $result = array_merge($arr1,$arr2);
    }

    public function returnDate(){
        $date_registration =$this->date;
        $date = explode("/", $date_registration);
        $timestamp = mktime(0, 0, 0, $date['0'], $date['1'], $date['2']);
        return $timestamp;
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
        $user->generateEmailConfirmToken();
        $user->save();

        $profile->fio=$this->fio;
        $profile->chargeTill=null;
        $profile->chargeStatus=0;

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
        $account->date_reg=$this->returnDate();

        $account->description=$this->description;
        $account->director=$this->director;
        $account->fax=$this->fax;
        $account->inn=$this->inn;
        $account->keywords=$this->keywords;
        $account->ogrn=$this->ogrn;
        $account->legal_address=$this->legal_address;
        $account->org_form_id=$this->org_form_id;
        $account->phone1=$this->phone1;
        $account->show_main=0;
        $account->public_status=0;
        $account->verify_status=0;
        $account->web_address=$this->web_address;
        $account->work_time=$this->work_time;
        $account->email=$this->email;
        $account->created_at=time();
        $account->updated_at=time();
        $account->user_id=$user->id;


        $account->save();
        foreach ($this->returnCategoties_id() as $item){
            $category =new AccountCategory();

            $category->category_id=$item;
            $category->account_id=$account->id;

            $category->save();

        }


        if ($user->save()&&$profile->save()&&$account->save()) {
          

            if (!$user) {
                return false;
            }
            Yii::$app->common->sendMailEmailConfirm($this->email,$user);



            
        return $user;
        }
        return null;
    }
}
