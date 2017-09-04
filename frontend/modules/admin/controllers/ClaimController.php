<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 01.09.17
 * Time: 7:24
 */

namespace app\modules\admin\controllers;


use common\controllers\AuthController;

class ClaimController extends AuthController
{
    public $layout = '/admin';

    public function actionIndex(){

        return $this->render('index');
    }
}