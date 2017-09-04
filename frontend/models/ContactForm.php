<?php

namespace frontend\models;

use common\models\SuggestionCat;
use Yii;
use yii\base\Model;
use yii\helpers\Url;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha','captchaAction'=>Url::to(['/front/captcha'])],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name'=>Yii::t('app', 'Name'),
            'email'=>Yii::t('app', 'Email'),
            'subject'=>Yii::t('app', 'Theme'),
            'body'=>Yii::t('app', 'Message Area'),

            'verifyCode' => 'Verification Code',

        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param $subject
     * @return string
     */

    public static function getTheme($subject){
       if ($subject){
           $theme =  SuggestionCat::findOne($subject);
       }
       else{
           $theme['name'] = '';
       }


       return $theme['name'];
    }



    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
