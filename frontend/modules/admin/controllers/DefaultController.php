<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\User;
use frontend\models\RepeatEmailConfirm;
use Yii;


/**
 * Default controller for the `admin` module
 */
class DefaultController extends AuthController
{
    public $layout='/admin';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex()
    {  $user = User::findOne(Yii::$app->user->id);
       $profile = $user->getProfiles()->one();
       $account = $user->getAccounts()->one();
       $role =$user->getRole()->one();
        return $this->render('index',['user'=>$user,'profile'=>$profile,'account'=>$account,'role'=>$role]);
    }
    
    public function actionRepeatEmail()
    {
        $user = User::findOne(Yii::$app->user->id);

        $model = new RepeatEmailConfirm();
        if ($model->load(Yii::$app->request->post()) && $model->repeatEmailConfirm()) {
            Yii::$app->session->addFlash('success', 'Повторный запрос отправлен!');
            return $this->redirect("/admin");
        } else {
            return $this->render('repeat-email', [
                'model' => $model,'user'=>$user
            ]);
        }

    }



    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
//    public function actionAddFlash(){
//        Yii::$app->session->addFlash('success', 'Повторный запрос отправлен!');
//        Yii::$app->session->addFlash('danger', 'Запрос отправлен!');
//
//
//    }
//    public function actionGetFlash(){
//
//        return json_encode(Yii::$app->session->getAllFlashes());
//
//    }
 




}
