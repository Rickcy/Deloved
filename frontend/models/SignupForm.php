<?php
namespace frontend\models;

use common\models\Account;
use common\models\AccountCategory;
use common\models\NewAccount;
use common\models\Profile;
use common\models\Region;
use common\models\Role;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\db\Exception;
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
    public $profile_city;

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
            [['username','password','inn', 'ogrn','org_form_id','email','full_name','fio','address','date','profile_city','legal_address','director','phone1'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя занято.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email занят'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],
            ['password', 'string', 'min' => 4],
            ['repassword', 'compare','compareAttribute'=>'password'],

            [['org_form_id', 'public_status','show_main' ,'verify_status',  'chargeStatus', 'chargeTill', ], 'integer'],
            [['full_name','city_name','profile_city','date', 'brand_name', 'inn', 'ogrn', 'legal_address', 'phone1', 'fax', 'web_address', 'email',  'director', 'work_time', 'address', 'fio' ], 'string', 'max' => 100],
            [['account_category_goods','account_category_service'], 'string', 'max' => 1055],
            [['description','keywords'], 'string', 'max' => 2055],

            ['verifyCode', 'captcha','captchaAction'=>Url::to(['/front/captcha'])],


        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws \yii\base\InvalidParamException
     */
    public function signUp()
    {
        if (!$this->validate()) {
            return null;
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try{

            $user = new User();
            $profile = new Profile();
            $account = new Account();


            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();
            $user->save();

            $profile->fio = $this->fio;
            $profile->chargeTill=null;
            $profile->chargeStatus=0;
            $profile->city_id= $profile->returnCity_id($this->profile_city);
            $profile->email=$user->email;
            $profile->user_id=$user->id;
            $profile->created_at=time();
            $profile->updated_at=time();
            $profile->save();

            $account->full_name=$this->full_name;
            $account->address=$this->address;
            $account->brand_name=$this->brand_name;
            $account->city_id=$this->city_name == null ? $profile->returnCity_id($this->profile_city) : $account->returnCity_id($this->city_name);
            $account->date_reg=$account->returnDate($this->date);

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
            $account->profile_id=$profile->id;
            $account->save();

            $new_account = new NewAccount();
            $new_account->for_profile_id = Profile::ID_PROFILE_ADMIN;
            $new_account->new_account_id = $account->id;
            $new_account->date_created = date('Y-m-d H:i');
            $new_account->save();

            $query = 'SELECT * FROM profile WHERE user_id IN (SELECT id FROM "user" WHERE "user".role_id =:role_id) AND id IN (SELECT profile_id FROM profile_region WHERE region_id =:region_id)';
            $profile_managers = Yii::$app->db->createCommand($query,[
                ':region_id'=>$account->city_id,
                ':role_id'=>ROLE::ROLE_MANAGER
            ])->queryAll();

            foreach ($profile_managers as $profile){
                $new_account = new NewAccount();
                $new_account->for_profile_id = $profile['id'];
                $new_account->new_account_id = $account->id;
                $new_account->date_created = date('Y-m-d H:i');
                $new_account->save();
            }

            Yii::$app->common->sendMailEmailConfirm($this->email,$user);
            $transaction->commit();
            return $user;
        }catch (Exception $e){
            $transaction->rollBack();
            return null;
        }

    }
}
