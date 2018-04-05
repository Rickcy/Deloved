<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 31.08.17
 * Time: 23:48
 */

namespace app\modules\admin\controllers;


use common\controllers\AuthController;
use common\models\Measure;
use common\models\Region;
use common\models\User;
use frontend\models\DocumentForm;
use Yii;
use yii\web\Response;

class DocumentController extends AuthController
{

    public $layout = '/admin';


    public function actionIndex(){

        return $this->render('index');
    }

    public function actionDeliveryContract(){

        $account = (User::findOne(Yii::$app->user->id))->profile->account;

        $level_id=18;
        $city_list= Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();

        $measure = Measure::find()->where('type_id=:type_id',[':type_id'=>1227])->all();
        $documentForm = new DocumentForm(['scenario'=>DocumentForm::SCENARIO_DELIVERY_CONTRACT]);
        if ($documentForm->load(Yii::$app->request->post())) {
            $documentForm->saveDeliveryContract();
        }
        return $this->render('delivery-contract',['documentForm'=>$documentForm,'city_list'=>$city_list,'measure'=>$measure,'account'=>$account]);
    }

    public function actionContractForServices(){

        $account = (User::findOne(Yii::$app->user->id))->profile->account;

        $documentForm = new DocumentForm(['scenario'=>DocumentForm::SCENARIO_СONTRACT_FOR_SERVICES]);
        $level_id = 18;
        $city_list= Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();

        if ($documentForm->load(Yii::$app->request->post())) {
            $documentForm->saveСontractForServices();
        }


        return $this->render('contract-for-services',['documentForm'=>$documentForm,'city_list'=>$city_list,'account'=>$account]);
    }

    public function actionGetMyData(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $account  = (User::findOne(Yii::$app->user->id))->profile->account;
        return $account->inn;
    }
}