<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 30.08.17
 * Time: 23:03
 */

namespace frontend\controllers;


use common\models\Category;
use common\models\Services;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ServicesController extends Controller
{
    public $layout='/front';
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
        $services_show_main = Services::findAll(['show_main'=>1]);
        $query = Services::find();
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 7,
            ]
        ]);
        $query->orderBy(['date_created'=>SORT_DESC]);
        $query->all();
        $categories = Category::findAll(['parent_id'=>1343]);

        return $this->render('index',
            ['categories'=>$categories,
                'services_show_main'=>$services_show_main,
                'services'=>$dataProvider->models,
                'dataProvider'=>$dataProvider
            ]);
    }


    public function actionItem($id){

        return $this->render('item');
    }
}