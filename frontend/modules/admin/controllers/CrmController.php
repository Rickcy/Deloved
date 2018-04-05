<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 20.02.18
 * Time: 21:35
 */

namespace app\modules\admin\controllers;


use common\controllers\AuthController;
use common\models\Deal;
use common\models\Managers;
use common\models\Profile;
use common\models\Region;
use common\models\TaskComments;
use common\models\Tasks;
use common\models\User;
use frontend\models\ManagerForm;
use frontend\models\TaskForm;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CrmController extends AuthController
{
    public $layout = '/admin';

    public function actionManagers(){
        if (!User::checkRole(['ROLE_USER']) ||  (User::findOne(Yii::$app->user->id))->profile->isManager()) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $account = (User::findOne(Yii::$app->user->id))->profile->account;
        $managers = Managers::find()->where(['account_id'=>$account->id])->all();

        return $this->render('managers',['managers'=>$managers]);
    }

    public function actionCreateManager()
    {
        if (!User::checkRole(['ROLE_USER']) ||  (User::findOne(Yii::$app->user->id))->profile->isManager()) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $model = new ManagerForm();
        if(Yii::$app->request->isPost){
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->createManager();
                return $this->redirect(['managers']);
            } else {
                return $this->redirect(['managers']);

            } 
        }
        return $this->render('create-manager', ['model' => $model]);
       
    }



    public function actionTask($id){
        $task = Tasks::findOne($id);
        $task_comment = TaskComments::findOne(['task_id'=>$id]);
        $profile = User::findOne(Yii::$app->user->id)->profile;
        if (User::checkRole(['ROLE_USER']) &&  !(User::findOne(Yii::$app->user->id))->profile->isManager()) {
            $model = new TaskForm();
            if(Yii::$app->request->isPost){
                if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                    $model->editTask($task->id);
                    return $this->redirect(['tasks']);
                } else {
                    return $this->redirect(['tasks']);

                }
            }

            $managers = Managers::find()->where(['account_id' => $profile->account->id])->all();
            $ids = [];
            $profiles = [];
            foreach ($managers as $manager) {
                $ids[] = $manager->profile_id;
                $profiles[] = $manager->profile;
            }
            $deals = Deal::find()->where(['buyer_id' => $profile->id])->orWhere(['seller_id' => $profile->id])->orWhere(['in', 'buyer_id', $ids])->orWhere(['in', 'seller_id', $ids])->orderBy(['status' => SORT_ASC])->all();
            return $this->render('task',['task'=>$task,'task_comment'=>$task_comment, 'deals' => $deals, 'model' => $model, 'managers' => $profiles]);
        }
        else{

            Yii::$app->db
                ->createCommand('DELETE FROM new_task 
                    WHERE for_profile_id =:profile_id 
                      AND task_id =:task_id', [':profile_id' => $profile->id, 'task_id' => $task->id])
                ->execute();

            return $this->render('task',['task'=>$task,'task_comment'=>$task_comment]);
        }

    }


    public function actionTasks(){
        $profile = (User::findOne(Yii::$app->user->id))->profile;
        if (!User::checkRole(['ROLE_USER']) ||  (User::findOne(Yii::$app->user->id))->profile->isManager()) {
            $tasks = Tasks::find()->where(['manager_id'=>$profile->id])->all();
        }
        else{
            $account = $profile->account;
            $tasks = Tasks::find()->where(['account_id'=>$account->id])->all();
        }


        return $this->render('tasks',['tasks'=>$tasks]);
    }


    public function actionCreateTask(){
        if (!User::checkRole(['ROLE_USER']) ||  (User::findOne(Yii::$app->user->id))->profile->isManager()) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $model = new TaskForm();
        if(Yii::$app->request->isPost){
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->createTask();
                return $this->redirect(['tasks']);
            } else {
                return $this->redirect(['tasks']);

            }
        }
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $managers = Managers::find()->where(['account_id'=>$profile->account->id])->all();
        $ids =[];
        $profiles = [];
        foreach ($managers as $manager){
            $ids[]= $manager->profile_id;
            $profiles[]= $manager->profile;
        }
        $deals = Deal::find()->where(['buyer_id'=>$profile->id])->orWhere(['seller_id'=>$profile->id])->orWhere(['in','buyer_id',$ids])->orWhere(['in','seller_id',$ids])->orderBy(['status'=>SORT_ASC])->all();



        return $this->render('create-tasks', ['model' => $model,'deals'=>$deals,'managers'=>$profiles]);
    }


    public function actionDeleteManager($id){
        if (!User::checkRole(['ROLE_USER']) ||  (User::findOne(Yii::$app->user->id))->profile->isManager()) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        Profile::findOne($this->findModel($id)->profile_id)->user->delete();
        $this->findModel($id)->delete();

        Yii::$app->session->addFlash('success', 'Менеджер удален');
        return $this->redirect(['managers']);
    }


    public function actionChangeStatus(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $task_id = Yii::$app->request->post('task');
        $task = Tasks::findOne($task_id);
        $task->status = $id;
        $task->date_created = date('Y-m-d H:i:s');
        $task->save();
        return true;
    }

    public function actionDeleteTask($id){
        if (!User::checkRole(['ROLE_USER']) ||  (User::findOne(Yii::$app->user->id))->profile->isManager()) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $task = Tasks::findOne($id);
        TaskComments::findOne(['task_id'=>$id])->delete();
        $deal = Deal::findOne($task->deal_id);
        if($deal){
            if($deal->seller_id == $task->manager_id){
                $deal->seller_id = $profile->id;
                $deal->save();
            }
            elseif($deal->buyer_id == $task->manager_id){
                $deal->buyer_id = $profile->id;
                $deal->save();
            }
        }
        $task->delete();


        Yii::$app->session->addFlash('success', 'Задача удалена');
        return $this->redirect(['tasks']);
    }


    protected function findModel($id){
        if (!User::checkRole(['ROLE_USER']) ||  (User::findOne(Yii::$app->user->id))->profile->isManager()) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }


        if (($model = Managers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}