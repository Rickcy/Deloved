<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 17.08.17
 * Time: 15:00
 */

namespace app\modules\admin\controllers;


use common\controllers\AuthController;
use common\models\Attachment;
use common\models\Managers;
use common\models\NewTicket;
use common\models\NewTicketPost;
use common\models\Profile;
use common\models\Role;
use common\models\Ticket;
use common\models\TicketPost;
use common\models\TicketPostAttach;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\helpers\BaseFileHelper;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class TicketController extends AuthController
{

    public $layout = '/admin';


    public function actionIndex(){
        if (User::checkRole(['ROLE_SUPPORT'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
            $profile = User::findOne(Yii::$app->user->id)->profile;

        if (User::checkRole(['ROLE_USER']) && !$profile->isManager()) {
            $managers = Managers::find()->select(['profile_id'])->where(['account_id'=>$profile->account->id])->all();
            $ids =[];
            foreach ($managers as $manager){
                $ids[]= $manager->profile_id;
            }
            $tickets = Ticket::find()->where(['profile_id'=>$profile->id])->orWhere(['in','profile_id',$ids])->orderBy(['date_created'=>SORT_DESC])->all();
        }
        else{
            $tickets = Ticket::find()->where(['profile_id'=>$profile->id])->orderBy(['date_created'=>SORT_DESC])->all();
        }


        return $this->render('index', [
            'tickets'=>$tickets,

        ]);

    }


    /**
     * @param $id
     * @return string
     */
    public function actionUploadFile($id){

        $profile = User::findOne(Yii::$app->user->id)->profile;
        $model = new Attachment();
        if (Yii::$app->request->isAjax){
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->file = UploadedFile::getInstancesByName('File')[0];
                if (!is_dir(Yii::getAlias('@uploadDir'))) {
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir'), 0777);

                }
                if (!is_dir(Yii::getAlias('@uploadDir') . '/ticketFile/')) {
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir') . '/ticketFile/', 0777);
                }
                if (!is_dir(Yii::getAlias('@uploadDir') . '/ticketFile/' . $id . '/')) {
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir') . '/ticketFile/' . $id . '/', 0777);
                }
                $url = Yii::$app->security->generateRandomString(10) . '.' . $model->file->extension;
                $model->file->saveAs(Yii::getAlias('@uploadDir') . '/ticketFile/' . $id . '/' . $url);
                chmod(Yii::getAlias('@uploadDir') . '/ticketFile/' . $id . '/' . $url, 0777);
                $model->filePath = '/uploads/ticketFile/' . $id . '/' . $url;

                $ticketPost = new TicketPost();
                $ticketPost->post = $model->file->baseName;
                $ticketPost->profile_id = $profile->id;
                $ticketPost->ticket_id = $id;
                $ticketPost->date_created = date('Y-m-d H:i:s');
                $ticketPost->save();

                $model->save();
                $ticketPostAtt = new TicketPostAttach();
                $ticketPostAtt->profile_id = $profile->id;
                $ticketPostAtt->ticket_id = (int)$id;
                $ticketPostAtt->attachment_id = $model->id;
                $ticketPostAtt->ticket_post_id = $ticketPost->id;
                $ticketPostAtt->save();
                $transaction->commit();

            }catch (Exception $exception){
                Yii::$app->response->format = Response::FORMAT_JSON;
                $transaction->rollBack();
                return $exception->getMessage();
            }
        }
    }


    public function actionShow($id){

        $profile = User::findOne(Yii::$app->user->id)->profile;
        $ticket = $this->findModel($id);
        $asManager = false;
        if (User::checkRole(['ROLE_USER'])) {
             if(!$profile->manager){

                 $isManager = $ticket->profile->account;
                 if($isManager){
                     $asManager = $isManager->id == $profile->account->id;
                 }
             }
        }

        if(($ticket->profile_id != $profile->id && !$asManager)   && !User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_SUPPORT'])) {
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
                 throw new ForbiddenHttpException('Обращение не найдено');
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
                        throw new ForbiddenHttpException('Обращение не находится в процессе');
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
                        throw new ForbiddenHttpException('Обращение не найдено');
                    }

                    if ($asSupport && !$asOwner){
                        if(!$ticket->profile->user->online){
                            Yii::$app->common->sendMailNewMessageTicket($ticket->profile->user->email, $ticket->profile->user);
                        }
                    }

                        $post->save();
                        $new_post = new NewTicketPost();
                        $new_post->date_created = $post->date_created;
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
                    throw new ForbiddenHttpException('Обращение не найдено');
                }
                if($ticket->profile_id == $profile->id){
                    throw new ForbiddenHttpException('Ошибка при смене статуса');
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
                $otherProfile = $ticket->profile;
                if (!$asSupport){
                    throw new ForbiddenHttpException('Обращение не найдено');
                }
                if(!$otherProfile->user->online){
                    Yii::$app->common->sendMailNewStatusTicket($otherProfile->user->email, $otherProfile->user);
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
                elseif ($profile->city_id){
                    $profile_managers = Yii::$app->db->createCommand($query,[
                        ':region_id'=>$profile->city_id,
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

            Yii::$app->session->addFlash('success', Yii::t('app','Ticket created'));
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
        Yii::$app->session->addFlash('success', 'Обращение удалено');
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