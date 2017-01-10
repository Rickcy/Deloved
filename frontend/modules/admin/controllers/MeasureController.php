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


    public function actionUpdate($id){
        
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $type = CategoryType::find()->all();
        $measure = $this->findModel($id);

        if (Yii::$app->request->isAjax){
            return $this->renderAjax('update',[
                'measure'=>$measure,
                'type'=>$type
            ]);
        }


    }

    public function actionEditMeasure($id,$name,$full_name,$type_id){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $model = Measure::findOne($id);

        if (empty($name)||empty($full_name)||empty($type_id)){
            Yii::$app->session->addFlash('danger', "Fields is Empty");

        }else{
            $model->name = $name;
            $model->full_name = $full_name;
            $model->type_id = $type_id;
            $model->save();
            Yii::$app->session->addFlash('success', "Measure Update");
        }

        return json_encode(Yii::$app->session->getAllFlashes());


    }

    protected function findModel($id){
        if (($model = Measure::findOne($id)) !== null){
            return $model;
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
