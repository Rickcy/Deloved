<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 22.01.18
 * Time: 12:05
 */

namespace app\modules\admin\controllers;


use common\controllers\AuthController;
use common\models\Account;
use common\models\MailTemplate;
use Yii;

class MailController extends AuthController
{
    public $layout = '/admin';

    public function actionIndex(){
        $isExist = true;
        $template = MailTemplate::findOne(['type_template'=>MailTemplate::MAIL_TEMPLATE_GENERAL]);
        if(!$template){
            $template = new MailTemplate();
            $isExist = false;
        }

        return $this->render('index', ['isExist' => $isExist, 'template' => $template]);
    }

    public function actionEdit(){
        $template = MailTemplate::findOne(['type_template'=>MailTemplate::MAIL_TEMPLATE_GENERAL]);
        if(!$template){
            $template = new MailTemplate();
        }
        $template->type_template = MailTemplate::MAIL_TEMPLATE_GENERAL;
        if ($template->load(Yii::$app->request->post()) && $template->validate()){
            $template->save();
            return $this->redirect(['index']);
        }
        return $this->render('edit', ['template' => $template]);

    }


    public function actionMail(){
//        $accounts = Account::find()->where(['verify_status'=>1])->andWhere(['public_status'=>1])->all();
        $accounts[] = Account::findOne(['email'=>'podlesnova.tata@mail.ru']);

        foreach ($accounts as $account){
            /**
             * @var $account \common\models\Account
             */
            if($account->email){
                $email = $account->email;
            }
            elseif($account->profile->email){
                $email = $account->profile->email;
            }
            else{
                $email = $account->profile->user->email;
            }
            if($email){
                Yii::$app->common->sendMailTempalte($email, $account->profile->user);
            }
        }
    }

}