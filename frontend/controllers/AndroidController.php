<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 01.03.18
 * Time: 0:37
 */

namespace frontend\controllers;


use common\models\User;
use yii\web\Controller;
use yii\web\Response;

class AndroidController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionGetToken(){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return [\Yii::$app->request->csrfParam =>\Yii::$app->request->csrfToken];
    }

    public function actionLogin(){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $params = \Yii::$app->request->post();
        $user = User::findByUsername($params['login']);
        if ($user && $user->validatePassword($params['password'])) {
            return true;
        } else {
            return false;
        }
    }

}