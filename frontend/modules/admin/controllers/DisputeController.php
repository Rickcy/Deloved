<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 01.09.17
 * Time: 7:23
 */

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\AccountRating;
use common\models\Attachment;
use common\models\Deal;
use common\models\DealPost;
use common\models\Dispute;
use common\models\DisputePost;
use common\models\DisputePostAttach;
use common\models\Managers;
use common\models\NewDealPost;
use common\models\NewDispute;
use common\models\NewDisputePost;
use common\models\Profile;
use common\models\Role;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\helpers\BaseFileHelper;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;


class DisputeController extends AuthController
{
    public $layout = '/admin';

    public function actionIndex(){
        if (User::checkRole(['ROLE_JUDGE','ROLE_JURIST','ROLE_SUPPORT'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $profile = User::findOne(Yii::$app->user->id)->profile;

        if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_MEDIATOR'])) {
            $disputes = Dispute::find()->orderBy(['date_created'=>SORT_DESC])->all();
        }
        elseif (User::checkRole(['ROLE_USER']) && !$profile->isManager()) {
            $managers = Managers::find()->select(['profile_id'])->where(['account_id'=>$profile->account->id])->all();
            $ids =[];
            foreach ($managers as $manager){
                $ids[]= $manager->profile_id;
            }
            $disputes = Dispute::find()->where(['profile_id'=>$profile->id])->orWhere(['in','profile_id',$ids])->orWhere(['partner_id'=>$profile->id])->orWhere(['in','partner_id',$ids])->orderBy(['date_created'=>SORT_DESC])->all();


        }
        else{
            $disputes = Dispute::find()->where(['profile_id'=>$profile->id])->orWhere(['partner_id'=>$profile->id])->orderBy(['date_created'=>SORT_DESC])->all();
        }





        return $this->render('index',['disputes'=>$disputes]);
    }


    public function actionCreate($id){
        if (User::checkRole(['ROLE_JUDGE','ROLE_JURIST','ROLE_SUPPORT','ROLE_ADMIN','ROLE_MANAGER','ROLE_MEDIATOR'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $profile = (User::findOne(Yii::$app->user->id))->profile;
        $deal = Deal::findOne($id);
        if(!$deal){
            Yii::$app->session->addFlash('danger', 'Такой сделки не существует');
            return $this->redirect('/admin/deal/show?id='.$id);
        }

        if ($deal->status < Deal::SIGN_UP || $deal->status == Deal::SUSPENDED){
            Yii::$app->session->addFlash('danger', Yii::t('app','Договор не подписан'));
            return $this->redirect('/admin/deal/show?id='.$id);
        }
        $dispute = Dispute::find()->where(['deal_id'=>$id])->andWhere(['status'=>10])->one();
        if ($dispute){
            Yii::$app->session->addFlash('danger', 'Спор уже открыт');
            return $this->redirect('/admin/dispute/show?id='.$dispute->id);
        }
        $aBuyer = $deal->buyer_id == $profile->id;
        $aSeller = $deal->seller_id == $profile->id;
        if($aBuyer){
            $partner = $deal->seller;
        }
        elseif ($aSeller){
            $partner = $deal->buyer;
        }
        else{
            Yii::$app->session->addFlash('danger', 'Невозможно открыть спор');
            return $this->redirect('/admin/deal/show?id='.$id);
        }
        $otherProfile = $partner;

        $dispute = new Dispute();
        $dispute->date_created = date('Y-m-d H:i:s');
        $dispute->profile_id = $profile->id;
        $dispute->partner_id = $partner->id;
        $dispute->deal_id = $id;
        $dispute->status = Dispute::STATUS_NEW;
        if ($dispute->load(Yii::$app->request->post()) && $dispute->validate() ){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $dispute->save();

                $disputePost = new DisputePost();
                $disputePost->post = $dispute->detailText;
                $disputePost->date_created = $dispute->date_created;
                $disputePost->profile_id = $profile->id;
                $disputePost->dispute_id = $dispute->id;
                $disputePost->save();

                $dealPost = new DealPost();
                $dealPost->post = '<b>Изменен статус :</b> <b style="color: green">Сделка приостановлена</b>(<a href="/admin/dispute/show?id='.$dispute->id.'">Открыт Спор</a>)';
                $dealPost->deal_id = $deal->id;
                $dealPost->dispute_id = $dispute->id;
                $dealPost->profile_id = $profile->id;
                $dealPost->date_created = date('Y-m-d H:i:s');
                $dealPost->save();

                if(!$otherProfile->user->online){
                    Yii::$app->common->sendMailNewMessageDispute($otherProfile->user->email, $profile->user);
                }

                $new_dispute = new NewDispute();
                $new_dispute->for_profile_id = Profile::ID_PROFILE_ADMIN;
                $new_dispute->date_created = $dispute->date_created;
                $new_dispute->new_dispute_id = $dispute->id;
                $new_dispute->save();


                $roles = [ROLE::ROLE_MANAGER,ROLE::ROLE_MEDIATOR];
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
                    $new_consult = new NewDispute();
                    $new_consult->date_created = date('Y-m-d H:i:s');
                    $new_consult->new_dispute_id = $dispute->id;
                    $new_consult->for_profile_id = $profile['id'];
                    $new_consult->save();
                }
                $deal->status = Deal::SUSPENDED;
                $deal->save();




                Yii::$app->session->addFlash('success', 'Спор открыт');
                $transaction->commit();
                return $this->redirect(['index']);
            }catch (Exception $exception){
                $transaction->rollBack();
                Yii::$app->session->addFlash('danger', 'Невозможно открыть спор');
            }
        }

        return $this->render('create',['deal'=>$deal,'partner'=>$partner,'dispute'=>$dispute]);

    }




    public function actionShow($id){

        $profile = User::findOne(Yii::$app->user->id)->profile;
        $dispute = $this->findModel($id);

        $asManager = false;
        if (User::checkRole(['ROLE_USER'])) {
            if(!$profile->manager){

                $isManager = $dispute->profile->account;
                if($isManager){
                    $asManager = $isManager->id == $profile->account->id;
                }
                if(!$asManager){
                    $isManager = $dispute->partner->account;
                    if($isManager){
                        $asManager = $isManager->id == $profile->account->id;
                    }
                }

            }
        }


        if(($dispute->profile_id != $profile->id && $dispute->partner_id != $profile->id && !$asManager)  && !User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_MEDIATOR'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $disputePost = $dispute->getDisputePosts()->orderBy(['date_created'=>SORT_ASC])->all();
        $model = new DisputePost();
        if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_MEDIATOR'])) {
            Yii::$app->db
                ->createCommand('DELETE FROM new_dispute 
                    WHERE for_profile_id =:profile_id 
                      AND new_dispute_id =:new_dispute_id', [':profile_id' => $profile->id, 'new_dispute_id' => $dispute->id])
                ->execute();
        }

        Yii::$app->db
            ->createCommand('DELETE FROM new_dispute_post 
                    WHERE for_profile_id =:profile_id 
                      AND dispute_id =:dispute_id', [':profile_id' => $profile->id, 'dispute_id' => $dispute->id])
            ->execute();

        return $this->render('show',[
            'dispute'=>$dispute,
            'posts'=>$disputePost,
            'model'=>$model
        ]);
    }


    public function actionChangeStatus(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $disputePost = new DisputePost();
        $disputePost->post ='change-status';
        $disputePost->profile_id = $profile->id;
        $disputePost->date_created = date('Y-m-d H:i:s');
        if($disputePost->load(Yii::$app->request->post()) && $disputePost->validate()){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $dispute = Dispute::findOne($disputePost->dispute_id);
                if($dispute->status == Dispute::STATUS_FAILED){
                    throw new ForbiddenHttpException('Спор неудовлетворен');
                }
                elseif($dispute->status == Dispute::STATUS_RESOLVE_WS){
                    throw new ForbiddenHttpException('Спор удовлетворен');
                }
                elseif($dispute->profile_id == $profile->id || $dispute->partner_id == $profile->id){
                    throw new ForbiddenHttpException('Ошибка при смене статуса');
                }
                if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_MEDIATOR'])) {
                    if($dispute->status == Dispute::STATUS_NEW){
                        $dispute->mediator_id = $profile->id;
                        $dispute->status = $disputePost->status;
                    }
                    elseif($dispute->status == Dispute::STATUS_PROCESSING){
                        if($disputePost->status == Dispute::STATUS_FAILED || $disputePost->status == Dispute::STATUS_RESOLVE_WS){
                            if($disputePost->status == Dispute::STATUS_FAILED){
                                $dispute->failed_by_id = $dispute->partner_id;
                            }
                            $dispute->status = $disputePost->status;
                            $asMediator  = $dispute->mediator_id == $profile->id;

                            if (!$asMediator){
                                throw new ForbiddenHttpException('Спор не существует');
                            }
                            $lastChangeStatusDeal = DealPost::find()->where(['deal_id'=>$dispute->deal_id])->andWhere(['in', 'status', [100,101,102,103,104,200,201,202,300,301,302,304,400,401,402,403,404,500,501,502,503]])->addOrderBy(['date_created'=>SORT_DESC])->one();
                            $dealPost = new DealPost();
                            $dealPost->deal_id = $dispute->deal_id;
                            $dealPost->post = 'change-status';
                            $dealPost->profile_id = $dispute->profile_id;
                            $dealPost->date_created = date('Y-m-d H:i:s');
                            $dealPost->status = $lastChangeStatusDeal->status;
                            $dealPost->save();

                            $deal = Deal::findOne($dispute->deal_id);
                            $deal->status = $dealPost->status;
                            $deal->save();

                            $new_deal_post = new NewDealPost();
                            $new_deal_post->deal_id = $deal->id;
                            $new_deal_post->date_created = date('Y-m-d H:i:s');
                            $new_deal_post->for_profile_id = $dispute->profile_id;
                            $new_deal_post->save();


                            $new_deal_post = new NewDealPost();
                            $new_deal_post->deal_id = $deal->id;
                            $new_deal_post->date_created = date('Y-m-d H:i:s');
                            $new_deal_post->for_profile_id = $dispute->partner_id;
                            $new_deal_post->save();
                        }
                    }
                    else{
                        $dispute->status = $disputePost->status;
                        $asMediator  = $dispute->mediator_id == $profile->id;

                        $acc_rat = AccountRating::findOne(['account_id'=>$dispute->partner->account->id]);
                        $acc_rat->dispute = 1;
                        $acc_rat->save();

                        if (!$asMediator){
                            throw new ForbiddenHttpException('Спор не существует');
                        }
                    }
                }
                $dispute->detailText = $disputePost->post;
                $disputePost->save();
                $dispute->save();
                $for_profile_id_1 = $dispute->profile_id;
                $for_profile_id_2 = $dispute->partner_id;
                $new_post = new NewDisputePost();
                $new_post->date_created = $disputePost->date_created;
                $new_post->dispute_id = $dispute->id;
                $new_post->for_profile_id = $for_profile_id_1;
                $new_post->save();

                $new_post = new NewDisputePost();
                $new_post->date_created = $disputePost->date_created;
                $new_post->dispute_id = $dispute->id;
                $new_post->for_profile_id = $for_profile_id_2;
                $new_post->save();

                if(!$dispute->profile->user->online){
                    Yii::$app->common->sendMailNewMessageDispute($dispute->profile->user->email, $dispute->partner->user);
                }
                if(!$dispute->partner->user->online){
                    Yii::$app->common->sendMailNewMessageDispute($dispute->partner->user->email, $dispute->profile->user);
                }


                $lastsPosts = DisputePost::findOne($disputePost->last_post_id);
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error'=>$e->getMessage()];
            }

            NewDisputePost::deleteAll(['for_profile_id'=>$profile->id,'dispute_id'=>$disputePost->dispute_id]);

            Yii::$app->response->format = Response::FORMAT_JSON;
            $disputePost = DisputePost::find()->where(['>','date_created', $lastsPosts->date_created])->andWhere(['dispute_id'=>$dispute->id])->orderBy(['date_created'=>SORT_ASC])->all();
            return $this->renderPartial('partials/posts',['posts'=>$disputePost]);

        }
    }


    public function actionGetUnreadPosts(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $postId = Yii::$app->request->post('postId');
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $disputePost = DisputePost::findOne($postId);
            $dispute = Dispute::findOne($disputePost->dispute_id);

            $asManager = false;
            if (User::checkRole(['ROLE_USER'])) {
                if(!$profile->manager){

                    $isManager = $dispute->profile->account;
                    if($isManager){
                        $asManager = $isManager->id == $profile->account->id;
                    }
                    if(!$asManager){
                        $isManager = $dispute->partner->account;
                        if($isManager){
                            $asManager = $isManager->id == $profile->account->id;
                        }
                    }

                }
            }


            $asOwner = $profile->id == $dispute->profile_id;
            $asPartner = $profile->id == $dispute->partner_id;

            if ((!$asOwner && !$asPartner && !$asManager)  && !User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_MEDIATOR'])){
                throw new ForbiddenHttpException('Спор не найден');
            }
            NewDisputePost::deleteAll(['for_profile_id'=>$profile->id,'dispute_id'=>$disputePost->dispute_id]);
            $transaction->commit();
        }catch (Exception $e){
            $transaction->rollBack();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error'=>$e->getMessage()];
        }
        $disputePosts = DisputePost::find()->where(['>','date_created', $disputePost->date_created])->andWhere(['dispute_id'=>$dispute->id])->orderBy(['date_created'=>SORT_ASC])->all();
        return $this->renderPartial('partials/posts',['posts'=>$disputePosts]);
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
                if (!is_dir(Yii::getAlias('@uploadDir') . '/disputeFile/')) {
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir') . '/disputeFile/', 0777);
                }
                if (!is_dir(Yii::getAlias('@uploadDir') . '/disputeFile/' . $id . '/')) {
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir') . '/disputeFile/' . $id . '/', 0777);
                }
                $url = Yii::$app->security->generateRandomString(10) . '.' . $model->file->extension;
                $model->file->saveAs(Yii::getAlias('@uploadDir') . '/disputeFile/' . $id . '/' . $url);
                chmod(Yii::getAlias('@uploadDir') . '/disputeFile/' . $id . '/' . $url, 0777);
                $model->filePath = '/uploads/disputeFile/' . $id . '/' . $url;

                $disputePost = new DisputePost();
                $disputePost->post = $model->file->baseName;
                $disputePost->profile_id = $profile->id;
                $disputePost->dispute_id = $id;
                $disputePost->date_created = date('Y-m-d H:i:s');
                $disputePost->save();

                $model->save();
                $disputePostAtt = new DisputePostAttach();
                $disputePostAtt->profile_id = $profile->id;
                $disputePostAtt->dispute_id = (int)$id;
                $disputePostAtt->attachment_id = $model->id;
                $disputePostAtt->dispute_post_id = $disputePost->id;
                $disputePostAtt->save();
                $transaction->commit();

            }catch (Exception $exception){
                Yii::$app->response->format = Response::FORMAT_JSON;
                $transaction->rollBack();
                return $exception->getMessage();
            }
        }
    }



    public function actionSendMessage(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $post = new DisputePost();
        $post->profile_id = $profile->id;
        $post->status = null;
        $profile_1 = null;
        $profile_2 = null;
        $post->date_created = date('Y-m-d H:i:s');
        if ($post->load(Yii::$app->request->post()) && $post->validate()){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $dispute = Dispute::findOne($post->dispute_id);
                if($dispute->status != Dispute::STATUS_PROCESSING){
                    throw new ForbiddenHttpException('Спор не в процессе');
                }
                $asOwner = $profile->id == $dispute->profile_id;
                $asPartner= $profile->id == $dispute->partner_id;
                $asMediator  = $dispute->mediator_id == $profile->id;
                if (!$asMediator && $asOwner && !$asPartner){
                    $for_profile_id_1 = $dispute->mediator_id;
                    $for_profile_id_2 = $dispute->partner_id;
                    $profile_1 = $dispute->partner;
                }
                elseif ($asMediator && !$asOwner && !$asPartner){
                    $for_profile_id_1 = $dispute->profile_id;
                    $for_profile_id_2 = $dispute->partner_id;
                    $profile_1 = $dispute->partner;
                    $profile_2 = $dispute->profile;
                }
                elseif (!$asMediator && !$asOwner && $asPartner){
                    $for_profile_id_1 = $dispute->mediator_id;
                    $for_profile_id_2 = $dispute->profile_id;
                    $profile_2 = $dispute->profile;
                }
                elseif (!$asMediator && !$asOwner && !$asPartner){
                    throw new ForbiddenHttpException('Спор не найден');
                }

                $post->save();

                $new_post = new NewDisputePost();
                $new_post->date_created = $post->date_created;
                $new_post->dispute_id = $dispute->id;
                $new_post->for_profile_id = $for_profile_id_1;
                $new_post->save();

                $new_post = new NewDisputePost();
                $new_post->date_created = $post->date_created;
                $new_post->dispute_id = $dispute->id;
                $new_post->for_profile_id = $for_profile_id_2;
                $new_post->save();


                if($profile_1){
                    if(!$profile_1->user->online){
                        Yii::$app->common->sendMailNewMessageDispute($profile_1->user->email, $dispute->profile->user);
                    }
                }
                if($profile_2){
                    if(!$profile_2->user->online){
                        Yii::$app->common->sendMailNewMessageDispute($profile_2->user->email, $dispute->partner->user);
                    }
                }

                $lastsPosts = DisputePost::findOne($post->last_post_id);
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error'=>$e->getMessage()];
            }
            NewDisputePost::deleteAll(['for_profile_id'=>$profile->id,'dispute_id'=>$post->dispute_id]);

            Yii::$app->response->format = Response::FORMAT_JSON;
            $disputePosts = DisputePost::find()->where(['>','date_created', $lastsPosts->date_created])->andWhere(['dispute_id'=>$dispute->id])->orderBy(['date_created'=>SORT_ASC])->all();
            return $this->renderPartial('partials/posts',['posts'=>$disputePosts]);
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
    { if (!User::checkRole(['ROLE_ADMIN','ROLE_SUPPORT'])) {
        throw new ForbiddenHttpException('Доступ запрещен');
    }
        $this->findModel($id)->delete();
        Yii::$app->session->addFlash('success', 'Спор удален');
        return $this->redirect(['show-all']);
    }



    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dispute the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dispute::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}