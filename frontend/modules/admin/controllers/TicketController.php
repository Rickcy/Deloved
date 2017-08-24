<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 17.08.17
 * Time: 15:00
 */

namespace app\modules\admin\controllers;


use common\controllers\AuthController;
use common\models\NewTicket;
use common\models\Profile;
use common\models\Role;
use common\models\Ticket;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class TicketController extends AuthController
{

    public $layout = '/admin';


    public function actionIndex(){
        if (User::checkRole(['ROLE_SUPPORT'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
            $profile = User::findOne(Yii::$app->user->id)->profile;
            $tickets = Ticket::find()->where(['profile_id'=>$profile->id])->orderBy(['date_created'=>SORT_DESC])->all();

        return $this->render('index', [
            'tickets'=>$tickets
        ]);

    }


    public function actionCreate(){
        if (User::checkRole(['ROLE_SUPPORT'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $profile = (User::findOne(Yii::$app->user->id))->profile;
        $model = new Ticket();
        $model->status = $model::STATUS_NEW;
        $model->profile_id = $profile->id;
        $model->date_created = date('Y-m-d H:i');

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $model->save();
                $new_ticket = new NewTicket();
                $new_ticket->date_created = date('Y-m-d H:i');
                $new_ticket->new_ticket_id = $model->id;
                $new_ticket->for_profile_id = Profile::ID_PROFILE_ADMIN;
                $new_ticket->save();

                $query = 'SELECT * FROM profile WHERE user_id IN (SELECT id FROM "user" WHERE "user".role_id =:role_id) AND id IN (SELECT profile_id FROM profile_region WHERE region_id =:region_id)';
                $profile_managers = Yii::$app->db->createCommand($query,[
                    ':region_id'=>$profile->account->city_id,
                    ':role_id'=>ROLE::ROLE_MANAGER
                ])->queryAll();

                foreach ($profile_managers as $profile){
                    $new_ticket = new NewTicket();
                    $new_ticket->date_created = date('Y-m-d H:i');
                    $new_ticket->new_ticket_id = $model->id;
                    $new_ticket->for_profile_id = $profile['id'];
                    $new_ticket->save();
                }
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->session->addFlash('danger', $e->getMessage());
                return $this->redirect(['index']);
            }

            Yii::$app->session->addFlash('success', 'Ticket Created!');
            return $this->redirect(['index']);

        }
        return $this->render('create', [
            'model'=>$model
        ]);
    }


    public function actionShowAll(){
        if (User::checkRole(['ROLE_USER','ROLE_MEDIATOR','ROLE_JUDGE','ROLE_JURIST'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $tickets = Ticket::find()->orderBy(['date_created'=>SORT_DESC])->all();
        return $this->render('show-all', [
            'tickets'=>$tickets
        ]);
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
    { if (!User::checkRole(['ROLE_ADMIN','ROLE_SUPPORT'])) {
        throw new ForbiddenHttpException('Доступ запрещен');
    }
        $this->findModel($id)->delete();
        Yii::$app->session->addFlash('success', 'Ticket Delete!');
        return $this->redirect(['index']);
    }



    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ticket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ticket::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}