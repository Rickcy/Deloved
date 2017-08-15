<?php
namespace frontend\controllers;

use common\models\Currency;
use common\models\LoginForm;
use common\models\Measure;
use common\models\Profile;
use common\models\SuggestionCat;
use common\models\Tariffs;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SuggestionForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

class ValidateController extends Controller{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'login' => ['get', 'post'],
                    'contact' => ['get', 'post'],
                    'suggestion' => ['get', 'post'],
                    'reset' => ['get', 'post'],
                    'change' => ['get', 'post'],
                    'profile' => ['get', 'post'],
                    'currency' => ['get', 'post'],
                    'measure' => ['get', 'post'],
                    'tariff' => ['get', 'post'],
                    'sug-cat' => ['get', 'post'],
                ],
            ],
        ];
    }


    public function actionLogin(){

        $model = new LoginForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }


    }

    public function actionContact(){
        $model = new ContactForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionSugCat(){
        $model = new SuggestionCat();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }


    public function actionSuggestion(){
        $model = new SuggestionForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionReset(){
        $model = new PasswordResetRequestForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionProfile(){
        $model = new Profile();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionCurrency(){
        $model = new Currency();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionMeasure(){
        $model = new Measure();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    public function actionTariff(){
        $model = new Tariffs();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }


//    public function actionSubscribe(){
//
//        $model = new Subscribe();
//
//        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
//            Yii::$app->response->format = Response::FORMAT_JSON;
//            return ActiveForm::validate($model);
//        }
//
//
//    }

}