<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\Experience;
use common\models\ProfileRegion;
use common\models\Region;
use common\models\User;
use frontend\models\ChangePassForm;
use Yii;
use common\models\Profile;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends AuthController
{

    public $layout ='/admin';

    /**
     * Lists all Profile models.
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionIndex()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }


        $profiles =Profile::find()->all();

        return $this->render('index', [
           'profiles'=>$profiles
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     */


    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $regions=Region::find()->all();
        $model = $this->findModel($id);
        $myRegions = $model->getRegions()->all();
        $level_id=18;
        $city_list=Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('update', [
                'model' => $model,'city_list'=>$city_list,'regions'=>$regions,'myRegions'=>$myRegions
            ]);
        }
    }


    /**
     * @param $id
     * @param $fio
     * @param $email
     * @param $city
     * @param $status
     * @param $date
     * @param $experience
     * @param $regions
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionEditProfile($id, $fio, $email, $city, $status, $date, $experience,$regions){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $regions = explode(",", $regions);


        $model=$this->findModel($id);
        $exp_model=Experience::find()->where('profile_id=:profile_id',[':profile_id'=>$id])->one();
        if(Yii::$app->request->isAjax){
            if (!$model->validate()){
                Yii::$app->session->addFlash('danger', "Некорректный профиль");
            }
            else{

                if($regions[0]!==''){
                    ProfileRegion::deleteAll('profile_id=:profile_id',[':profile_id'=>$id]);

                    foreach ($regions as $item){
                        $region =new ProfileRegion();

                        $region->region_id=$item;
                        $region->profile_id=$id;

                        $region->save();

                    }
                } else{
                    ProfileRegion::deleteAll('profile_id=:profile_id',[':profile_id'=>$id]);

                }
                if ($experience!='null'){
                $experience==''?$exp_model->experience=null:$exp_model->experience=$experience;
                $exp_model->save();
                }

                $model->fio=$fio;
                if ($email==''){
                    $model->email=$model->email;
                }else{
                    $model->email=$email;
                    $user = User::findOne($model->user_id);
                    $user->email=$email;
                    $user->save();
                }



                $city==''?$model->city_id=null:$model->city_id=$model->returnCity_id($city);
                $date==''?$model->chargeTill=null:$model->chargeTill=$model->returnDate($date);
                $model->chargeStatus=$status;
                $model->save();
                Yii::$app->session->addFlash('success', "Профиль обнавлен");

            }
        }
        return json_encode(Yii::$app->session->getAllFlashes());

    }



    public function actionShow(){
        $user = User::findOne(Yii::$app->user->id);
        $profile = $user->getProfile()->one();
        $level_id=18;
        $city_list=Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();



        return $this->render('show', [
            'profile'=>$profile,'city_list'=>$city_list
        ]);


    }



    public function actionEditNew($value,$prop){

        $user=User::findOne(Yii::$app->user->id);
        $profile=$user->getProfile()->where('user_id=:user_id',[':user_id'=>$user->id])->one();

        if (Yii::$app->request->isPost) {

            if ($prop=='city'){
                $city_name = $profile->city_id=$profile->returnCity_id($value);
                if ($city_name){
                    $profile->save();
                    Yii::$app->session->addFlash('success', 'Успешно изменен');
                }else{
                    Yii::$app->session->addFlash('danger', 'Такого города нет в списке');
                }
            }else{
                $profile->$prop =$value;
                $profile->save();
                Yii::$app->session->addFlash('success', 'Успешно изменен');
            }

        }

        return json_encode(Yii::$app->session->getAllFlashes());



    }



    public function actionPassword(){
        
        $model = new ChangePassForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $res = $model->changePass();
            if ($res){
                Yii::$app->session->addFlash('success', 'Пароль успешно изменен!');
                return $this->redirect('/admin/profile/show');
            }
            else{
                Yii::$app->session->addFlash('danger', 'Ошибка!');
                return $this->redirect(['/admin/profile/password',
                    'model' => $model
                ]);
            }

        } else {
            return $this->render('passwd', [
                'model' => $model
            ]);
        }

    }






    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
