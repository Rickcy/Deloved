<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 23.10.17
 * Time: 23:12
 */

namespace frontend\controllers;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ArticleController extends Controller
{
        public $layout = "/front";

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



    public function actionCreate_deal_online(){

        return $this->render('create_deal_online');
    }

    public function actionMediation_regulator(){

        return $this->render('mediation_regulator');
    }

    public function actionPopular_company(){

        return $this->render('popular_company');
    }

    public function actionRating_company(){

        return $this->render('rating_company');
    }

    public function actionDeal(){

        return $this->render('deal');
    }

    public function actionJurist(){

        return $this->render('jurist');
    }

    public function actionMediation(){

        return $this->render('mediation');
    }

    public function actionJudge(){

        return $this->render('judge');
    }

    public function actionRating(){

        return $this->render('rating');
    }

    public function actionMediationService(){

        return $this->render('mediation_service');
    }


}