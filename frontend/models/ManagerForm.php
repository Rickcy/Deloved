<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 20.02.18
 * Time: 21:45
 */

namespace frontend\models;


use common\models\Managers;
use common\models\Profile;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\db\Exception;

class ManagerForm extends Model
{
    public $fio;

    public $username;
    public $email;
    public $password;
    public $repassword;




    public function rules()
    {
        return [
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя занято.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email занят'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],
            [['username','password','email','fio'],'trim'],
            [['username','password','email','fio'],'required'],
            ['password', 'string', 'min' => 4],
            ['repassword', 'compare','compareAttribute'=>'password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'fio' => Yii::t('app', 'Fio'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'E-mail address'),
            'password' => Yii::t('app', 'New Password'),
            'repassword'=>Yii::t('app', 'Repeat New Password')

        ];
    }

    public function createManager(){

        $main_user = User::findOne(Yii::$app->user->id);
        $main_profile = $main_user->profile;
        $mail_account = $main_profile->account;

        if (!$this->validate()){
            $this->addError('old_password', 'Неверный пароль, попробуйте еще раз');
        }
        $transaction = \Yii::$app->db->beginTransaction();

        try{

            $user = new User();
            $profile = new Profile();
            $manager = new Managers();

            $user->username=$this->username;
            $user->email=$this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->role_id = 2;
            $user->save();

            $profile->email = $user->email;
            $profile->fio = $this->fio;
            $profile->city_id = $main_profile->city_id;
            $profile->chargeStatus = $main_profile->chargeStatus;
            $profile->chargeTill = $main_profile->chargeTill;
            $profile->created_at = time();
            $profile->updated_at = time();
            $profile->user_id = $user->id;
            $profile->save();

            $manager->account_id = $mail_account->id;
            $manager->profile_id = $profile->id;
            $manager->save();

            $transaction->commit();
        }catch (Exception $exception){
            $transaction->rollBack();
            return null;
        }


    }


}