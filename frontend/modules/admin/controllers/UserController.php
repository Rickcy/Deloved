<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\Region;
use common\models\Role;
use frontend\models\UserForm;
use Yii;
use common\models\User;

use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends AuthController
{

    public $layout ='/admin';


    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
      $users = User::find()->all();

        return $this->render('index', [
          'users'=>$users
        ]);
    }


    public function actionChangeStatus($id,$type){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        if (Yii::$app->request->isAjax) {
            $user =User::findOne($id);
            if ($type =='ps') {
                $status = $user->status == 0 ? $user->status = 1 : $user->status = 0;
                $user->save();
                return $this->renderAjax('status', ['status' => $status==1?true:false, 'statusClass' => 'publicStatus', 'iconFalse' => 'glyphicon-lock']);
            }

        }


    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */


    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $level_id=18;
        $city_list=Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();
        $model = new UserForm();
        $role = Role::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->createUser()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create',[
                'model' => $model,'role'=>$role,'city_list'=>$city_list
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
