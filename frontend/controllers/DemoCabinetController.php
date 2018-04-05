<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 30.01.18
 * Time: 18:37
 */

namespace frontend\controllers;


use common\models\Account;
use common\models\Category;
use common\models\CategoryType;
use common\models\Region;
use yii\web\Controller;
use yii\web\Response;

class DemoCabinetController extends Controller
{
    public $layout='/demo';

    public function actionIndex(){

        return $this->render('demo');
    }


    public function actionAccount(){
        $categoryType = CategoryType::find()->all();
        $category = Category::find()->all();
        $myCategory =(Account::findOne(9069))->category;
        $level_id=18;
        $city_list=Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();

        return $this->render('account', ['categoryType' => $categoryType, 'myCategory' => $myCategory, 'category' => $category, 'city_list' => $city_list]);
    }



    public function actionDeal(){

        return $this->render('deal');
    }

    public function actionClaim(){

        return $this->render('claim');
    }

    public function actionDispute(){

        return $this->render('dispute');
    }

    public function actionConsult(){

        return $this->render('consult');
    }

    public function actionTicket(){

        return $this->render('ticket');
    }

    public function actionGoods(){

        return $this->render('goods');
    }

    public function actionServices(){

        return $this->render('services');
    }


    public function actionChat($id){

        $type = $id;

        return $this->render('chat', ['type' => $type]);
    }


    public function actionDocument(){

        return $this->render('documents');
    }

    public function actionDocumentForServices(){

        return $this->render('document-for-services');
    }

    public function actionCreate($id){
        $type = $id;
        return $this->render('create', ['type' => $type]);

    }

    public function actionProfile(){

        return $this->render('profile');
    }

    public function actionBilling(){

        return $this->render('billing');
    }


    public function actionDocumentContract(){

        return $this->render('document-contract');
    }

    public function actionServicesCreate(){
        $myCategory =(Account::findOne(9069))->category;
        return $this->render('services-create', ['myCategory' => $myCategory]);
    }

    public function actionGoodsCreate(){
        $myCategory =(Account::findOne(9069))->category;
        return $this->render('goods-create', ['myCategory' => $myCategory]);
    }

    public function actionGood(){
        $myCategory =(Account::findOne(9069))->category;
        return $this->render('good', ['myCategory' => $myCategory]);
    }

    public function actionService(){
        $myCategory =(Account::findOne(9069))->category;
        return $this->render('service', ['myCategory' => $myCategory]);
    }


    public function actionReview(){

        return $this->render('reviews');
    }

    public function actionInformation(){

        return $this->render('information');
    }


    public function actionGate(){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return true;
    }
}