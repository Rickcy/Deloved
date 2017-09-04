<?php


namespace app\modules\admin\controllers;


use common\controllers\AuthController;

class InformationController extends AuthController
{
    public $layout = '/admin';

    public function actionIndex(){


        return $this->render('index');
    }

}