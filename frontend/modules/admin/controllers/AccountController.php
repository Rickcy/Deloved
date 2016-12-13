<?php

namespace app\modules\admin\controllers;

use common\models\Logo;
use common\models\User;
use Yii;
use common\models\Account;
use common\models\search\AccountSearch;
use yii\helpers\BaseFileHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends Controller
{


    public $layout = '/admin';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Account models.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionIndex(){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Account model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionView($id){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
        throw new ForbiddenHttpException('Доступ запрещен');
    }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionCreate(){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $model = new Account();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionDelete($id){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Account the loaded model
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionShow(){
        if (!User::checkRole(['ROLE_USER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $model=User::findOne(Yii::$app->user->id);
        $account=$model->getAccounts()->one();
        $logo=new Logo();
        return $this->render('show',[
            'account'=>$account,'logo'=>$logo
        ]);
    }

    public function actionFileUploadGeneral(){
        $account = User::findOne(Yii::$app->user->id);
        $model = new Logo();

        $res=null;
            if (Yii::$app->request->isPost) {
                $model->image_file = UploadedFile::getInstance($model, 'image_file');
                
                $res =$model->uploadMainImage($account->id);



        }
        return json_encode($res);
    }



    public function actionEditNew($value,$prop){
        
        $account = User::findOne(Yii::$app->user->id)->getAccounts()->one();

        if (Yii::$app->request->isPost) {

            $account->$prop =$value;
            Yii::$app->session->addFlash('success', 'Успешно изменен');
            }
            $account->save();
            return json_encode(Yii::$app->session->getAllFlashes());



    }


}
