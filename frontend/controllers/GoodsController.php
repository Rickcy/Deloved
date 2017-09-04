<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 30.08.17
 * Time: 23:02
 */

namespace frontend\controllers;


use common\models\Category;
use common\models\Goods;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class GoodsController extends Controller
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
        $goods_show_main = Goods::findAll(['show_main'=>1]);
        $query = Goods::find();
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 7,
            ]
        ]);
        $query->orderBy(['date_created'=>SORT_DESC]);
        $query->all();
        $categories = Category::findAll(['parent_id'=>1228]);

        return $this->render('index',
            ['categories'=>$categories,
                'goods_show_main'=>$goods_show_main,
                'goods'=>$dataProvider->models,
                'dataProvider'=>$dataProvider
            ]);
    }

    public function actionItem($id){

        return $this->render('item');
    }

}