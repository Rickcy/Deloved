<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\CategoryType;
use common\models\Currency;
use common\models\User;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

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

        $type = CategoryType::find()->all();
        $currency = new Currency();
        if ($currency->load(Yii::$app->request->post())){
            $currency->save();
            Yii::$app->session->addFlash('success', Yii::t('app', 'New Currency created'));
            return $this->redirect(['index']);
        }
        return $this->render('create',[
            'currency'=>$currency,'type'=>$type
        ]);

    }

    public function actionUpdate($id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $currency = $this->findModel($id);

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('update', [
                'currency' => $currency
            ]);
        }

    }


    public function actionEditCurrency($id,$code,$name){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $model=Currency::findOne($id);

        if (empty($code)||empty($name)){
            Yii::$app->session->addFlash('danger', Yii::t('app', 'Fill in all the fields'));
        }else{
            $model->code = $code;
            $model->name = $name;
            $model->save();
            Yii::$app->session->addFlash('success', "Currency Update");
        }
        return json_encode(Yii::$app->session->getAllFlashes());
    }

    protected function findModel($id)
    {
        if (($model = Currency::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    }
