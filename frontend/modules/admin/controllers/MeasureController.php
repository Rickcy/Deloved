<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\CategoryType;
use common\models\Measure;
use common\models\User;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

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

        $type = CategoryType::find()->all();
        $measure = new Measure();

        if ($measure->load(Yii::$app->request->post())){
            $measure->save();
            Yii::$app->session->addFlash('success', "Measure Created");
            return $this->redirect(['index']);
        }

        return $this->render('create',['measure'=>$measure,'type'=>$type]);

    }


    public function actionDelete($id){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        Measure::findOne($id)->delete();
        Yii::$app->session->addFlash('success', 'Measure Delete!');
        return $this->redirect(['index']);

    }


    protected function findModel($id){
        if (($model = Measure::findOne($id)) !== null){
            return $model;
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
