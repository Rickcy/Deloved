<?php
/**
 * Created by PhpStorm.
 * User: rickcy
 * Date: 30.12.16
 * Time: 22:28
 */

namespace frontend\models;


use common\models\Experience;
use common\models\Profile;
use common\models\User;
use yii\base\Model;

class UserForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $repassword;

    public $role;
    public $status;

    public function rules()
    {

        return[
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя занято.'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email занят'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'email'],

            [['status','role'],'integer'],
            [['username','password','email'],'trim'],
            [['username','password','email','role','status'],'required'],
            ['password', 'string', 'min' => 4],
            ['repassword', 'compare','compareAttribute'=>'password'],
        ];

    }

    public function createUser(){
        if (!$this->validate()){
            return null;
        }
        $user = new User();
        $profile = new Profile();

        $user->username=$this->username;
        $user->email=$this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->role_id=$this->role;
        $user->save();

        $profile->email=$user->email;
        $profile->created_at=time();
        $profile->updated_at=time();
        $profile->user_id=$user->id;

        if (!in_array($user->role->role_name,['ROLE_USER'])){
            $profile->chargeStatus=1;
            $profile->save();
            $experience = new Experience();
            $experience->profile_id=$profile->id;
            $experience->experience=null;
            $experience->save();

        }
        else{
            $profile->chargeStatus=0;
            $profile->save();
        }
        if ($profile->save()){
            return true;
        }

    }


}