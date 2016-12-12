<?php

namespace frontend\models;


use common\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\Url;

class RepeatEmailConfirm extends Model
{

    public $email;
    public $verifyCode;
    public function rules()
    {
        return [
            ['email','trim'],
            ['email','email'],
            ['verifyCode', 'captcha','captchaAction'=>Url::to(['/admin/default/captcha'])],

        ];
    }


    public function repeatEmailConfirm(){
        if (!$this->validate()){
            return null;
        }
        $user =User::findOne(Yii::$app->user->id);

        $user->email=$this->email;

             Yii::$app->common->sendMailEmailConfirm($this->email, $user);
        if($user->save()){
            return $user;
        }
        return null;
    }


}