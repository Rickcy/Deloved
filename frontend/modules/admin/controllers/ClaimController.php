<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 01.09.17
 * Time: 7:24
 */

namespace app\modules\admin\controllers;


use common\controllers\AuthController;
use common\models\AccountRating;
use common\models\Attachment;
use common\models\Claim;
use common\models\ClaimPost;
use common\models\ClaimPostAttach;
use common\models\Deal;
use common\models\DealPost;
use common\models\Managers;
use common\models\NewClaim;
use common\models\NewClaimPost;
use common\models\NewDealPost;
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

class ClaimController extends AuthController
{
    public $layout = '/admin';

    public function actionIndex(){
        if (User::checkRole(['ROLE_MEDIATOR','ROLE_JURIST','ROLE_SUPPORT'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $profile = User::findOne(Yii::$app->user->id)->profile;

        if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JUDGE'])) {
            $claims = Claim::find()->orderBy(['date_created'=>SORT_DESC])->all();
        }
        elseif (User::checkRole(['ROLE_USER']) && !$profile->isManager()) {
            $managers = Managers::find()->select(['profile_id'])->where(['account_id'=>$profile->account->id])->all();
            $ids =[];
            foreach ($managers as $manager){
                $ids[]= $manager->profile_id;
            }
            $claims = Claim::find()->where(['profile_id'=>$profile->id])->orWhere(['in','profile_id',$ids])->orWhere(['partner_id'=>$profile->id])->orWhere(['in','partner_id',$ids])->orderBy(['date_created'=>SORT_DESC])->all();


        }
        else{
            $claims = Claim::find()->where(['profile_id'=>$profile->id])->orWhere(['partner_id'=>$profile->id])->orderBy(['date_created'=>SORT_DESC])->all();

        }



        return $this->render('index',['claims'=>$claims]);
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
        if ($deal->status < Deal::SIGN_UP){
            Yii::$app->session->addFlash('danger', Yii::t('app','Договор не подписан'));
            return $this->redirect('/admin/deal/show?id='.$id);
        }
        $claim = Claim::find()->where(['deal_id'=>$id])->andWhere(['in','status',[0,10]])->one();
        if ($claim){
            Yii::$app->session->addFlash('danger', 'Иск уже подан');
            return $this->redirect('/admin/claim/show?id='.$claim->id);
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
            Yii::$app->session->addFlash('danger', 'Невозможно подать иск');
            return $this->redirect('/admin/deal/show?id='.$id);
        }
        $otherProfile = $partner;
        $claim = new Claim();
        $claim->date_created = date('Y-m-d H:i:s');
        $claim->profile_id = $profile->id;
        $claim->partner_id = $partner->id;
        $claim->deal_id = $id;


        $claim->status = Claim::STATUS_NEW;
        if ($claim->load(Yii::$app->request->post()) && $claim->validate() ){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $claim->save();
                $claim->claimFile = UploadedFile::getInstance($claim,'claimFile');
                $claim->claimSudFile = UploadedFile::getInstance($claim,'claimSudFile');
                $claim->claimOgovorFile = UploadedFile::getInstance($claim,'claimOgovorFile');

                $claim->uploadAndSaveFile();

                $claimPost = new ClaimPost();
                $claimPost->post = $claim->detailText;
                $claimPost->date_created = $claim->date_created;
                $claimPost->profile_id = $profile->id;
                $claimPost->claim_id = $claim->id;
                $claimPost->save();

                $dealPost = new DealPost();
                $dealPost->post = '<b>Изменен статус :</b> <b style="color: green">Сделка приостановлена</b>(<a href="/admin/claim/show?id='.$claim->id.'">Подан иск</a>)';
                $dealPost->claim_id = $claim->id;
                $dealPost->deal_id = $claim->deal_id;
                $dealPost->profile_id = $profile->id;
                $dealPost->date_created = date('Y-m-d H:i:s');
                $dealPost->save();

                if(!$otherProfile->user->online){
                    Yii::$app->common->sendMailNewMessageClaim($otherProfile->user->email, $profile->user);
                }

                $new_claim = new NewClaim();
                $new_claim->for_profile_id = Profile::ID_PROFILE_ADMIN;
                $new_claim->date_created = $claim->date_created;
                $new_claim->new_claim_id = $claim->id;
                $new_claim->save();


                $roles = [ROLE::ROLE_MANAGER,ROLE::ROLE_JUDGE];
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
                    $new_claim = new NewClaim();
                    $new_claim->date_created = date('Y-m-d H:i:s');
                    $new_claim->new_claim_id = $claim->id;
                    $new_claim->for_profile_id = $profile['id'];
                    $new_claim->save();
                }
                $deal->status = Deal::SUSPENDED;
                $deal->save();




                Yii::$app->session->addFlash('success', 'Иск подан');
                $transaction->commit();
                return $this->redirect(['index']);
            }catch (Exception $exception){
                $transaction->rollBack();
                Yii::$app->session->addFlash('danger', 'Невозможно открыть спор');
            }
        }

        return $this->render('create',['deal'=>$deal,'partner'=>$partner,'claim'=>$claim]);

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
                if (!is_dir(Yii::getAlias('@uploadDir') . '/claimFile/')) {
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir') . '/claimFile/', 0777);
                }
                if (!is_dir(Yii::getAlias('@uploadDir') . '/claimFile/' . $id . '/')) {
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir') . '/claimFile/' . $id . '/', 0777);
                }
                $url = Yii::$app->security->generateRandomString(10) . '.' . $model->file->extension;
                $model->file->saveAs(Yii::getAlias('@uploadDir') . '/claimFile/' . $id . '/' . $url);
                chmod(Yii::getAlias('@uploadDir') . '/claimFile/' . $id . '/' . $url, 0777);
                $model->filePath = '/uploads/claimFile/' . $id . '/' . $url;

                $disputePost = new ClaimPost();
                $disputePost->post = $model->file->baseName;
                $disputePost->profile_id = $profile->id;
                $disputePost->claim_id = $id;
                $disputePost->date_created = date('Y-m-d H:i:s');
                $disputePost->save();

                $model->save();
                $disputePostAtt = new ClaimPostAttach();
                $disputePostAtt->profile_id = $profile->id;
                $disputePostAtt->claim_id = (int)$id;
                $disputePostAtt->attachment_id = $model->id;
                $disputePostAtt->claim_post_id = $disputePost->id;
                $disputePostAtt->save();
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
        $claim = $this->findModel($id);

        $asManager = false;
        if (User::checkRole(['ROLE_USER'])) {
            if(!$profile->manager){

                $isManager = $claim->profile->account;
                if($isManager){
                    $asManager = $isManager->id == $profile->account->id;
                }
                if(!$asManager){
                    $isManager = $claim->partner->account;
                    if($isManager){
                        $asManager = $isManager->id == $profile->account->id;
                    }
                }

            }
        }

        if(($claim->profile_id != $profile->id && $claim->partner_id != $profile->id && !$asManager)   && !User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JUDGE'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $claimPost = $claim->getClaimPosts()->orderBy(['date_created'=>SORT_ASC])->all();
        $model = new ClaimPost();
        if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JUDGE'])) {
            Yii::$app->db
                ->createCommand('DELETE FROM new_claim 
                    WHERE for_profile_id =:profile_id 
                      AND new_claim_id =:new_claim_id', [':profile_id' => $profile->id, 'new_claim_id' => $claim->id])
                ->execute();
        }

        Yii::$app->db
            ->createCommand('DELETE FROM new_claim_post 
                    WHERE for_profile_id =:profile_id 
                      AND claim_id =:claim_id', [':profile_id' => $profile->id, 'claim_id' => $claim->id])
            ->execute();

        return $this->render('show',[
            'claim'=>$claim,
            'posts'=>$claimPost,
            'model'=>$model
        ]);
    }


    public function actionChangeStatus(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $claimPost = new ClaimPost();
        $claimPost->post ='change-status';
        $claimPost->profile_id = $profile->id;
        $claimPost->date_created = date('Y-m-d H:i:s');
        if($claimPost->load(Yii::$app->request->post()) && $claimPost->validate()){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $claim = Claim::findOne($claimPost->claim_id);
                if($claim->status == Claim::STATUS_FAILED){
                    throw new ForbiddenHttpException('Иск неудовлетворен');
                }
                elseif($claim->status == Claim::STATUS_RESOLVE_WS){
                    throw new ForbiddenHttpException('Иск удовлетворен');
                }
                elseif($claim->profile_id == $profile->id || $claim->partner_id == $profile->id){
                    throw new ForbiddenHttpException('Ошибка при смене статуса');
                }
                if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JUDGE'])) {
                    if($claim->status == Claim::STATUS_NEW){
                        if ($claimPost->status == Claim::STATUS_RETURN){
                            $claim->status = $claimPost->status;
                            $lastChangeStatusDeal = DealPost::find()->where(['deal_id'=>$claim->deal_id])->andWhere(['in', 'status', [100,101,102,103,104,200,201,202,300,301,302,304,400,401,402,403,404,500,501,502,503]])->addOrderBy(['date_created'=>SORT_DESC])->one();
                            $dealPost = new DealPost();
                            $dealPost->deal_id = $claim->deal_id;
                            $dealPost->post = 'change-status';
                            $dealPost->profile_id = $claim->profile_id;
                            $dealPost->date_created = date('Y-m-d H:i:s');
                            $dealPost->status = $lastChangeStatusDeal->status;
                            $dealPost->save();

                            $deal = Deal::findOne($claim->deal_id);
                            $deal->status = $dealPost->status;
                            $deal->save();

                            $new_deal_post = new NewDealPost();
                            $new_deal_post->deal_id = $deal->id;
                            $new_deal_post->date_created = date('Y-m-d H:i:s');
                            $new_deal_post->for_profile_id = $claim->profile_id;
                            $new_deal_post->save();
                        }
                        else{
                            $claim->judge_id = $profile->id;
                            $claim->status = $claimPost->status;

                            $acc_rat = AccountRating::findOne(['account_id'=>$claim->partner->account->id]);
                            $acc_rat->dispute = 1;
                            $acc_rat->save();
                        }
                    }
                    elseif($claim->status == Claim::STATUS_PROCESSING){
                        if($claimPost->status == Claim::STATUS_FAILED || $claimPost->status == Claim::STATUS_RESOLVE_WS || $claimPost->status == Claim::STATUS_RESOLVE ){
                            if($claimPost->status == Claim::STATUS_FAILED){
                                $claim->failed_by_id = $claim->partner_id;
                            }
                            $claim->status = $claimPost->status;
                            $asJudge  = $claim->judge_id == $profile->id;

                            if (!$asJudge){
                                throw new ForbiddenHttpException('Иск не найден');
                            }
                            $lastChangeStatusDeal = DealPost::find()->where(['deal_id'=>$claim->deal_id])->andWhere(['in', 'status', [100,101,102,103,104,200,201,202,300,301,302,304,400,401,402,403,404,500,501,502,503]])->addOrderBy(['date_created'=>SORT_DESC])->one();
                            $dealPost = new DealPost();
                            $dealPost->deal_id = $claim->deal_id;
                            $dealPost->post = 'change-status';
                            $dealPost->profile_id = $claim->profile_id;
                            $dealPost->date_created = date('Y-m-d H:i:s');
                            $dealPost->status = $lastChangeStatusDeal->status;
                            $dealPost->save();

                            $deal = Deal::findOne($claim->deal_id);
                            $deal->status = $dealPost->status;
                            $deal->save();

                            $new_deal_post = new NewDealPost();
                            $new_deal_post->deal_id = $deal->id;
                            $new_deal_post->date_created = date('Y-m-d H:i:s');
                            $new_deal_post->for_profile_id = $claim->profile_id;
                            $new_deal_post->save();


                            $new_deal_post = new NewDealPost();
                            $new_deal_post->deal_id = $deal->id;
                            $new_deal_post->date_created = date('Y-m-d H:i:s');
                            $new_deal_post->for_profile_id = $claim->partner_id;
                            $new_deal_post->save();
                        }
                    }
                    else{
                        $claim->status = $claimPost->status;
                        $asJudge  = $claim->judge_id == $profile->id;

                        if (!$asJudge){
                            throw new ForbiddenHttpException('Иск не найден');
                        }
                    }
                }
                $claim->detailText = $claimPost->post;
                $claimPost->save();
                $claim->save();
                $for_profile_id_1 = $claim->profile_id;
                $for_profile_id_2 = $claim->partner_id;
                $new_post = new NewClaimPost();
                $new_post->date_created = $claimPost->date_created;
                $new_post->claim_id = $claim->id;
                $new_post->for_profile_id = $for_profile_id_1;
                $new_post->save();


                if(!$claim->profile->user->online){
                    Yii::$app->common->sendMailNewStatusClaim($claim->profile->user->email, $claim->partner->user);
                }
                if(!$claim->partner->user->online){
                    Yii::$app->common->sendMailNewStatusClaim($claim->partner->user->email, $claim->profile->user);
                }

                $new_post = new NewClaimPost();
                $new_post->date_created = $claimPost->date_created;
                $new_post->claim_id = $claim->id;
                $new_post->for_profile_id = $for_profile_id_2;
                $new_post->save();

                $lastsPosts = ClaimPost::findOne($claimPost->last_post_id);
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error'=>$e->getMessage()];
            }

            NewClaimPost::deleteAll(['for_profile_id'=>$profile->id,'claim_id'=>$claimPost->claim_id]);

            Yii::$app->response->format = Response::FORMAT_JSON;
            $claimPost = ClaimPost::find()->where(['>','date_created', $lastsPosts->date_created])->andWhere(['claim_id'=>$claim->id])->orderBy(['date_created'=>SORT_ASC])->all();
            return $this->renderPartial('partials/posts',['posts'=>$claimPost]);

        }
    }


    public function actionGetUnreadPosts(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $postId = Yii::$app->request->post('postId');
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $claimPost = ClaimPost::findOne($postId);
            $claim = Claim::findOne($claimPost->claim_id);

            $asManager = false;
            if (User::checkRole(['ROLE_USER'])) {
                if(!$profile->manager){

                    $isManager = $claim->profile->account;
                    if($isManager){
                        $asManager = $isManager->id == $profile->account->id;
                    }
                    if(!$asManager){
                        $isManager = $claim->partner->account;
                        if($isManager){
                            $asManager = $isManager->id == $profile->account->id;
                        }
                    }

                }
            }


            $asOwner = $profile->id == $claim->profile_id;
            $asPartner = $profile->id == $claim->partner_id;

            if ((!$asOwner && !$asPartner && !$asManager)  && !User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JUDGE'])){
                throw new ForbiddenHttpException('Иск не найден');
            }
            NewClaimPost::deleteAll(['for_profile_id'=>$profile->id,'claim_id'=>$claimPost->claim_id]);
            $transaction->commit();
        }catch (Exception $e){
            $transaction->rollBack();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error'=>$e->getMessage()];
        }
        $claimPosts = ClaimPost::find()->where(['>','date_created', $claimPost->date_created])->andWhere(['claim_id'=>$claim->id])->orderBy(['date_created'=>SORT_ASC])->all();
        return $this->renderPartial('partials/posts',['posts'=>$claimPosts]);
    }




    public function actionSendMessage(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $post = new ClaimPost();
        $post->profile_id = $profile->id;
        $post->status = null;
        $post->date_created = date('Y-m-d H:i:s');
        $profile_1 = null;
        $profile_2 = null;
        if ($post->load(Yii::$app->request->post()) && $post->validate()){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $claim = Claim::findOne($post->claim_id);
                if($claim->status != Claim::STATUS_PROCESSING){
                    throw new ForbiddenHttpException('Иск не в процессе');
                }
                $asOwner = $profile->id == $claim->profile_id;
                $asPartner= $profile->id == $claim->partner_id;
                $asJudge  = $claim->judge_id == $profile->id;
                if (!$asJudge && $asOwner && !$asPartner){
                    $for_profile_id_1 = $claim->judge_id;
                    $for_profile_id_2 = $claim->partner_id;
                    $profile_1 = $claim->partner;
                }
                elseif ($asJudge && !$asOwner && !$asPartner){
                    $for_profile_id_1 = $claim->profile_id;
                    $for_profile_id_2 = $claim->partner_id;
                    $profile_1 = $claim->partner;
                    $profile_2 = $claim->profile;
                }
                elseif (!$asJudge && !$asOwner && $asPartner){
                    $for_profile_id_1 = $claim->judge_id;
                    $for_profile_id_2 = $claim->profile_id;
                    $profile_2 = $claim->profile;
                }
                elseif (!$asJudge && !$asOwner && !$asPartner){
                    throw new ForbiddenHttpException('Иск не найден');
                }

                $post->save();

                $new_post = new NewClaimPost();
                $new_post->date_created = $post->date_created;
                $new_post->claim_id = $claim->id;
                $new_post->for_profile_id = $for_profile_id_1;
                $new_post->save();

                $new_post = new NewClaimPost();
                $new_post->date_created = $post->date_created;
                $new_post->claim_id = $claim->id;
                $new_post->for_profile_id = $for_profile_id_2;
                $new_post->save();

                if($profile_1){
                    if(!$profile_1->user->online){
                        Yii::$app->common->sendMailNewMessageClaim($profile_1->user->email, $claim->profile->user);
                    }
                }
                if($profile_2){
                    if(!$profile_2->user->online){
                        Yii::$app->common->sendMailNewMessageClaim($profile_2->user->email, $claim->partner->user);
                    }
                }


                $lastsPosts = ClaimPost::findOne($post->last_post_id);
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error'=>$e->getMessage()];
            }
            NewClaimPost::deleteAll(['for_profile_id'=>$profile->id,'claim_id'=>$post->claim_id]);

            Yii::$app->response->format = Response::FORMAT_JSON;
            $claimPosts = ClaimPost::find()->where(['>','date_created', $lastsPosts->date_created])->andWhere(['claim_id'=>$claim->id])->orderBy(['date_created'=>SORT_ASC])->all();
            return $this->renderPartial('partials/posts',['posts'=>$claimPosts]);
        }
    }







    public function actionDelete($id){
        if (!User::checkRole(['ROLE_ADMIN'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $this->findModel($id)->delete();
        Yii::$app->session->addFlash('success', 'Иск удален');
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Claim::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}