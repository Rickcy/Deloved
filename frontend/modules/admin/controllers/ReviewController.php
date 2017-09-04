<?php


namespace app\modules\admin\controllers;;


use common\controllers\AuthController;

class ReviewController extends AuthController
{
    public $layout = '/admin';

    public function actionIndex(){

        return $this->render('index');
    }
}