<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = false;
    public $timeZone;
    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['timeZone','integer'],
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),



        ];
    }


    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'К сожалению, мы не смогли найти пользователя с таким именем и паролем.');
            } elseif ($user->status === 0) {
                $this->addError($attribute, 'К сожалению, Ваш аккаунт заблокирован.');
            }
        }
    }
    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        
        if ($this->validate()) {
            $u = $this->getUser();
            if (!in_array($u->role_id,[1,3,4,5,6,7,8])){
            $count = CountView::findOne(['account_id'=>$u->profile->account->id]);
                if(!$count){
                    $count = new CountView();
                    $count->account_id = $u->profile->account->id;
                    $count->save();
                }
                else{
                    if(date('d') == 1){
                        $count->count_for_month = 0;
                        $count->count_goods_for_month = 0;
                        $count->count_services_for_month = 0;
                        $count->save();
                    }
                }

                $this->checkUserStatus($u);
            }

            $u->online = $u::ONLINE;
            $u->profile->updated_at = time();
            $u->profile->save();
            $u->save();



            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 2 : 0);
        } else {
            return false;
        }
    }


    /**
     * @var $user \common\models\User
     */
    public function checkUserStatus($user){
        $now = date('Y-m-d H:i:s');
        $date_status = date('Y-m-d H:i:s',$user->profile->chargeTill);
        if($date_status < $now){
            $user->profile->chargeStatus = 0;
            $user->profile->chargeTill = null;
            $user->profile->save();
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        $session = Yii::$app->session;
        $session->set('timeZone', (string)$this->timeZone);
        return $this->_user;
    }
}
