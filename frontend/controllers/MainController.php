<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 13.08.17
 * Time: 21:12
 */

namespace frontend\controllers;


use frontend\models\EmailConfirmForm;
use frontend\models\ResetPasswordForm;
use PhpOffice\PhpWord\PhpWord;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\httpclient\Client;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

class MainController extends Controller
{
    public $layout='/main';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],

                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex(){



        return $this->render('index');
    }

    public function actionEmailConfirm($token)
    {
        try {
            $model = new EmailConfirmForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($user = $model->confirmEmail()) {
            if (Yii::$app->getUser()->login($user)) {
                Yii::$app->session->addFlash('success', 'Спасибо! Ваш Email успешно подтверждён.');
                return $this->redirect('/admin');
            }
            return $this->goHome();
        } else {
            Yii::$app->session->addFlash('error', 'Ошибка подтверждения Email.');
        }

        return $this->goHome();
    }



    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws \yii\base\InvalidParamException
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->addFlash('success', 'Новый пароль сохранен!');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    public function actionGetDateByInnOrOgrn(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $innOrOgrn = (int)Yii::$app->request->post('innOrOgrn');
        if (is_int($innOrOgrn)){
        $httpClient = new Client();
        $data = $httpClient->createRequest()
            ->setMethod('post')
            ->setUrl('https://zachestnyibiznesapi.ru/v2/data/search')
            ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','string'=>$innOrOgrn])
            ->send();
            if(count($data->data['docs']) > 1 ){
                return ['docs'=>$data->data['docs']];
            }

        if ($data->isOk){
            $response = $httpClient->createRequest()
                ->setMethod('post')
                ->setUrl('https://zachestnyibiznesapi.ru/v2/data/card')
                ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','id'=>$data->data['docs'][0]['id']])
                ->send();

            return $response->data;
            }
        }
    }


    public function actionManyComp($inn,$ogrn){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $httpClient = new Client();
        $data = $httpClient->createRequest()
            ->setMethod('post')
            ->setUrl('https://zachestnyibiznesapi.ru/v2/data/search')
            ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','string'=>'managed_'.$ogrn.' '.$inn])
            ->send();
        if ($data->isOk){
            if(count($data->data['docs']) > 0){
                return true;
            }
            return false;
        }
    }


    public function actionGetDateFromList(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = (int)Yii::$app->request->post('id');
        $httpClient = new Client();
        $response = $httpClient->createRequest()
            ->setMethod('post')
            ->setUrl('https://zachestnyibiznesapi.ru/v2/data/card')
            ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','id'=>$id])
            ->send();

        return $response->data;
    }




}