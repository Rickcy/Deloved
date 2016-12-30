<?php
/**
 * Created by PhpStorm.
 * User: User11
 * Date: 30.12.2016
 * Time: 12:10
 */

namespace frontend\models;


use common\models\User;
use Yii;
use yii\base\Model;

class ChangePassForm extends Model
{
    public $old_password;
    public $new_password;
    public $repeat_new_password;
    private $_user;

    public function rules()
    {
        return [
            // username and password are both required
            [['new_password', 'old_password','repeat_new_password'], 'required'],

            ['repeat_new_password', 'compare','compareAttribute'=>'new_password'],
            // rememberMe must be a boolean value
            // password is validated by validatePassword()
            ['old_password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user->validatePassword($this->old_password)) {
                $this->addError($attribute, 'Неверный пароль, попробуйте еще раз');
            }
        }
        else {
            $this->changePass();
        }
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findOne(Yii::$app->user->id);
        }

        return $this->_user;
    }

    public function changePass()
    {
        if ($this->_user === null) {
            $this->_user = User::findOne(Yii::$app->user->id);
        }

        if (!$this->validate()){
            return null;
        }

        $this->_user->password_hash = Yii::$app->security->generatePasswordHash($this->new_password);
        $this->_user->save();
        if ($this->_user->save()){
            return true;
        }
        else{
            return false;
        }

    }


}