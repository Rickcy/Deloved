<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\AccountCategory;
use common\models\Affiliate;
use common\models\Category;
use common\models\CategoryType;
use common\models\Logo;
use common\models\OrgForm;
use common\models\Profile;
use common\models\Region;
use common\models\User;
use frontend\models\AccountForm;
use Yii;
use common\models\Account;
use common\models\search\AccountSearch;

use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\BaseFileHelper;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * AccountController implements the CRUD actions for Account model.
 */
class AccountController extends AuthController
{


    public $layout = '/admin';

    /**
     * Lists all Account models.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionIndex(){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $query = Account::find();
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);
        $query->orderBy(['created_at'=>SORT_DESC]);
        $query->all();

        return $this->render('index', [
            'account' => $dataProvider->models,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionChangeStatus($id,$type){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        if (Yii::$app->request->isAjax) {
            $account = Account::findOne($id);
            if ($type =='ps') {
                $publicStatus = $account->public_status == 0 ? $account->public_status = 1 : $account->public_status = 0;
                $account->save();
                return $this->renderAjax('status', ['status' => $publicStatus==1?true:false, 'statusClass' => 'publicStatus', 'iconFalse' => 'glyphicon-lock']);
            } if ($type =='vs') {
                if($account->verify_status == 0){
                    $user = $account->profile->user;
                    $email = $user->email;
                    try{
                        Yii::$app->common->sendMailEmailConfirm($email,$user);
                    }catch (Exception $exception){
                        return false;
                    }

                }
                $verifyStatus = $account->verify_status == 0 ? $account->verify_status = 1 : $account->verify_status = 0;
                $account->save();
                return $this->renderAjax('status', ['status' => $verifyStatus==1?true:false, 'statusClass' => 'verifyStatus']);
            }

        }


    }


    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionCreate(){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }



        $categoryType = CategoryType::find()->all();
        $category = Category::find()->all();
        $level_id=18;
        $city_list=Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();
        
        
        $model = new AccountForm();
        
        $profiles =Profile::find()
            ->select(['fio as  label','fio as value','fio as fio'])
            ->asArray()
            ->all();
        
        $org_forms =OrgForm::find()->all();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->createAccount();
            Yii::$app->session->addFlash('success', 'Account Create!');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,'org_forms'=>$org_forms,'profiles'=>$profiles,'city_list'=>$city_list,'categoryType'=>$categoryType,'category'=>$category
            ]);
        }
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $model = $this->findModel($id);

        $profile = User::findOne(Yii::$app->user->id)->profile;

        if (User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            Yii::$app->db
                ->createCommand('DELETE FROM new_account 
                    WHERE for_profile_id =:profile_id 
                      AND new_account_id =:account_id', [':profile_id' => $profile->id, 'account_id' => $model->id])
                ->execute();
        }

        $org_forms =OrgForm::find()->all();
        $profiles =Profile::find()->all();
        $level_id=18;
        $city_list=Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();
        $categoryType = CategoryType::find()->all();
        $category = Category::find()->all();
        $myAffiliates=$model->getAffiliates()->all();
        $myCategory =$model->getCategory()->all();
        $count =Affiliate::find()->where('account_id=:account_id',[':account_id'=>$model->id])->count();
        $logo = Account::findOne($id)->logos;


        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $model->city_id=$model->returnCity_id($model->city_name);
                $model->date_reg = $model->returnDate($model->date);
                $model->save();
                if($model->verify_status == 1){
                    if($model->profile_id){
                        if($model->profile->user_id){
                            Yii::$app->common->sendMailEmailConfirm($model->profile->user->email,$model->profile->user);
                        }
                    }
                }
                Yii::$app->session->addFlash('success', 'Account Update!');
                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                Yii::$app->session->addFlash('danger', 'Account not Update!');
            }


            return $this->redirect(['index']);

        }
            return $this->render('update', [

                'model' => $model,
                'profiles'=>$profiles,
                'org_forms'=>$org_forms,
                'city_list'=>$city_list,
                'myAffiliates'=>$myAffiliates,
                'categoryType'=>$categoryType,
                'category'=>$category,
                'myCategory'=>$myCategory,
                'count'=>$count,
                'logo'=>$logo
            ]);

    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionDelete($id){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $this->findModel($id)->delete();
        Yii::$app->session->addFlash('success', 'Account Delete!');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Account the loaded model
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }


        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionShow(){
        if (!User::checkRole(['ROLE_USER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $categoryType = CategoryType::find()->all();
        $category = Category::find()->all();
        
        $user= User::findOne(Yii::$app->user->id);
        $account=$user->profile->account;
        $logo = $account->logos;

        $level_id=18;
        $city_list=Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();

        $affiliate =Affiliate::find()->where('account_id=:account_id',[':account_id'=>$account->id])->all();
        $count =Affiliate::find()->where('account_id=:account_id',[':account_id'=>$account->id])->count();
        $myCategory =$account->category;


            return $this->render('show',[
                'account'=>$account,
                'category'=>$category,
                'categoryType'=>$categoryType,
                'myCategory'=>$myCategory,
                'affiliate'=>$affiliate,
                'count'=>$count,
                'city_list'=>$city_list,
                'logo'=>$logo
            ]);

    }



    public function actionUploadLogo(){
        if (!User::checkRole(['ROLE_USER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $model = new Logo();
        $account = User::findOne(Yii::$app->user->id)->profile->account;
        if (Yii::$app->request->isAjax){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $model->logo = UploadedFile::getInstancesByName('logoFile')[0];
                if(!is_dir(Yii::getAlias('@uploadDir'))){
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir'),0777);

                }
                if(!is_dir(Yii::getAlias('@uploadDir').'/acc_logos/')){
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir').'/acc_logos/',0777);
                }
                if(!is_dir(Yii::getAlias('@uploadDir').'/acc_logos/'.$account->id.'/')){
                    BaseFileHelper::createDirectory(Yii::getAlias('@uploadDir').'/acc_logos/'.$account->id.'/',0777);
                }

                $url = Yii::$app->security->generateRandomString(10).'.'.$model->logo->extension;
                $model->logo->saveAs(Yii::getAlias('@uploadDir').'/acc_logos/'.$account->id.'/'.$url);
                chmod(Yii::getAlias('@uploadDir').'/acc_logos/'.$account->id.'/'.$url,0777);

                $logo = new Logo();
                $logo->created_at = date('Y-m-d H:i');
                $logo->image_name = $model->logo->name;
                $logo->file = '/uploads/acc_logos/'.$account->id.'/'.$url;
                $logo->main_image = true;
                $logo->user_id = $account->id;
                $logo->save();

                $transaction->commit();
            }catch (Exception $e){
                $transaction->rollBack();
                return false;
            }

            Yii::$app->response->format = Response::FORMAT_JSON;
            return '/uploads/acc_logos/'.$account->id.'/'.$url;
        }
    }



    public function actionDeleteLogo(){
        if (!User::checkRole(['ROLE_USER','ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $path = Yii::$app->request->post('path');

        $photo = Logo::findOne(['file'=>$path]);
        if($photo){
            $photo->delete();
        }
        unlink(Yii::getAlias('@frontend').'/web'.$photo->file);
        return true;
    }



    public function actionAddAffiliate(){
        $level_id=18;
        $city_list=Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();
        $user=User::findOne(Yii::$app->user->id);
        $account=$user->getProfile()->where('user_id=:user_id',[':user_id'=>$user->id])->one()->getAccount()->one();
        $count =Affiliate::find()->where('account_id=:account_id',[':account_id'=>$account->id])->count();

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('affiliate',['aff'=>null,'count'=>$count,'active'=>true,'city_list'=>$city_list]);
        }

    }




    public function actionSaveNewAffiliate($address,$city,$email,$phone){



            $affiliate = new Affiliate();
            $user=User::findOne(Yii::$app->user->id);
        $account=$user->getProfile()->where('user_id=:user_id',[':user_id'=>$user->id])->one()->getAccount()->one();
            if($address&&$city&&$email&&$phone){
                $city_name='';
                $repeat = $affiliate->find()->where('address=:address',[':address'=>$address])->andWhere('account_id=:account_id',[':account_id'=>$account->id])->all();
                 if(Yii::$app->request->isPost){

                 $city_name=$affiliate->city_id = $affiliate->returnCity_id($city);
                 $affiliate->address = $address;
                 $affiliate->account_id = $account->id;
                 $affiliate->phone = $phone;
                 $affiliate->email = $email;


                 }
                if (!$repeat){
                if ($city_name){

                $affiliate->save();
                Yii::$app->session->addFlash('success', 'Успешно добавленно');
                }else{
                    Yii::$app->session->addFlash('danger', 'Нет такого города!');
                }
                }
                else{
                    Yii::$app->session->addFlash('danger', 'Данный адресс уже существует!');
                }
            }
            else{
            Yii::$app->session->addFlash('danger', 'Заполните все поля');
            }

        return json_encode(Yii::$app->session->getAllFlashes());
    }

    public function actionDeleteAffiliate($aff_id){
        if(Yii::$app->request->isPost) {
            $affiliate = Affiliate::findOne($aff_id);
            $affiliate->delete();
            Yii::$app->session->addFlash('success', 'Успешно удаленно');
        }
        return json_encode(Yii::$app->session->getAllFlashes());
    }

    public function actionEditAffiliate($address,$city,$email,$phone,$aff_id,$id=''){
        if($id==''){
            $user=User::findOne(Yii::$app->user->id);
            $account=$user->getProfile()->where('user_id=:user_id',[':user_id'=>$user->id])->one()->getAccount()->one();
        }
        if ($id!=''){
            $account =$this->findModel($id);
        }

        $affiliate = Affiliate::findOne($aff_id);

        if($address&&$city&&$email&&$phone){
            $city_name = '';
            if(Yii::$app->request->isPost){

                $city_name=$affiliate->city_id = $affiliate->returnCity_id($city);
                $affiliate->address = $address;
                $affiliate->account_id = $account->id;
                $affiliate->phone = $phone;
                $affiliate->email = $email;


            }
            if ($city_name){
            $affiliate->save();
            Yii::$app->session->addFlash('success', 'Успешно добавленно');
            }else{
                Yii::$app->session->addFlash('danger', 'Такого города нет в списке');
            }
        }
        else{
            Yii::$app->session->addFlash('danger', 'Заполните все поля');
        }

        return json_encode(Yii::$app->session->getAllFlashes());
    }





    public function actionEditNew($value,$prop){

        $user=User::findOne(Yii::$app->user->id);
        $account=$user->getProfile()->where('user_id=:user_id',[':user_id'=>$user->id])->one()->getAccount()->one();

        if (Yii::$app->request->isPost) {

            if ($prop=='city'){
               $city_name = $account->city_id=$account->returnCity_id($value);
                if ($city_name){
                    $account->save();
                    Yii::$app->session->addFlash('success', 'Успешно изменен');
                }else{
                    Yii::$app->session->addFlash('danger', 'Такого города нет в списке');
                }
            }else{
            $account->$prop =$value;
                $account->save();
                Yii::$app->session->addFlash('success', 'Успешно изменен');
            }

        }

            return json_encode(Yii::$app->session->getAllFlashes());



    }
    
    public function actionSaveCategory($goods,$service,$id=null){

        if ($id==null) {
            $user = User::findOne(Yii::$app->user->id);
            $account = $user->getProfile()->where('user_id=:user_id', [':user_id' => $user->id])->one()->getAccount()->one();
        }
            if ($id!==null){
            $account =$this->findModel($id);
        }

        if (Yii::$app->request->isPost) {
            $arr1=[];
            $arr2=[];
            if ($goods){$arr1 = explode(",", $goods);}
            if ($service){$arr2 = explode(",", $service);}
            $result = array_merge($arr1,$arr2);

            if($result[0]!=''){
               AccountCategory::deleteAll(['account_id'=>$account->id]);

            foreach ($result as $item){
                $category =new AccountCategory();

                $category->category_id=$item;
                $category->account_id=$account->id;

                $category->save();

            }
                Yii::$app->session->addFlash('success', 'Успешно добавлено!');
            } else{
                AccountCategory::deleteAll(['account_id'=>$account->id]);
                Yii::$app->session->addFlash('danger', 'Вы не выбрали категорию!');
            }

        }
        return json_encode(Yii::$app->session->getAllFlashes());
    }


}
