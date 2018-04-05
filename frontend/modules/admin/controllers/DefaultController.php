<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\User;
use frontend\models\RepeatEmailConfirm;
use Yii;
use yii\web\Response;


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
    {
        $user = User::findOne(Yii::$app->user->id);
       $profile = $user->profile;
       $account = $profile->account;
       $role =$user->role;
       $lenta = Yii::$app->common->getLenta($profile->id);

       return $this->render('index',['lenta'=>$lenta,'user'=>$user,'profile'=>$profile,'account'=>$account,'role'=>$role]);

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

    public function actionGetLenta(){
        $user = User::findOne(Yii::$app->user->id);
        $profile = $user->profile;
        Yii::$app->response->format = Response::FORMAT_JSON;
        return Yii::$app->common->getLenta($profile->id);
    }


    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        $user = User::findOne(Yii::$app->user->id);
        $user->online = $user::OFFLINE;
        $user->save();
        $session = Yii::$app->session;
        $session->remove('timeZone');

        Yii::$app->user->logout();
        return $this->goHome();
    }
    


}
