<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 01.09.17
 * Time: 7:23
 */

namespace app\modules\admin\controllers;

use common\controllers\AuthController;




class DisputeController extends AuthController
{
    public $layout = '/admin';

    public function actionIndex(){

        return $this->render('index');
    }
}