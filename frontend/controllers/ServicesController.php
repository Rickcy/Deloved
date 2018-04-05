<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 30.08.17
 * Time: 23:03
 */

namespace frontend\controllers;


use common\models\Category;
use common\models\CountView;
use common\models\Region;
use common\models\Services;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class ServicesController extends Controller
{
    public $layout='/front';

    public $group = 'services';
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
                    'search' => ['post'],

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


    /**
     * @return string
     */
    public function actionSearch(){
        $level_id = 18;
        $cats = Category::find()->filterWhere(['!=','parent_id',null])->andFilterWhere(['!=','parent_id','1227'])->all();
        $city_list= Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();
        $search = Yii::$app->request->post('search');
        $city = Yii::$app->request->post('city');
        $cat = Yii::$app->request->post('cat');
        $priceMax = Yii::$app->request->post('priceMax');
        $priceMin = Yii::$app->request->post('priceMin');
        $acc = [];
        if($search){
            if($city){
                $city = Region::findOne(['name'=>$city]);
                $a = Services::find()
                    ->orFilterWhere(['like','name','%'.$search.'%'])
                    ->orFilterWhere(['like','description','%'.$search.'%'])
                    ->orFilterWhere(['like','model','%'.$search.'%'])->all();
                foreach ($a as $q){
                    if($q->account->city_id == $city->id){
                        $a[] = $q;
                    }

                }
            }
            else{
                $a = Services::find()
                    ->orFilterWhere(['like','name','%'.$search.'%'])
                    ->orFilterWhere(['like','description','%'.$search.'%'])
                    ->orFilterWhere(['like','model','%'.$search.'%'])->all();

            }
            if($cat){
                $a = Services::find()
                    ->orFilterWhere(['like','name','%'.$search.'%'])
                    ->orFilterWhere(['like','description','%'.$search.'%'])
                    ->orFilterWhere(['like','model','%'.$search.'%'])->andWhere(['category_id'=>$cat])->all();
            }
            $acc[] = $a;

        }
        return $this->render('search', ['search' =>$search, 'city_list' => $city_list, 'cats' => $cats, 'acc' => $acc]);

    }



    public function actionIndex(int $cat = null){

        $services_show_main = Services::findAll(['show_main'=>1]);
        $query = Services::find();
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 7,
            ]
        ]);
        $activeCat = null;

        if($cat){
            $activeCat = Category::findOne($cat);
            $categs = Services::getCategories($activeCat);
            $query->where(['in', 'category_id', $categs]);
        }
        $query->orderBy(['date_created'=>SORT_DESC]);
        $query->all();
        if($cat){
            $categories = Category::findAll(['parent_id'=>$cat]);
        }
        else{
            $categories = Category::findAll(['parent_id'=>1343]);
        }
        return $this->render('index',
            [
                'activeCat'=>$activeCat,
                'categories'=>$categories,
                'services_show_main'=>$services_show_main,
                'services'=>$dataProvider->models,
                'dataProvider'=>$dataProvider,

            ]);
    }


    public function actionItem($id){
        $service = Services::findOne((int)$id);
        $group ='services';
        if (!$service){
            throw new ForbiddenHttpException('Нет такой услуги');
        }
        $account = $service->account;
        if(Yii::$app->user->isGuest){
            $count = CountView::findOne(['account_id'=>$account->id]);
            if(!$count){
                $count = new CountView();
                $count->account_id = $account->id;
            }
            $count->count_services_for_all = $count->count_services_for_all+1;
            $count->count_services_for_month = $count->count_services_for_month+1;
            $count->save();
        }
        else{
            if (!in_array((User::findOne(Yii::$app->user->id))->role_id, [1, 3, 4, 5, 6, 7])) {
                $myAccount = (User::findOne(Yii::$app->user->id)->profile->account);
                if ($myAccount->id != $account->id) {
                    $count = CountView::findOne(['account_id' => $account->id]);
                    if (!$count) {
                        $count = new CountView();
                        $count->account_id = $account->id;
                    }
                    $count->count_services_for_all = $count->count_services_for_all + 1;
                    $count->count_services_for_month = $count->count_services_for_month + 1;

                    $count->save();
                }
            }
        }
        return $this->render('item',['service' => $service,]);
    }
}