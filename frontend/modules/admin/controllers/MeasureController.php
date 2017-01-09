<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\Measure;
use common\models\User;
use yii\web\ForbiddenHttpException;

class MeasureController extends AuthController
{


    public $layout = '/admin';

    public function actionIndex()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $measures = Measure::find()->all();

        return $this->render('index',['measures'=>$measures]);
    }


    public function actionCreate()
    {
        if (!User::checkRole(['ROLE_ADMIN', 'ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

    }

}
