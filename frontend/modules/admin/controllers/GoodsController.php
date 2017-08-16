<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\Account;
use common\models\Category;
use common\models\Condition;
use common\models\Currency;
use common\models\DeliveryMethods;
use common\models\Measure;
use common\models\NewGood;
use common\models\PaymentMethods;
use common\models\PhotoGood;
use common\models\PhotoItem;
use common\models\Profile;
use common\models\Role;
use common\models\User;
use frontend\models\UploadForm;
use Yii;
use common\models\Goods;
use common\models\search\GoodsSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

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
        $measure = Measure::find()->where('type_id=:type_id',[':type_id'=>1227])->all();
        $currency = Currency::find()->all();
        $conditions = Condition::find()->all();
        $deliveryMethods = DeliveryMethods::find()->all();
        $paymentMethods = PaymentMethods::find()->all();
        $account = User::findOne(Yii::$app->user->id)->profile->account;
        $myCategory = $account->category;
        $model->date_created = date('Y-m-d H:i');
        $model->account_id = $account->id;
        $model->category_type_id = 1227;
        $model->show_main = 0;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $transaction = \Yii::$app->db->beginTransaction();
            try{
                $model->save();
                $model->saveGoodsPhoto();
                $query = 'SELECT * FROM profile WHERE user_id IN (SELECT id FROM "user" WHERE "user".role_id =:role_id) AND id IN (SELECT profile_id FROM profile_region WHERE region_id =:region_id)';
                $profile_managers = Yii::$app->db->createCommand($query,[
                    ':region_id'=>$account->city_id,
                    ':role_id'=>ROLE::ROLE_MANAGER
                ])->queryAll();


                $good = new NewGood();
                $good->for_profile_id = Profile::ID_PROFILE_ADMIN;
                $good->account_id = $account->id;
                $good->new_good_id = $model->id;
                $good->date_created = date('Y-m-d H:i');
                $good->save();

                foreach ($profile_managers as $profile){
                    $good = new NewGood();
                    $good->for_profile_id = $profile['id'];
                    $good->account_id = $account->id;
                    $good->new_good_id = $model->id;
                    $good->date_created = date('Y-m-d H:i');
                    $good->save();

                }
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->session->addFlash('danger', $e->getMessage());
                return $this->redirect(['index']);
            }

            Yii::$app->session->addFlash('success', 'Good Created!');
            return $this->redirect(['index']);
        }
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


    public function actionUploadPhoto(){
        if (!User::checkRole(['ROLE_USER','ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
            $model = new PhotoGood();
         if (Yii::$app->request->isAjax){
            $model->photoFile = UploadedFile::getInstancesByName('photoGoodsFile')[0];
            $upl_file = $model->uploadImage();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $upl_file;
        }
    }

    public function actionDeletePhotoGood(){
        if (!User::checkRole(['ROLE_USER','ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $path  = Yii::$app->request->post('path');
        $photo = PhotoGood::findOne(['filePath'=>$path]);
        if($photo){
            $photo->delete();
        }
        unlink(Yii::getAlias('@frontend').'/web'.$path);
        return true;
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
        $photos = PhotoGood::findAll(['item_id'=>$model->id]);
        $profile = User::findOne(Yii::$app->user->id)->profile;
        if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
                Yii::$app->db
                    ->createCommand('DELETE FROM new_good 
                    WHERE for_profile_id =:profile_id 
                      AND new_good_id =:good_id', [':profile_id' => $profile->id, 'good_id' => $model->id])
                    ->execute();
        }
        $measure = Measure::find()->where('type_id=:type_id',[':type_id'=>1227])->all();
        $currency = Currency::find()->all();
        $conditions = Condition::find()->all();
        $deliveryMethods = DeliveryMethods::find()->all();
        $paymentMethods = PaymentMethods::find()->all();
        $account = User::findOne(Yii::$app->user->id)->profile->account;
        $myCategory = Account::findOne($model->account_id)->getCategory()->where('account_id=:account_id',[':account_id'=>$model->account_id])->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->date_created = date('Y-m-d H:i');
            $model->save();
            $model->saveGoodsPhoto();
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
                'account'=>$account,
                'photos'=>$photos
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
