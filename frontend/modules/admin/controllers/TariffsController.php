<?php

namespace app\modules\admin\controllers;

use common\models\Currency;
use common\models\Tariffs;
use common\models\User;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class TariffsController extends \yii\web\Controller
{

    public $layout = '/admin';


    public function actionCreate()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $currency = Currency::find()->all();

        $tariff = new Tariffs();

        if ($tariff->load(Yii::$app->request->post())){
            $tariff->save();
            Yii::$app->session->addFlash('success', "Тариф создан");
            return $this->redirect(['index']);
        }

        return $this->render('create',['currency'=>$currency,'tariff'=>$tariff]);
    }

    public function actionIndex()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $tariffs = Tariffs::find()->all();


        
        return $this->render('index',['tariffs'=>$tariffs]);
    }

    public function actionUpdate($id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $currency = Currency::find()->all();
        $tariff = $this->findModel($id);
        
        if (Yii::$app->request->isAjax){
            return $this->renderAjax('update',[
               'tariff'=>$tariff,
               'currency'=>$currency
            ]);
        }

        return $this->render('update');
    }
    
    
    public function actionEditTariff($id,$name,$price,$months,$currency_id){
        
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $model = Tariffs::findOne($id);

        if (empty($name)||empty($price)||empty($months)||empty($currency_id)){
            Yii::$app->session->addFlash('danger', "Поля пустые");
        }else{
            $model->name = $name;
            $model->price = $price;
            $model ->months = $months;
            $model->currency_id = $currency_id;
            $model->save();
            Yii::$app->session->addFlash('success', "Тариф обновлен");

        }

        return json_encode(Yii::$app->session->getAllFlashes());

    }


    protected function findModel($id){
        if (($model = Tariffs::findOne($id)) !== null){
            return $model;
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionDelete($id){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        Tariffs::findOne($id)->delete();
        Yii::$app->session->addFlash('success', 'Тариф удален');
        return $this->redirect(['index']);

    }

}
