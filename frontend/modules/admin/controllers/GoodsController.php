<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\Account;
use common\models\Condition;
use common\models\Currency;
use common\models\DeliveryMethods;
use common\models\Measure;
use common\models\PaymentMethods;
use common\models\User;
use Yii;
use common\models\Goods;
use common\models\search\GoodsSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends AuthController
{

    public $layout = '/admin';
    /**
     * Lists all Goods models.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionIndex()
    {

        if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            $goods = Goods::find()->all();

        }elseif (User::checkRole(['ROLE_USER'])){

            $account = User::findOne(Yii::$app->user->id)->getProfile()->one()->getAccount()->one();
            $goods = Goods::find()->where('account_id=:account_id',[':account_id'=>$account->id])->all();


        }else{
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        return $this->render('index', [
            'goods'=>$goods
        ]);


    }


    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        if (!User::checkRole(['ROLE_USER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $model = new Goods();
        $measure = Measure::find()->where('type_id=:type_id',[':type_id'=>1])->all();
        $currency = Currency::find()->all();
        $conditions = Condition::find()->all();
        $deliveryMethods = DeliveryMethods::find()->all();
        $paymentMethods = PaymentMethods::find()->all();
        $account = User::findOne(Yii::$app->user->id)->getProfile()->one()->getAccount()->one();
        $myCategory =$account->getCategory()->all();
      
        if ($model->load(Yii::$app->request->post())) {

            $model->date_created = time();
            $model->account_id = $account->id;
            $model->category_type_id = 1;
            $model->show_main = 0;

            $model->save();

            Yii::$app->session->addFlash('success', 'Good Created!');
            return $this->redirect(['index']);
        }
        else {
            return $this->render('create', [
                'model' => $model,
                'measure'=>$measure,
                'currency'=>$currency,
                'conditions'=>$conditions,
                'deliveryMethods'=>$deliveryMethods,
                'paymentMethods'=>$paymentMethods,
                'myCategory'=>$myCategory,
                'account'=>$account
            ]);
        }
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $model = $this->findModel($id);


        $measure = Measure::find()->where('type_id=:type_id',[':type_id'=>1])->all();
        $currency = Currency::find()->all();
        $conditions = Condition::find()->all();
        $deliveryMethods = DeliveryMethods::find()->all();
        $paymentMethods = PaymentMethods::find()->all();
        $account = User::findOne(Yii::$app->user->id)->getProfile()->one()->getAccount()->one();
        $myCategory =Account::findOne($model->account_id)->getCategory()->where('account_id=:account_id',[':account_id'=>$model->account_id])->all();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->save();

            Yii::$app->session->addFlash('success', 'Good Update!');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'measure'=>$measure,
                'currency'=>$currency,
                'conditions'=>$conditions,
                'deliveryMethods'=>$deliveryMethods,
                'paymentMethods'=>$paymentMethods,
                'myCategory'=>$myCategory,
                'account'=>$account
            ]);
        }
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionDelete($id)
    { if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])) {
        throw new ForbiddenHttpException('Доступ запрещен');
    }
        $this->findModel($id)->delete();
        Yii::$app->session->addFlash('success', 'Good Delete!');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
