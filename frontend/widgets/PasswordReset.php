<?php
/**
 * Created by PhpStorm.
 * User: User11
 * Date: 08.12.2016
 * Time: 17:28
 */

namespace frontend\widgets;


use frontend\models\PasswordResetRequestForm;
use Yii;
use yii\bootstrap\Widget;

class PasswordReset extends Widget
{
    public function run()
    {
     $model = new PasswordResetRequestForm();
        /**
        Изменить на zyxphpmailer
         **/
        if($model->load(Yii::$app->request->post()) && $model->sendEmail()){
            Yii::$app->controller->refresh();
        };        
    }


}