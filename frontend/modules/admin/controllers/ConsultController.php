<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 01.09.17
 * Time: 7:26
 */

namespace app\modules\admin\controllers;


use common\controllers\AuthController;
use common\models\Attachment;
use common\models\Consult;
use common\models\ConsultPost;
use common\models\ConsultPostAttach;
use common\models\Managers;
use common\models\NewConsult;
use common\models\NewConsultPost;
use common\models\Profile;
use common\models\Role;
use common\models\User;
use Exception;
use Yii;
use yii\helpers\BaseFileHelper;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class ConsultController extends AuthController
{
    public $layout = '/admin';

    public function actionIndex(){
        if (User::checkRole(['ROLE_MEDIATOR','ROLE_JUDGE','ROLE_SUPPORT'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $profile = User::findOne(Yii::$app->user->id)->profile;

        if (User::checkRole(['ROLE_USER']) && !$profile->isManager()) {
            $managers = Managers::find()->select(['profile_id'])->where(['account_id'=>$profile->account->id])->all();
            $ids =[];
            foreach ($managers as $manager){
                $ids[]= $manager->profile_id;
            }
            $consults = Consult::find()->where(['profile_id'=>$profile->id])->orWhere(['in','profile_id',$ids])->orderBy(['date_created'=>SORT_DESC])->all();
        }
        elseif (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JURIST'])) {
            $consults = Consult::find()->orderBy(['date_created'=>SORT_DESC])->all();
        }
        else{
            $consults = Consult::find()->where(['profile_id'=>$profile->id])->orderBy(['date_created'=>SORT_DESC])->all();
        }

        return $this->render('index',['consults'=>$consults]);
    }


    public function actionShow($id){

        $profile = User::findOne(Yii::$app->user->id)->profile;
        $consult = $this->findModel($id);

        $asManager = false;
        if (User::checkRole(['ROLE_USER'])) {
            if(!$profile->manager){

                $isManager = $consult->profile->account;
                if($isManager){
                    $asManager = $isManager->id == $profile->account->id;
                }
            }
        }

        if(($consult->profile_id != $profile->id  && !$asManager )&& !User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JURIST'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $consultPost = $consult->getConsultPosts()->orderBy(['date_created'=>SORT_ASC])->all();
        $model = new ConsultPost();
        if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JURIST'])) {
            Yii::$app->db
                ->createCommand('DELETE FROM new_consult 
                    WHERE for_profile_id =:profile_id 
                      AND new_consult_id =:new_consult_id', [':profile_id' => $profile->id, 'new_consult_id' => $consult->id])
                ->execute();
        }

        Yii::$app->db
            ->createCommand('DELETE FROM new_consult_post 
                    WHERE for_profile_id =:profile_id 
                      AND consult_id =:consult_id', [':profile_id' => $profile->id, 'consult_id' => $consult->id])
            ->execute();

        return $this->render('show',[
            'consult'=>$consult,
            'posts'=>$consultPost,
            'model'=>$model
        ]);
    }

    public function actionUploadFile($id){
        if (!User::checkRole(['ROLE_USER','ROLE_ADMIN','ROLE_MANAGER','ROLE_JURIST'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $model = new Attachment();
        if (Yii::$app->request->isAjax){
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->file = UploadedFile::getInstancesByName('File')[0];
                if (!is_dir(Yii::getAlias('@uploadDir'))) {
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir'), 0777);

                }
                if (!is_dir(Yii::getAlias('@uploadDir') . '/consultFile/')) {
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir') . '/consultFile/', 0777);
                }
                if (!is_dir(Yii::getAlias('@uploadDir') . '/consultFile/' . $id . '/')) {
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir') . '/consultFile/' . $id . '/', 0777);
                }
                $url = Yii::$app->security->generateRandomString(10) . '.' . $model->file->extension;
                $model->file->saveAs(Yii::getAlias('@uploadDir') . '/consultFile/' . $id . '/' . $url);
                chmod(Yii::getAlias('@uploadDir') . '/consultFile/' . $id . '/' . $url, 0777);
                $model->filePath = '/uploads/consultFile/' . $id . '/' . $url;

                $consultPost = new ConsultPost();
                $consultPost->post = $model->file->baseName;
                $consultPost->profile_id = $profile->id;
                $consultPost->consult_id = $id;
                $consultPost->date_created = date('Y-m-d H:i:s');
                $consultPost->save();

                $model->save();
                $consultPostAtt = new ConsultPostAttach();
                $consultPostAtt->profile_id = $profile->id;
                $consultPostAtt->consult_id = (int)$id;
                $consultPostAtt->attachment_id = $model->id;
                $consultPostAtt->consult_post_id = $consultPost->id;
                $consultPostAtt->save();
                $transaction->commit();

            }catch (Exception $exception){
                Yii::$app->response->format = Response::FORMAT_JSON;
                $transaction->rollBack();
                return $exception->getMessage();
            }
        }
    }

    public function actionCreate(){
        if (!User::checkRole(['ROLE_USER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $profile = (User::findOne(Yii::$app->user->id))->profile;
        $model = new Consult();
        $model->status = $model::STATUS_NEW;
        $model->profile_id = $profile->id;
        $model->date_created = date('Y-m-d H:i:s');

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            $transaction = Yii::$app->db->beginTransaction();

            try{

                $model->save();
                $new_post = new ConsultPost();
                $new_post->post = $model->detailText;
                if(!$new_post->post){
                    $new_post->post = $model->name;
                }
                $new_post->date_created = date('Y-m-d H:i:s');
                $new_post->consult_id = $model->id;
                $new_post->profile_id = $model->profile_id;
                $new_post->save();
                $model->save();

                $new_consult = new NewConsult();
                $new_consult->date_created = date('Y-m-d H:i:s');
                $new_consult->new_consult_id = $model->id;
                $new_consult->for_profile_id = Profile::ID_PROFILE_ADMIN;
                $new_consult->save();

                $roles = [ROLE::ROLE_MANAGER,ROLE::ROLE_JURIST];
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
                    $new_consult = new NewConsult();
                    $new_consult->date_created = date('Y-m-d H:i:s');
                    $new_consult->new_consult_id = $model->id;
                    $new_consult->for_profile_id = $profile['id'];
                    $new_consult->save();
                }
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->session->addFlash('danger', $e->getMessage());
                return $this->redirect(['index']);
            }

            Yii::$app->session->addFlash('success', Yii::t('app','Консультация создана'));
            return $this->redirect(['index']);

        }
        return $this->render('create', [
            'model'=>$model
        ]);
    }

    public function actionGetUnreadPosts(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $postId = Yii::$app->request->post('postId');
        $transaction = Yii::$app->db->beginTransaction();




        try{
            $consultPost = ConsultPost::findOne($postId);
            $consult = Consult::findOne($consultPost->consult_id);

            $asManager = false;
            if (User::checkRole(['ROLE_USER'])) {
                if(!$profile->manager){

                    $isManager = $consult->profile->account;
                    if($isManager){
                        $asManager = $isManager->id == $profile->account->id;
                    }
                }
            }

            $asOwner = $profile->id == $consult->profile_id;

            if ((!$asOwner && !$asManager)  && !User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JURIST'])){
                throw new ForbiddenHttpException('Консультация не найдена');
            }
            NewConsultPost::deleteAll(['for_profile_id'=>$profile->id,'consult_id'=>$consultPost->consult_id]);
            $transaction->commit();
        }catch (Exception $e){
            $transaction->rollBack();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error'=>$e->getMessage()];
        }
        $consultPost = ConsultPost::find()->where(['>','date_created', $consultPost->date_created])->andWhere(['consult_id'=>$consult->id])->orderBy(['date_created'=>SORT_ASC])->all();
        return $this->renderPartial('partials/posts',['posts'=>$consultPost]);
    }

    public function actionSendMessage(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $post = new ConsultPost();
        $post->profile_id = $profile->id;
        $post->status = null;
        $post->date_created = date('Y-m-d H:i:s');
        if ($post->load(Yii::$app->request->post()) && $post->validate()){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $consult = Consult::findOne($post->consult_id);
                if($consult->status != Consult::STATUS_PROCESSING){
                    throw new ForbiddenHttpException('Консультация не находится в процессе');
                }
                $asOwner = $profile->id == $consult->profile_id;
                $asJurist  = $consult->jurist_id == $profile->id;
                if (!$asJurist && $asOwner){
                    $for_profile_id = $consult->jurist_id;
                }
                elseif ($asJurist && !$asOwner){
                    $for_profile_id = $consult->profile_id;
                }
                elseif (!$asJurist && !$asOwner){
                    throw new ForbiddenHttpException('Консультация не найдена');
                }

                if ($asJurist && !$asOwner){
                    if(!$consult->profile->user->online){
                        Yii::$app->common->sendMailNewMessageConsult($consult->profile->user->email, $consult->profile->user);
                    }
                }
                $post->save();
                $new_post = new NewConsultPost();
                $new_post->date_created = $post->date_created;
                $new_post->consult_id = $consult->id;
                $new_post->consult_id = $consult->id;
                $new_post->for_profile_id = $for_profile_id;
                $new_post->save();
                $lastsPosts = ConsultPost::findOne($post->last_post_id);
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error'=>$e->getMessage()];
            }
            NewConsultPost::deleteAll(['for_profile_id'=>$profile->id,'consult_id'=>$post->consult_id]);

            Yii::$app->response->format = Response::FORMAT_JSON;
            $consultPosts = ConsultPost::find()->where(['>','date_created', $lastsPosts->date_created])->andWhere(['consult_id'=>$consult->id])->orderBy(['date_created'=>SORT_ASC])->all();
            return $this->renderPartial('partials/posts',['posts'=>$consultPosts]);
        }
    }


    public function actionChangeStatus(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $consultPost = new ConsultPost();
        $consultPost->post ='change-status';
        $consultPost->profile_id = $profile->id;
        $consultPost->date_created = date('Y-m-d H:i:s');
        if($consultPost->load(Yii::$app->request->post()) && $consultPost->validate()){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $consult = Consult::findOne($consultPost->consult_id);
                if($consult->status == Consult::STATUS_CLOSED){
                    throw new ForbiddenHttpException('Консультация закрыта');
                }
                if($consult->profile_id == $profile->id){
                    throw new ForbiddenHttpException('Ошибка при  смене статуса');
                }
                if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JURIST'])) {
                    if($consult->status == Consult::STATUS_NEW){
                        $consult->jurist_id = $profile->id;
                        $consult->status = $consultPost->status;
                    }
                    else{
                        $consult->status = $consultPost->status;
                    }
                }

                $asJurist  = $consult->jurist_id == $profile->id;
                $otherProfile = $consult->profile;
                if (!$asJurist){
                    throw new ForbiddenHttpException('Консультация не найдена');
                }

                if(!$otherProfile->user->online){
                    Yii::$app->common->sendMailNewStatusConsult($otherProfile->user->email, $otherProfile->user);
                }
                $consultPost->save();
                $consult->save();
                $for_profile_id = $consult->profile_id;
                $new_post = new NewConsultPost();
                $new_post->date_created = $consultPost->date_created;
                $new_post->consult_id = $consult->id;
                $new_post->consult_id = $consult->id;
                $new_post->for_profile_id = $for_profile_id;
                $new_post->save();
                $lastsPosts = ConsultPost::findOne($consultPost->last_post_id);
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error'=>$e->getMessage()];
            }

            NewConsultPost::deleteAll(['for_profile_id'=>$profile->id,'consult_id'=>$consultPost->consult_id]);

            Yii::$app->response->format = Response::FORMAT_JSON;
            $consultPost = ConsultPost::find()->where(['>','date_created', $lastsPosts->date_created])->andWhere(['consult_id'=>$consult->id])->orderBy(['date_created'=>SORT_ASC])->all();
            return $this->renderPartial('partials/posts',['posts'=>$consultPost]);

        }
    }




    public function actionDelete($id){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JURIST'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $this->findModel($id)->delete();
        Yii::$app->session->addFlash('success', 'Консультация удалена');
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Consult::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}