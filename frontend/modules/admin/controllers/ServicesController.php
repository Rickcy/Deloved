<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\Account;
use common\models\Currency;
use common\models\Measure;
use common\models\PaymentMethods;
use common\models\User;
use Yii;
use common\models\Services;
use common\models\search\ServicesSearch;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;


/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends AuthController
{


    public $layout = '/admin';

    /**
     * Lists all Services models.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionIndex()
    {
        if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            $services = Services::find()->all();

        }elseif (User::checkRole(['ROLE_USER'])){

            $account = User::findOne(Yii::$app->user->id)->getProfile()->one()->getAccount()->one();
            $services = Services::find()->where('account_id=:account_id',[':account_id'=>$account->id])->all();


        }else{
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        return $this->render('index', [
            'services'=>$services
        ]);
    }

    /**
     * Creates a new Services model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionCreate()
    {
        if (!User::checkRole(['ROLE_USER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }


        $model = new Services();
        $measure = Measure::find()->where('type_id=:type_id',[':type_id'=>1342])->all();
        $currency = Currency::find()->all();
        $paymentMethods = PaymentMethods::find()->all();
        $account = User::findOne(Yii::$app->user->id)->profile->account;
        $myCategory =$account->category;
        $model->date_created = time();
        $model->account_id = $account->id;
        $model->category_type_id = 1342;
        $model->show_main = 0;

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            Yii::$app->session->addFlash('success', 'Good Created!');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'measure'=>$measure,
                'currency'=>$currency,
                'paymentMethods'=>$paymentMethods,
                'myCategory'=>$myCategory,
                'account'=>$account
            ]);
        }
    }

    /**
     * Updates an existing Services model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {

        if (!User::checkRole(['ROLE_USER','ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $model = $this->findModel($id);

        $measure = Measure::find()->where('type_id=:type_id',[':type_id'=>1342])->all();
        $currency = Currency::find()->all();
        $paymentMethods = PaymentMethods::find()->all();
        $account = User::findOne(Yii::$app->user->id)->profile->account;
        $myCategory =Account::findOne($model->account_id)->getCategory()->where(['account_id'=>$model->account_id])->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            Yii::$app->session->addFlash('success', 'Service Update!');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'measure'=>$measure,
                'currency'=>$currency,
                'paymentMethods'=>$paymentMethods,
                'myCategory'=>$myCategory,
                'account'=>$account
            ]);
        }
    }

    /**
     * Deletes an existing Services model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionDelete($id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])) {
        throw new ForbiddenHttpException('Доступ запрещен');
    }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Services model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Services the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Services::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
