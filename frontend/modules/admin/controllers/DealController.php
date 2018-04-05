<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 01.09.17
 * Time: 7:20
 */

namespace app\modules\admin\controllers;


use common\controllers\AuthController;
use common\models\Account;
use common\models\AccountRating;
use common\models\Attachment;
use common\models\Deal;
use common\models\DealPost;
use common\models\DealPostAttach;
use common\models\Goods;
use common\models\Managers;
use common\models\NewDeal;
use common\models\NewDealPost;
use common\models\Profile;
use common\models\Role;
use common\models\Services;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\helpers\BaseFileHelper;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class DealController extends AuthController
{
    public $layout = '/admin';

    public function actionIndex(){
        if (User::checkRole(['ROLE_MEDIATOR','ROLE_JUDGE','ROLE_JURIST','ROLE_SUPPORT'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $profile = User::findOne(Yii::$app->user->id)->profile;
        if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            $deals = Deal::find()->orderBy(['status'=>SORT_ASC])->all();
        }
        elseif (User::checkRole(['ROLE_USER']) && !$profile->isManager()) {
            $managers = Managers::find()->select(['profile_id'])->where(['account_id'=>$profile->account->id])->all();
            $ids =[];
            foreach ($managers as $manager){
                $ids[]= $manager->profile_id;
            }
            $deals = Deal::find()->where(['buyer_id'=>$profile->id])->orWhere(['seller_id'=>$profile->id])->orWhere(['in','buyer_id',$ids])->orWhere(['in','seller_id',$ids])->orderBy(['status'=>SORT_ASC])->all();

        }
        else{
            $deals = Deal::find()->where(['buyer_id'=>$profile->id])->orWhere(['seller_id'=>$profile->id])->orderBy(['status'=>SORT_ASC])->all();
        }

        return $this->render('index',['deals'=>$deals]);
    }

    public function actionDelete($id){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $this->findModel($id)->delete();
        Yii::$app->session->addFlash('success', 'Сделка удалена');
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Deal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionSendCreateMess(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $user = User::findOne(Yii::$app->user->id);
        $email = Yii::$app->request->post('email');
        $name = Yii::$app->request->post('name');
        if(!$email || !$name){
            return false;
        }
        Yii::$app->common->sendMailCreateDeal($email,$user,$name);
        return true;
    }

    public function actionShow($id){

        $profile = User::findOne(Yii::$app->user->id)->profile;
        $deal = $this->findModel($id);

        $asManager = false;
        if (User::checkRole(['ROLE_USER'])) {
            if(!$profile->manager){

                $isManager = $deal->buyer->account;
                if($isManager){
                    $asManager = $isManager->id == $profile->account->id;
                }
                if(!$asManager){
                    $isManager = $deal->seller->account;
                    if($isManager){
                        $asManager = $isManager->id == $profile->account->id;
                    }
                }

            }
        }


        if(($deal->buyer_id != $profile->id && $deal->seller_id != $profile->id && !$asManager) && !User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JUDGE','ROLE_MEDIATOR'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $dealPost = $deal->getDealPosts()->orderBy(['date_created'=>SORT_ASC])->all();
        $model = new DealPost();
        Yii::$app->db
            ->createCommand('DELETE FROM new_deal
                    WHERE for_profile_id =:profile_id
                      AND new_deal_id =:new_deal_id', [':profile_id' => $profile->id, 'new_deal_id' => $deal->id])
            ->execute();
        Yii::$app->db
            ->createCommand('DELETE FROM new_deal_post
                    WHERE for_profile_id =:profile_id
                      AND deal_id =:deal_id', [':profile_id' => $profile->id, 'deal_id' => $deal->id])
            ->execute();

        return $this->render('show',[
            'deal'=>$deal,
            'posts'=>$dealPost,
            'model'=>$model
        ]);
    }


    public function actionUploadFile($id){
        if (!User::checkRole(['ROLE_USER'])) {
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
                if (!is_dir(Yii::getAlias('@uploadDir') . '/dealFile/')) {
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir') . '/dealFile/', 0777);
                }
                if (!is_dir(Yii::getAlias('@uploadDir') . '/dealFile/' . $id . '/')) {
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir') . '/dealFile/' . $id . '/', 0777);
                }
                $url = Yii::$app->security->generateRandomString(10) . '.' . $model->file->extension;
                $model->file->saveAs(Yii::getAlias('@uploadDir') . '/dealFile/' . $id . '/' . $url);
                chmod(Yii::getAlias('@uploadDir') . '/dealFile/' . $id . '/' . $url, 0777);
                $model->filePath = '/uploads/dealFile/' . $id . '/' . $url;

                $dealPost = new DealPost();
                $dealPost->post = $model->file->baseName;
                $dealPost->profile_id = $profile->id;
                $dealPost->deal_id = $id;
                $dealPost->date_created = date('Y-m-d H:i:s');
                $dealPost->save();

                $model->save();
                $dealPostAtt = new DealPostAttach();
                $dealPostAtt->profile_id = $profile->id;
                $dealPostAtt->deal_id = (int)$id;
                $dealPostAtt->attachment_id = $model->id;
                $dealPostAtt->deal_post_id = $dealPost->id;
                $dealPostAtt->save();
                $transaction->commit();

            }catch (Exception $exception){
                Yii::$app->response->format = Response::FORMAT_JSON;
                $transaction->rollBack();
                return $exception->getMessage();
            }
        }
    }



    public function actionGetUnreadPosts(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $postId = Yii::$app->request->post('postId');
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $dealPost = DealPost::findOne($postId);
            $deal = Deal::findOne($dealPost->deal_id);

            $asManager = false;
            if (User::checkRole(['ROLE_USER'])) {
                if(!$profile->manager){

                    $isManager = $deal->buyer->account;
                    if($isManager){
                        $asManager = $isManager->id == $profile->account->id;
                    }
                    if(!$asManager){
                        $isManager = $deal->seller->account;
                        if($isManager){
                            $asManager = $isManager->id == $profile->account->id;
                        }
                    }

                }
            }

            $asBuyer = $profile->id == $deal->buyer_id;
            $asSeller = $profile->id == $deal->seller_id;

            if ((!$asBuyer && !$asSeller  && !$asManager)  && !User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_MEDIATOR','ROLE_JUDGE'])){
                throw new ForbiddenHttpException('Сделка не найдена');
            }
            NewDealPost::deleteAll(['for_profile_id'=>$profile->id,'deal_id'=>$dealPost->deal_id]);
            $transaction->commit();
        }catch (Exception $e){
            $transaction->rollBack();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error'=>$e->getMessage()];
        }
        $dealPost = DealPost::find()->where(['>','date_created', $dealPost->date_created])->andWhere(['deal_id'=>$deal->id])->orderBy(['date_created'=>SORT_ASC])->all();
        return $this->renderPartial('partials/posts',['posts'=>$dealPost]);
    }

    public function actionSendMessage(){

        $profile = User::findOne(Yii::$app->user->id)->profile;
        $post = new DealPost();
        $post->profile_id = $profile->id;
        $post->status = null;
        $post->date_created = date('Y-m-d H:i:s');
        if ($post->load(Yii::$app->request->post()) && $post->validate()){

            $transaction = Yii::$app->db->beginTransaction();
            try{
                $deal = Deal::findOne($post->deal_id);
                if($deal->status == Deal::PROPOSED ||$deal->status == Deal::CONFIRMED || $deal->status == Deal::REJECTED){
                    throw new ForbiddenHttpException('сделка находится не в процессе');
                }
                $asBuyer = $profile->id == $deal->buyer_id;
                $asSeller  = $deal->seller_id == $profile->id;

                if ($asBuyer){
                    $otherProfile = $deal->seller;
                    $for_profile_id = $deal->seller_id;
                }
                elseif ($asSeller){
                    $otherProfile = $deal->buyer;
                    $for_profile_id = $deal->buyer_id;
                }
                elseif (!$asBuyer && !$asSeller){
                    throw new ForbiddenHttpException('Сделка не найдена');
                }
                $post->save();

                $new_post = new NewDealPost();
                $new_post->date_created = $post->date_created;
                $new_post->deal_id = $deal->id;
                $new_post->deal_id = $deal->id;
                $new_post->for_profile_id = $for_profile_id;
                if(!$otherProfile->user->online){
                    Yii::$app->common->sendMailNewMessageDeal($otherProfile->user->email, $profile->user);
                }
                $new_post->save();
                $lastsPosts = DealPost::findOne($post->last_post_id);
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error'=>$e->getMessage()];
            }
            NewDealPost::deleteAll(['for_profile_id'=>$profile->id,'deal_id'=>$post->deal_id]);

            Yii::$app->response->format = Response::FORMAT_JSON;
            $dealPosts = DealPost::find()->where(['>','date_created', $lastsPosts->date_created])->andWhere(['deal_id'=>$deal->id])->orderBy(['date_created'=>SORT_ASC])->all();
            return $this->renderPartial('partials/posts',['posts'=>$dealPosts]);
        }
    }

    public function actionGetStatuses(){
        $postId = Yii::$app->request->post('postId');
        Yii::$app->response->format = Response::FORMAT_JSON;
        $dealPost = DealPost::findOne($postId);
        $deal = Deal::findOne($dealPost->deal_id);

        return $this->renderPartial('partials/statuses',['deal'=>$deal]);
    }

    public function actionGetProgress(){
        $postId = Yii::$app->request->post('postId');
        Yii::$app->response->format = Response::FORMAT_JSON;
        $dealPost = DealPost::findOne($postId);
        $deal = Deal::findOne($dealPost->deal_id);

        return $this->renderPartial('partials/progress',['status'=>$deal->status]);
    }

    public function actionChangeStatus(){
        $profile = User::findOne(Yii::$app->user->id)->profile;
        $dealPost = new DealPost();
        $dealPost->post ='change-status';
        $dealPost->profile_id = $profile->id;
        $dealPost->date_created = date('Y-m-d H:i:s');
        if($dealPost->load(Yii::$app->request->post()) && $dealPost->validate()){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $deal = Deal::findOne($dealPost->deal_id);
                if($deal->status == Deal::REJECTED || $deal->status == Deal::CONFIRMED){
                    throw new ForbiddenHttpException('Сделка окончена');
                }
                $deal->status = $dealPost->status;

                $asBuyer = $profile->id == $deal->buyer_id;
                $asSeller  = $deal->seller_id == $profile->id;

                if (!$asBuyer && !$asSeller){
                    throw new ForbiddenHttpException('Сделка не существует');
                }
                if($dealPost->status == Deal::CONFIRMED){
                    $acc_rat = AccountRating::findOne(['account_id'=>$deal->buyer->account->id]);
                    $acc_rat->deal_success = 1;
                    $acc_rat->save();

                    $acc_rat = AccountRating::findOne(['account_id'=>$deal->seller->account->id]);
                    $acc_rat->deal_success = 1;
                    $acc_rat->save();
                }
                if($dealPost->status == Deal::FAILED){
                    $acc_rat = AccountRating::findOne(['account_id'=>$deal->buyer->account->id]);
                    $acc_rat->deal_fail = 1;
                    $acc_rat->save();

                    $acc_rat = AccountRating::findOne(['account_id'=>$deal->seller->account->id]);
                    $acc_rat->deal_fail = 1;
                    $acc_rat->save();
                }

                $deal->save();
                $dealPost->save();
                $new_post = new NewDealPost();
                $new_post->date_created = $dealPost->date_created;
                $new_post->deal_id = $deal->id;
                if($asBuyer){
                    $otherProfile = $deal->seller;
                    $new_post->for_profile_id = $deal->seller_id;
                }
                elseif ($asSeller){
                    $otherProfile = $deal->buyer;
                    $new_post->for_profile_id = $deal->buyer_id;
                }
                $new_post->save();

                if(!$otherProfile->user->online){
                    Yii::$app->common->sendMailNewStatusDeal($otherProfile->user->email, $profile->user);
                }
                $lastsPosts = DealPost::findOne($dealPost->last_post_id);
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['error'=>$e->getMessage()];
            }

            NewDealPost::deleteAll(['for_profile_id'=>$profile->id,'deal_id'=>$dealPost->deal_id]);

            Yii::$app->response->format = Response::FORMAT_JSON;
            $dealPost = DealPost::find()->where(['>','date_created', $lastsPosts->date_created])->andWhere(['deal_id'=>$deal->id])->orderBy(['date_created'=>SORT_ASC])->all();
            return $this->renderPartial('partials/posts',['posts'=>$dealPost]);
        }
    }




    public function actionCreate($id = null,$good = null,$service = null){
        if (!User::checkRole(['ROLE_USER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $myProfile = (User::findOne(Yii::$app->user->id))->profile;
        if(!isset($myProfile->account)){
            Yii::$app->session->addFlash('danger', 'Невозможно предложить сделку');
            return $this->redirect('/admin');
        }
        $item = null;
        $myAccount = $myProfile->account;
        if($good){
            $item = Goods::findOne($good);
            $otherAccount = $item->account;
            if($otherAccount->id == $myAccount->id){
                Yii::$app->session->addFlash('danger', 'Невозможно предложить сделку самому себе');
                return $this->redirect('/goods/item?id='.$good);
            }
        }
        elseif($service){
            $item = Services::findOne($service);
            $otherAccount = $item->account;
            if($otherAccount->id == $myAccount->id){
                Yii::$app->session->addFlash('danger', 'Невозможно предложить сделку самому себе');
                return $this->redirect('/services/item?id='.$good);
            }
        }
        elseif($id){
            $otherAccount = Account::findOne((int)$id);
            if(!$otherAccount){
                Yii::$app->session->addFlash('danger', 'Нет такой организации на сайте');
                return $this->redirect('/admin/information/index');
            }
            if($id == $myAccount->id){
                Yii::$app->session->addFlash('danger', 'Невозможно предложить сделку самому себе');
                return $this->redirect('/companies/item?id='.$id);
            }
        }
        else{
            Yii::$app->session->addFlash('danger', 'Невозможно предложить сделку');
            return $this->redirect('/admin');
        }

        $deal = new Deal();
        if ($deal->load(Yii::$app->request->post()) ){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                if ($deal->isBuyer == 1){
                    $deal->buyer_id = $myAccount->profile->id;
                    $deal->seller_id = $otherAccount->profile->id;
                    $deal->date_created = date('Y-m-d H:i:s');
                    $deal->status = Deal::PROPOSED;
                    $deal->save();
                    if(!$otherAccount->profile->user->online){
                        Yii::$app->common->sendMailNewDeal($otherAccount->profile->user->email, $myProfile->user);
                    }

                    $dealPost = new DealPost();
                    $dealPost->profile_id = $deal->buyer_id;
                    if(!$deal->detailText){
                        $dealPost->post = 'Здравствуйте, хотел у вас приобрести '.$item->name. ' за ' .$item->price.' '. $item->currency->name. 'за 1 '. $item->measure->name;
                    }
                    else{
                        $dealPost->post = $deal->detailText;
                    }
                    $dealPost->date_created = date('Y-m-d H:i:s');
                    $dealPost->deal_id = $deal->id;
                    $dealPost->save();
                }
                if ($deal->isBuyer == 0){
                    $deal->buyer_id = $otherAccount->profile->id;
                    $deal->seller_id = $myAccount->profile->id;
                    $deal->date_created = date('Y-m-d H:i:s');
                    $deal->status = Deal::PROPOSED;
                    $deal->save();


                    $dealPost = new DealPost();
                    $dealPost->profile_id = $deal->seller_id;
                    if(!$deal->detailText){
                        $dealPost->post = 'Здравствуйте, хотел вам предложить '.$item->name. ' за ' .$item->price.' ' . $item->currency->name. 'за 1 '. $item->measure->name;
                    }
                else{
                        $dealPost->post = $deal->detailText;
                    }
                    $dealPost->date_created = date('Y-m-d H:i:s');
                    $dealPost->deal_id = $deal->id;
                    $dealPost->save();
                }


                $accRating = New AccountRating();
                $accRating->account_id = $deal->buyer->account->id;
                $accRating->deal_id = $deal->id;
                $accRating->save();

                $accRating = New AccountRating();
                $accRating->account_id = $deal->seller->account->id;
                $accRating->deal_id = $deal->id;
                $accRating->save();

                $new_deal = new NewDeal();
                $new_deal->new_deal_id = $deal->id;
                $new_deal->for_profile_id = Profile::ID_PROFILE_ADMIN;
                $new_deal->date_created = date('Y-m-d H:i:s');
                $new_deal->save();


                $roles = [ROLE::ROLE_MANAGER];
                $query = 'SELECT * FROM profile WHERE user_id IN (SELECT id FROM "user" WHERE "user".role_id IN ('.implode(',',$roles).')) AND id IN (SELECT profile_id FROM profile_region WHERE region_id =:region_id)';
                if ($myProfile->account){
                    $profile_managers = Yii::$app->db->createCommand($query,[
                        ':region_id'=>$myProfile->account->city_id,
                    ])->queryAll();
                }
                else{

                    $query = 'SELECT * FROM profile WHERE user_id IN (SELECT id FROM "user" WHERE "user".role_id IN ('.implode(',',$roles).'))';
                    $profile_managers = Yii::$app->db->createCommand($query)->queryAll();
                }
                foreach ($profile_managers as $profile){
                    $new_consult = new NewDeal();
                    $new_consult->date_created = date('Y-m-d H:i:s');
                    $new_consult->new_deal_id = $deal->id;
                    $new_consult->for_profile_id = $profile['id'];
                    $new_consult->save();
                }



                $new_deal = new NewDeal();
                $new_deal->new_deal_id = $deal->id;
                $new_deal->date_created = date('Y-m-d H:i:s');
                $new_deal->for_profile_id = $otherAccount->profile->id;
                $new_deal->save();


                $transaction->commit();
                Yii::$app->session->addFlash('success', 'Сделка предложена');
                return $this->redirect(['index']);
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->session->addFlash('danger', 'Сделка не предложена');
            }


        }

        return $this->render('create',['deal'=>$deal,'otherAccount'=>$otherAccount,'good'=>$item]);
    }

}