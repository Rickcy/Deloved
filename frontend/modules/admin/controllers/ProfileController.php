<?php

namespace app\modules\admin\controllers;

use common\models\Region;
use common\models\User;
use Yii;
use common\models\Profile;
use common\models\search\ProfileSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
{

    public $layout ='/admin';
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
     * Lists all Profile models.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionIndex()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }


        $profiles =Profile::find()->all();

        return $this->render('index', [
           'profiles'=>$profiles
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     */


    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $model = $this->findModel($id);
        $level_id=18;
        $city_list=Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('update', [
                'model' => $model,'city_list'=>$city_list
            ]);
        }
    }


    public function actionEditProfile($id,$fio,$email,$city,$status,$date){
      
        $model=$this->findModel($id);
        if(Yii::$app->request->isAjax){
            if (!$model->validate()){
                Yii::$app->session->addFlash('danger', "Incorrect Profile!");
            }
            else{
                $model->fio=$fio;
                $model->email=$email;

                $model->chargeTill=$model->returnDate($date);
                $model->chargeStatus=$status;;
                $model->save();
                Yii::$app->session->addFlash('success', "Profile  Update!");

            }
        }
        return json_encode(Yii::$app->session->getAllFlashes());

    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
