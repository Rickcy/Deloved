<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 06.02.18
 * Time: 19:24
 */

namespace frontend\models;


use common\models\Questions;
use common\models\User;
use Yii;
use yii\base\Model;
use yii\helpers\Url;

class QuestionsForm extends Model
{
    public $checkboxList;
    public $reason;
    public $verifyCode;



    public static function getAllQuestions()
    {
        return [
           1  => 'Вы не являетесь ИП и у вас нет предприятия',
           2  => 'Форма регистрации очень сложная',
           3  => 'Вы попробовали пройти регистрацию, но возникла ошибка сайте',
           4  => 'Вы не хотели бы оставлять на сайте свой ИНН',
           5  => 'другое (укажите причину)',
        ];
    }
    public function attributeLabels()
    {
        return [
            'checkboxList' => Yii::t('app', 'Reason'),
            'verifyCode' => 'Verification Code',
        ];
    }


    public function rules()
    {
        return [
            ['checkboxList', 'each', 'rule' => ['in', 'range' => array_keys(self::getAllQuestions())]],
            ['reason','string'],
            ['verifyCode', 'captcha','captchaAction'=>Url::to(['/companies/captcha'])],
        ];

    }

    public function checkbox(){
        if (!count($this->checkboxList)) {
            if(!$this->reason){
                $this->addError('reason', 'Укажите причину');
            }
        }
    }


    public function save()
    {
        if(!$this->validate()){
           var_dump($this->errors);
        }
        $question = new Questions();

        if($this->checkboxList){
            foreach ($this->checkboxList as $key => $value){
                if($value != 5){
                    $question->reason .=self::getAllQuestions()[$value].', ';
                }
            }
            if(in_array(5,$this->checkboxList)){
                $question->reason .= $this->reason;
            }
        }
        else{
            $question->reason .= $this->reason;
        }



        $user = User::findOne(1);
        $question->crtime = date('Y-m-d H:i:s');
        if ($question->save()){
            Yii::$app->common->sendQuestionsTemplate('deloved.info@gmail.com',$user);
        }
        Questions::deleteAll();


    }


}