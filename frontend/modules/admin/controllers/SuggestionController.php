<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\Suggestion;
use common\models\SuggestionCat;
use common\models\User;
use Yii;
use yii\helpers\Json;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class SuggestionController extends AuthController
{

    public $layout = '/admin';

    public function actionCreateCategory($cat_name)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        if (empty($cat_name)){
            Yii::$app->session->addFlash('danger', Yii::t('app','NO'));
        }else{
            $model = new SuggestionCat();
            $model->name=$cat_name;
            $model->save();
            $id_model = $model->id;
            Yii::$app->session->addFlash('success', 'Category Created');
        }
        $mes = [Yii::$app->session->getAllFlashes(),'id_model'=>$id_model];
        return Json::encode($mes);

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

        $suggestions = Suggestion::find()->all();


        return $this->render('show',['suggestions'=>$suggestions]);
    }

    public function actionUpdate($id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }


        $model = SuggestionCat::findOne($id);

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

    }


    public function actionEditCategory($id,$name){
        if (empty($name)){
            Yii::$app->session->addFlash('danger', 'Empty');
        }else{
            $model = SuggestionCat::findOne($id);
            $model->name = $name;
            $model->save();
            Yii::$app->session->addFlash('success', 'Category Updater');
        }

        return json_encode(Yii::$app->session->getAllFlashes());
    }



    public function actionSugDelete($id){
        Suggestion::findOne($id)->delete();

        Yii::$app->session->addFlash('success', 'Suggestion Delete!');
        return $this->redirect(['show']);

    }

    public function actionDelete($id){
        SuggestionCat::findOne($id)->delete();

        Yii::$app->session->addFlash('success', 'Category Delete!');
        return $this->redirect(['index']);

    }


    protected function findModel($id){
        if (($model = Suggestion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
