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
use common\models\NewTicketPost;
use common\models\Profile;
use common\models\Role;
use common\models\Ticket;
use common\models\TicketPost;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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
            'tickets'=>$tickets,

        ]);

    }

    public function actionShow($id){

        $profile = User::findOne(Yii::$app->user->id)->profile;
        $ticket = $this->findModel($id);
        if($ticket->profile_id != $profile->id  && !User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_SUPPORT'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $ticketPost = $ticket->getTicketPosts()->orderBy(['date_created'=>SORT_ASC])->all();
        $model = new TicketPost();
        if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_SUPPORT'])) {
            Yii::$app->db
                ->createCommand('DELETE FROM new_ticket 
                    WHERE for_profile_id =:profile_id 
                      AND new_ticket_id =:new_ticket_id', [':profile_id' => $profile->id, 'new_ticket_id' => $ticket->id])
                ->execute();
        }

            Yii::$app->db
                ->createCommand('DELETE FROM new_ticket_post 
                    WHERE for_profile_id =:profile_id 
                      AND ticket_id =:ticket_id', [':profile_id' => $profile->id, 'ticket_id' => $ticket->id])
                ->execute();

        return $this->render('show',[
            'ticket'=>$ticket,
            'posts'=>$ticketPost,
            'model'=>$model
        ]);
    }


    public function actionGetUnreadPosts(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $postId = Yii::$app->request->post('postId');
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $ticketPost = TicketPost::findOne($postId);
            $ticket = Ticket::findOne($ticketPost->ticket_id);
            $asOwner = $profile->id == $ticket->profile_id;

             if (!$asOwner  && !User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_SUPPORT'])){
                 throw new ForbiddenHttpException('Ticket not exist');
             }
            NewTicketPost::deleteAll(['for_profile_id'=>$profile->id,'ticket_id'=>$ticketPost->ticket_id]);
            $transaction->commit();
        }catch (Exception $e){
            $transaction->rollBack();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error'=>$e->getMessage()];
        }
        $ticketPosts = TicketPost::find()->where(['>','date_created', $ticketPost->date_created])->andWhere(['ticket_id'=>$ticket->id])->orderBy(['date_created'=>SORT_ASC])->all();
        return $this->renderPartial('partials/posts',['posts'=>$ticketPosts]);
    }

    public function actionSendMessage(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $post = new TicketPost();
        $post->profile_id = $profile->id;
        $post->status = null;
        $post->date_created = date('Y-m-d H:i:s');
        if ($post->load(Yii::$app->request->post()) && $post->validate()){
                $transaction = Yii::$app->db->beginTransaction();
                try{
                    $ticket = Ticket::findOne($post->ticket_id);
                    if($ticket->status != Ticket::STATUS_PROCESSING){
                        throw new ForbiddenHttpException('Ticket status is not in processing');
                    }
                    $asOwner = $profile->id == $ticket->profile_id;
                    $asSupport  = $ticket->support_id == $profile->id;
                    if (!$asSupport && $asOwner){
                        $for_profile_id = $ticket->support_id;
                    }
                    elseif ($asSupport && !$asOwner){
                        $for_profile_id = $ticket->profile_id;
                    }
                    elseif (!$asSupport && !$asOwner){
                        throw new ForbiddenHttpException('Ticket not exist');
                    }
                        $post->save();
                        $new_post = new NewTicketPost();
                        $new_post->date_created = $post->date_created;
                        $new_post->ticket_id = $ticket->id;
                        $new_post->ticket_id = $ticket->id;
                        $new_post->for_profile_id = $for_profile_id;
                        $new_post->save();
                    $lastsPosts = TicketPost::findOne($post->last_post_id);
                    $transaction->commit();
                }catch (Exception $e){
                    $transaction->rollBack();
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ['error'=>$e->getMessage()];
                }
                NewTicketPost::deleteAll(['for_profile_id'=>$profile->id,'ticket_id'=>$post->ticket_id]);

                Yii::$app->response->format = Response::FORMAT_JSON;
                $ticketPosts = TicketPost::find()->where(['>','date_created', $lastsPosts->date_created])->andWhere(['ticket_id'=>$ticket->id])->orderBy(['date_created'=>SORT_ASC])->all();
                return $this->renderPartial('partials/posts',['posts'=>$ticketPosts]);
        }
    }


    public function actionChangeStatus(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $ticketPost = new TicketPost();
        $ticketPost->post ='change-status';
        $ticketPost->profile_id = $profile->id;
        $ticketPost->date_created = date('Y-m-d H:i:s');
        if($ticketPost->load(Yii::$app->request->post()) && $ticketPost->validate()){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $ticket = Ticket::findOne($ticketPost->ticket_id);
                if($ticket->status == Ticket::STATUS_CLOSED){
                    throw new ForbiddenHttpException('Ticket status is closed');
                }
                if($ticket->profile_id == $profile->id){
                    throw new ForbiddenHttpException('Error in change status');
                }
                if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_SUPPORT'])) {
                    if($ticket->status == Ticket::STATUS_NEW){
                        $ticket->support_id = $profile->id;
                        $ticket->status = $ticketPost->status;
                    }
                    else{
                        $ticket->status = $ticketPost->status;
                    }
                }

                $asSupport  = $ticket->support_id == $profile->id;

                if (!$asSupport){
                    throw new ForbiddenHttpException('Ticket not exist');
                }


                $ticketPost->save();
                $ticket->save();
                $for_profile_id = $ticket->profile_id;
                $new_post = new NewTicketPost();
                $new_post->date_created = $ticketPost->date_created;
                $new_post->ticket_id = $ticket->id;
                $new_post->ticket_id = $ticket->id;
                $new_post->for_profile_id = $for_profile_id;
                $new_post->save();
                $lastsPosts = TicketPost::findOne($ticketPost->last_post_id);
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error'=>$e->getMessage()];
            }

            NewTicketPost::deleteAll(['for_profile_id'=>$profile->id,'ticket_id'=>$ticketPost->ticket_id]);

            Yii::$app->response->format = Response::FORMAT_JSON;
            $ticketPosts = TicketPost::find()->where(['>','date_created', $lastsPosts->date_created])->andWhere(['ticket_id'=>$ticket->id])->orderBy(['date_created'=>SORT_ASC])->all();
            return $this->renderPartial('partials/posts',['posts'=>$ticketPosts]);

        }
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
                $new_post = new TicketPost();
                $new_post->post = $model->detailText;
                if(!$new_post->post){
                    $new_post->post = $model->name;
                }
                $new_post->date_created = date('Y-m-d H:i:s');
                $new_post->ticket_id = $model->id;
                $new_post->profile_id = $model->profile_id;
                $new_post->save();

                $new_ticket = new NewTicket();
                $new_ticket->date_created = date('Y-m-d H:i');
                $new_ticket->new_ticket_id = $model->id;
                $new_ticket->for_profile_id = Profile::ID_PROFILE_ADMIN;
                $new_ticket->save();

                $roles = [ROLE::ROLE_MANAGER,ROLE::ROLE_SUPPORT];
                $query = 'SELECT * FROM profile WHERE user_id IN (SELECT id FROM "user" WHERE "user".role_id IN ('.implode(',',$roles).')) AND id IN (SELECT profile_id FROM profile_region WHERE region_id =:region_id)';
                if ($profile->account){
                    $profile_managers = Yii::$app->db->createCommand($query,[
                        ':region_id'=>$profile->account->city_id,
                    ])->queryAll();
                }
                else{

                    $query = 'SELECT * FROM profile WHERE user_id IN (SELECT id FROM "user" WHERE "user".role_id IN ('.implode(',',$roles).'))';
                    $profile_managers = Yii::$app->db->createCommand($query)->queryAll();
                }

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
        return $this->redirect(['show-all']);
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