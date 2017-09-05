<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 30.08.17
 * Time: 23:03
 */

namespace frontend\controllers;


use common\models\Account;
use common\models\Category;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class CompaniesController extends Controller
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


    public function actionIndex(int $cat = null){
        $company_show_main = Account::findAll(['show_main'=>1]);
        $query = Account::find();
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 5,
            ]
        ]);
        $activeCat = null;
        if($cat){
            $activeCat = Category::findOne($cat);
            $query->join('JOIN','account_category','account_category.account_id = account.id')
                ->where(['account_category.category_id'=>$cat]);
        }
        $query->orderBy(['description'=>SORT_ASC]);
        $query->all();
        $categoriesGoods = Category::findAll(['parent_id'=>[1228]]);
        $categoriesServices = Category::findAll(['parent_id'=>[1343]]);

        return $this->render('index',
            [
                'categoriesGoods'=>$categoriesGoods,
                'categoriesServices'=>$categoriesServices,
                'activeCat'=>$activeCat,
                'company_show_main'=>$company_show_main,
                'companies'=>$dataProvider->models,
                'dataProvider'=>$dataProvider
            ]);
    }

    public function actionItem($id){

        return $this->render('item');
    }
}