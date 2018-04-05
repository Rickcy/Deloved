<?php


namespace app\modules\admin\controllers;;


use common\controllers\AuthController;
use common\models\Deal;
use common\models\NewReview;
use common\models\Profile;
use common\models\Review;
use common\models\User;
use Yii;
use yii\base\Exception;

class ReviewController extends AuthController
{
    public $layout = '/admin';

    public function actionIndex(){
        $account = (User::findOne(Yii::$app->user->id))->profile->account;
        $reviewAsAuthor = null;
        $reviewAsAbout = null;
        $reviewAll = null;
        if(User::checkRole(['ROLE_USER'])){
            $reviewAsAuthor = Review::findAll(['author_id'=>$account->id]);

            $reviewAsAbout = Review::findAll(['about_id'=>$account->id,'published'=>true]);

        }
        else{
            $reviewAll = Review::find()->all();
        }

        return $this->render('index',['reviewAsAuthor'=>$reviewAsAuthor,'reviewAsAbout'=>$reviewAsAbout,'reviewAll'=>$reviewAll]);
    }

    public function actionCreate($id){
        $deal = Deal::findOne($id);
        $profile = (User::findOne(Yii::$app->user->id))->profile;
        if (!$deal){
            Yii::$app->session->addFlash('danger', Yii::t('app','Такой сделки не существует'));
            return $this->redirect(['index']);
        }
        if ($deal->status != Deal::CONFIRMED && $deal->status != Deal::FAILED && $deal->status != Deal::REJECTED){
            Yii::$app->session->addFlash('danger', Yii::t('app','Сделка не закончена'));
            return $this->redirect('/admin/deal/show?id='.$id);
        }
        if (Review::findOne(['deal_id'=>$deal->id,'author_id'=>$profile->account->id])){
            Yii::$app->session->addFlash('danger', Yii::t('app','Отзыв о сделке уже написан'));
            return $this->redirect('/admin/deal/show?id='.$id);
        }
        if ($status = $deal->isOldDeal()){
            if($status == Deal::NOT_FOR_REVIEW){
                Yii::$app->session->addFlash('danger', Yii::t('app','Feedback can be left only no later than 30 days after its completion'));
                return $this->redirect('/admin/deal/show?id='.$id);
            }
            if($status == Deal::REJECTED){
                Yii::$app->session->addFlash('danger', 'Сделка отвергнута');
                return $this->redirect('/admin/deal/show?id='.$id);
            }
        }
        else{

            $isOwner = $deal->buyer_id == $profile->id;
            $isPartner = $deal->seller_id == $profile->id;
            if(!$isOwner && !$isPartner){
                Yii::$app->session->addFlash('danger', 'Deal not exist');
                return $this->redirect(['index']);
            }
            elseif (!$isOwner){
                $from = $deal->seller;
                $to = $deal->buyer;
            }
            else{
                $from = $deal->buyer;
                $to = $deal->seller;
            }
            $review = new Review();
            $review->deal_id = $deal->id;
            $review->about_id = $to->account->id;
            $review->author_id = $from->account->id;
            $review->published = false;
            if($review->load(Yii::$app->request->post()) && $review->validate()){
                $transaction = Yii::$app->db->beginTransaction();
                try{

                    $review->date_created = date('Y-m-d H:i:s');
                    $review->published = false;
                    $review->save();

                    $new_review = New NewReview();
                    $new_review->new_review_id = $review->id;
                    $new_review->for_profile_id = Profile::ID_PROFILE_ADMIN;
                    $new_review->date_created = date('Y-m-d H:i:s');
                    $new_review->save();

                    $new_review = New NewReview();
                    $new_review->new_review_id = $review->id;
                    $new_review->date_created = date('Y-m-d H:i:s');
                    $new_review->for_profile_id = 2;
                    $new_review->save();

                    Yii::$app->session->addFlash('success', 'Отзыв написан, ждите пока проверит модератор');
                    $transaction->commit();
                }catch (Exception $exception){
                    $transaction->rollBack();
                    Yii::$app->session->addFlash('danger', $exception->getMessage());

                }
                return $this->redirect(['index']);
            }

        }

        return $this->render('create',['deal'=>$deal,'to'=>$to,'from'=>$from,'review'=>$review]);
    }


    public function actionEdit($id){
        $review = Review::findOne($id);

        NewReview::deleteAll(['new_review_id'=>$review->id]);

        if($review->load(Yii::$app->request->post()) && $review->validate()){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                if($review->published == true){
                    $review->date_published = date('Y-m-d H:i:s');
                    NewReview::deleteAll(['new_review_id'=>$review->id,'for_profile_id'=>$review->about->profile->id]);
                    $new_review = New NewReview();
                    $new_review->new_review_id = $review->id;
                    $new_review->for_profile_id = $review->about->profile->id;
                    $new_review->date_created = date('Y-m-d H:i:s');
                    $new_review->save();
                }
                $review->save();

                NewReview::deleteAll(['new_review_id'=>$review->id,'for_profile_id'=>$review->author->profile->id]);



                if(!User::checkRole(['ROLE_USER']) && $review->published != true){
                    $new_review = New NewReview();
                    $new_review->date_created = date('Y-m-d H:i:s');
                    $new_review->new_review_id = $review->id;
                    $new_review->for_profile_id = $review->author->profile->id;
                    $new_review->save();
                }
                if(User::checkRole(['ROLE_USER'])){
                    $new_review = New NewReview();
                    $new_review->date_created = date('Y-m-d H:i:s');
                    $new_review->new_review_id = $review->id;
                    $new_review->for_profile_id = Profile::ID_PROFILE_ADMIN;
                    $new_review->save();

                    $new_review = New NewReview();
                    $new_review->new_review_id = $review->id;
                    $new_review->for_profile_id = 2;
                    $new_review->date_created = date('Y-m-d H:i:s');
                    $new_review->save();


                    Yii::$app->session->addFlash('success', 'Отзыв написан, ждите пока проверит модератор');
                }
                $transaction->commit();
            }catch (Exception $exception){
                $transaction->rollBack();
                Yii::$app->session->addFlash('danger', $exception->getMessage());

            }
            return $this->redirect(['index']);
        }

        return $this->render('edit',['review'=>$review]);
    }




    public function actionShow($id){
        $review = Review::findOne($id);
        NewReview::deleteAll(['new_review_id'=>$review->id]);
        return $this->render('show',['review'=>$review]);
    }
}