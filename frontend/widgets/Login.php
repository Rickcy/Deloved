<?php

namespace frontend\widgets;


use common\models\LoginForm;
use Yii;
use yii\bootstrap\Widget;
use yii\helpers\Url;

class Login extends Widget
{
    public function run()
    {
        $model = new  LoginForm();

        if($model->load(Yii::$app->request->post()) && $model->login()){
            Yii::$app->controller->redirect('/admin');
        }
        return $this->render('login',['model'=>$model]);

    }


}