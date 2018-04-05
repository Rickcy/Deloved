<?php

namespace frontend\models;


use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;

class EmailConfirmForm extends Model
{

    private $_user;

    public function __construct($token,$config=[])
    {
        if(empty($token)||!is_string($token)){
            throw new InvalidParamException('Отсутствует код подтверждения.');
        }
        $this->_user = User::findByEmailConfirmToken($token);
        if (!$this->_user){
            throw new InvalidParamException('Неверный код подтверждения попробуйте еще раз.');
        }
        parent::__construct($config);
    }


    public function confirmEmail(){
        $user = $this->_user;
        $user->role_id = 2;
        $user->removeEmailConfirmToken();
        $user->save();
        $user->profile->chargeStatus = 1;
        $user->profile->save();
        if($user->save()){
            return $user;
        }
        return null;
    }


}