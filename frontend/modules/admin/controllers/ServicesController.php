<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\Account;
use common\models\Currency;
use common\models\Measure;
use common\models\NewService;
use common\models\PaymentMethods;
use common\models\PhotoService;
use common\models\Profile;
use common\models\Role;
use common\models\User;
use Yii;
use common\models\Services;
use common\models\search\ServicesSearch;
use yii\base\Exception;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;


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

            $account = User::findOne(Yii::$app->user->id)->profile->account;
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
        $model->date_created = date('Y-m-d H:i');
        $model->account_id = $account->id;
        $model->category_type_id = 1342;
        $model->show_main = 0;

        if ($model->load(Yii::$app->request->post())) {
            $transaction = \Yii::$app->db->beginTransaction();
            try{
                $query = 'SELECT * FROM profile WHERE user_id IN (SELECT id FROM "user" WHERE "user".role_id =:role_id) AND id IN (SELECT profile_id FROM profile_region WHERE region_id =:region_id)';
                $profile_managers = Yii::$app->db->createCommand($query,[
                    ':region_id'=>$account->city_id,
                    ':role_id'=>ROLE::ROLE_MANAGER
                ])->queryAll();
                $model->save();
                $model->saveServicePhoto();

                $service = new NewService();
                $service->for_profile_id = Profile::ID_PROFILE_ADMIN;
                $service->account_id = $account->id;
                $service->new_service_id = $model->id;
                $service->date_created = date('Y-m-d H:i');
                $service->save();

                foreach ($profile_managers as $profile){
                    $service = new NewService();
                    $service->account_id = $account->id;
                    $service->for_profile_id = $profile['id'];
                    $service->new_service_id = $model->id;
                    $service->date_created = date('Y-m-d H:i');
                    $service->save();
                }
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->session->addFlash('danger', $e->getMessage());
                return $this->redirect(['index']);
            }
            Yii::$app->session->addFlash('success', 'Service Created!');
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


    public function actionUploadPhoto(){
        if (!User::checkRole(['ROLE_USER','ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $model = new PhotoService();
        if (Yii::$app->request->isAjax){
            $model->photoFile = UploadedFile::getInstancesByName('photoServiceFile')[0];
            $upl_file = $model->uploadImage();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $upl_file;
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
        $photos = PhotoService::findAll(['item_id'=>$model->id]);
        $profile = User::findOne(Yii::$app->user->id)->profile;
        if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            Yii::$app->db
                ->createCommand('DELETE FROM new_service 
                    WHERE for_profile_id =:profile_id 
                      AND new_service_id =:service_id', [':profile_id' => $profile->id, 'service_id' => $model->id])
                ->execute();
        }
        $measure = Measure::find()->where('type_id=:type_id',[':type_id'=>1342])->all();
        $currency = Currency::find()->all();
        $paymentMethods = PaymentMethods::find()->all();
        $account = User::findOne(Yii::$app->user->id)->profile->account;
        $myCategory =Account::findOne($model->account_id)->getCategory()->where(['account_id'=>$model->account_id])->all();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = \Yii::$app->db->beginTransaction();
            try{
                $model->date_created = date('Y-m-d H:i');
                $model->save();
                $model->saveServicePhoto();
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->session->addFlash('danger', $e->getMessage());
                return $this->redirect(['index']);
            }

            Yii::$app->session->addFlash('success', 'Service Update!');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'measure'=>$measure,
                'currency'=>$currency,
                'paymentMethods'=>$paymentMethods,
                'myCategory'=>$myCategory,
                'account'=>$account,
                'photos'=>$photos
            ]);
        }
    }


    public function actionDeletePhotoService(){
        if (!User::checkRole(['ROLE_USER','ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $path  = Yii::$app->request->post('path');
        $photo = PhotoService::findOne(['filePath'=>$path]);
        if($photo){
            $photo->delete();
        }
        unlink(Yii::getAlias('@frontend').'/web'.$path);
        return true;
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
