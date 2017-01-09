<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\Currency;
use common\models\User;
use yii\web\ForbiddenHttpException;

class CurrencyController extends AuthController
{


    public $layout = '/admin';


    public function actionIndex()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $currency = Currency::find()->all();
        return $this->render('index',['currency'=>$currency]);
    }

    public function actionCreate()
    {
        if (!User::checkRole(['ROLE_ADMIN', 'ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

    }


    }
