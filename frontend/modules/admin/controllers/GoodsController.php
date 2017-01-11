<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
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
            $goods = Goods::find()->where('account_id=:account_id',[':account_id'=>$account->id]);
            $goods ==null?:$goods=[];

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
     */
    public function actionCreate()
    {
        $model = new Goods();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
