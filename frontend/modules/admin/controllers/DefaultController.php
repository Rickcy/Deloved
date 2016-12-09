<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\User;
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
    public function actionIndex()
    {  $user = User::findOne(Yii::$app->user->id);
       $profile = $user->getProfiles()->one();
       $account = $user->getAccounts()->one();
       $role =$user->getRole()->one();
        return $this->render('index',['user'=>$user,'profile'=>$profile,'account'=>$account,'role'=>$role]);
    }
    
    public function actionConfirm()
    {   $flash=null;
        if (Yii::$app->request->isPost) {
            $user = User::findOne(Yii::$app->user->id);
            Yii::$app->common->sendMailEmailConfirm($user->email, $user);
            $flash = Yii::$app->session->addFlash('success', 'Повторный запрос отправлен!');

        }
        return $flash;
    }
    
}
