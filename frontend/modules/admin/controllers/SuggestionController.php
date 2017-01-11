<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\Suggestion;
use common\models\SuggestionCat;
use common\models\User;
use yii\web\ForbiddenHttpException;

class SuggestionController extends AuthController
{

    public $layout = '/admin';

    public function actionCreate()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }



        return $this->render('create');
    }

    public function actionIndex()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        
        
        $suggestion_cat = SuggestionCat::find()->all();

        return $this->render('index',['suggestion_cat'=>$suggestion_cat]);
    }

    public function actionShow()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $suggestion = Suggestion::find()->all();


        return $this->render('show',['suggestion'=>$suggestion]);
    }

    public function actionUpdate()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }


        return $this->render('update');
    }

}
