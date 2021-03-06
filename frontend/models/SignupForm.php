<?php
namespace frontend\models;

use common\models\Account;
use common\models\AccountCategory;
use common\models\CountView;
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

    public $sogl;

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



    public $verifyUser;



    /**
     *
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['username','password','email','full_name','city_name','date', 'brand_name', 'inn', 'ogrn', 'legal_address', 'phone1', 'fax', 'web_address', 'email', 'description', 'director', 'work_time', 'address', 'keywords','fio'], 'trim'],
            [['password','inn', 'ogrn','org_form_id','email','full_name','date','profile_city','director','sogl','verifyUser'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя занято.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email занят'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],
            ['profile_city', 'checkCity'],

            ['password', 'string', 'min' => 4],
            ['inn', 'string', 'min' => 10,'max'=>12],
            ['repassword', 'compare','compareAttribute'=>'password'],
            [['org_form_id', 'public_status','show_main' ,'verify_status',  'chargeStatus', 'chargeTill','ogrn','inn' ], 'integer'],
            [['full_name','city_name','profile_city','date', 'brand_name', 'inn', 'ogrn', 'phone1', 'fax', 'web_address', 'email',  'director', 'work_time', 'fio' ], 'string', 'max' => 100],
            [['account_category_goods','account_category_service','legal_address'], 'string', 'max' => 1055],
            [['description','keywords'], 'string', 'max' => 2055],

            ['verifyCode', 'captcha','captchaAction'=>Url::to(['/front/captcha'])],


        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inn' => Yii::t('app', 'Inn'),
            'password' => Yii::t('app', 'Password'),
            'repassword' => Yii::t('app', 'Repeat password'),
            'profile_city' => Yii::t('app', 'City'),

        ];
    }




    public function checkCity(){
       $region_id = Region::find()->select('id')->where(['name'=>$this->profile_city])->one();

       if(!$region_id){
           $this->addError('profile_city', 'Выбирете город');
           return;
       }
    }

    /**
     * Signs user up.
     *
     * @return User
     * @throws \yii\base\InvalidParamException
     */
    public function signUp()
    {
        if (!$this->validate()) {
            return null;
        }

        $transaction = \Yii::$app->db->beginTransaction();
        try {

            $user = new User();
            $profile = new Profile();
            $twinAccount = Account::find()->where(['inn' => $this->inn])->andWhere(['ogrn' => $this->ogrn])->one();
            if ($twinAccount) {
                $account = $twinAccount;
            } else {
                $account = new Account();
            }


            $user->email = $this->email;
            $user->username = $this->username ? $this->username : $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();
            $user->save();

            $profile->fio = $this->director;
            $profile->chargeTill = null;

            $profile->chargeTill = time() + (14 * 24 * 60 * 60);

            $profile->chargeStatus = 0;
            $profile->city_id = $profile->returnCity_id($this->profile_city);
            $profile->email = $user->email;
            $profile->user_id = $user->id;
            $profile->created_at = time();
            $profile->updated_at = time();
            $profile->save();

            $account->full_name = Account::getTrimName($this->full_name);
            $account->address = $this->address;
            $account->brand_name = $this->brand_name;
            $account->city_id = $this->city_name == null ? $profile->returnCity_id($this->profile_city) : $account->returnCity_id($this->city_name);
            $account->date_reg = $account->getDate($this->date);

            $account->description = $this->description;
            $account->director = $this->director;
            $account->fax = $this->fax;
            $account->inn = $this->inn;
            $account->keywords = $this->keywords;
            $account->ogrn = $this->ogrn;
            $account->legal_address = $this->legal_address;
            $account->org_form_id = $this->org_form_id;
            $account->phone1 = $this->phone1;
            $account->show_main = 0;
            $account->public_status = 1;
            $account->verify_status = 1;
            $account->web_address = $this->web_address;
            $account->work_time = $this->work_time;
            $account->email = $this->email;
            $account->created_at = time();
            $account->updated_at = time();
            $account->profile_id = $profile->id;
            $account->save();


            $count = new CountView();
            $count->account_id = $account->id;
            $count->save();


            $new_account = new NewAccount();
            $new_account->for_profile_id = Profile::ID_PROFILE_ADMIN;
            $new_account->new_account_id = $account->id;
            $new_account->date_created = date('Y-m-d H:i');
            $new_account->save();

            $query = 'SELECT * FROM profile WHERE user_id IN (SELECT id FROM "user" WHERE "user".role_id =:role_id) AND id IN (SELECT profile_id FROM profile_region WHERE region_id =:region_id)';
            $profile_managers = Yii::$app->db->createCommand($query, [
                ':region_id' => $account->city_id,
                ':role_id' => ROLE::ROLE_MANAGER
            ])->queryAll();

            foreach ($profile_managers as $profile) {
                $new_account = new NewAccount();
                $new_account->for_profile_id = $profile['id'];
                $new_account->new_account_id = $account->id;
                $new_account->date_created = date('Y-m-d H:i');
                $new_account->save();
            }

            Yii::$app->common->sendMailEmailConfirm($this->email, $user);

            $transaction->commit();
            return $user;
        }catch (Exception $e){
            $transaction->rollBack();
            return null;
        }

    }
}
