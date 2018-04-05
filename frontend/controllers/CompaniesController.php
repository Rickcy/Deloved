<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 30.08.17
 * Time: 23:03
 */

namespace frontend\controllers;


use common\models\Account;
use common\models\AccountCategory;
use common\models\Affiliate;
use common\models\Category;
use common\models\CountView;
use common\models\Region;
use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class CompaniesController extends Controller
{

    public $layout='/front';

    public $group = 'companies';
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


    public function actionSearch(){

        $cats = Category::find()->filterWhere(['!=','parent_id',null])->andFilterWhere(['!=','parent_id','1227'])->all();


        $city_list= Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>18])
            ->asArray()
            ->all();



        $region_list= Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>17])
            ->asArray()
            ->all();

        $categ_list = Category::find()
            ->select(['name as label','name as value','name as name'])
            ->asArray()->all();


        $search = Yii::$app->request->post('search');
        $region = Yii::$app->request->post('region');

        $ids=[];

        if($region){
            $region = Region::findOne(['name'=>$region]);
            $regions = Region::find()->select('id')->where(['parent_id'=>$region->id])->asArray()->all();
            foreach ($regions as $region){
                $ids[]=$region['id'];
            }
        }
        $city = Yii::$app->request->post('city');
        $cat = Yii::$app->request->post('cat');

        if($cat){
            $cat = (Category::findOne(['name'=>$cat]))->id;
        }

        $acc = [];
        if(!empty((int)($search))){
            $a = Account::findOne(['inn'=>$search]);
            if($a){
                if($cat && !$city){
                    if($region){
                        $a = AccountCategory::find()->where(['category_id'=>$cat])->andWhere(['account_id'=>$a->id])->andWhere(['in','city_id'=>$regions])->one();
                        if($a){
                            $a = Account::findOne($a->account_id);
                        }
                    }
                    else{
                        $a = AccountCategory::find()->where(['category_id'=>$cat])->andWhere(['account_id'=>$a->id])->one();
                        if($a){
                            $a = Account::findOne($a->account_id);
                        }
                    }


                }
            }
            elseif($city && !$cat){
                $city = Region::findOne(['name'=>$city]);
                $a = Account::find()->where(['inn'=>$search])->andWhere(['city_id'=>$city->id])->one();
            }
            elseif($city && $cat){
                $a = AccountCategory::find()->where(['category_id'=>$cat])->andWhere(['account_id'=>$a->id])->one();
                if($a){
                    $a = Account::find()->andWhere(['id'=>$a->account_id])->andWhere(['city_id'=>$city->id])->one();
                }

            }
            if($a){
                $acc[] = $a;
            }


        }
        else{

            if($search){

             if($cat && !$city){

                 if($region){
                     $a = Account::find()
                         ->orFilterWhere(['ilike','full_name','%'.mb_strtoupper($search).'%',false])
                         ->orFilterWhere(['ilike','full_name','%'.$search.'%',false])
                         ->orFilterWhere(['ilike','full_name','%'.mb_strtolower($search).'%',false])
                         ->orFilterWhere(['ilike','brand_name','%'.mb_strtoupper($search).'%',false])
                         ->orFilterWhere(['ilike','brand_name','%'.$search.'%',false])
                         ->orFilterWhere(['ilike','brand_name','%'.mb_strtolower($search).'%',false])
                         ->orFilterWhere(['like','email','%'.$search.'%',false])
                         ->orFilterWhere(['like','description','%'.$search.'%',false])
                         ->orFilterWhere(['like','legal_address','%'.$search.'%',false])->where(['in','city_id',$ids])->all();
                     if($a){
                         $ids = [];
                         foreach ($a as $ase){
                             $ids[]=$ase->id;
                         }
                         $a = AccountCategory::find()->where(['category_id'=>$cat])->andWhere(['in','account_id',$ids])->all();
                     }

                     if($a){
                         $ids = [];
                         foreach ($a as $ase){
                             $ids[]=$ase->id;
                         }
                         $a = Account::find()->andWhere(['in','id',$ids])->all();
                     }
                 }
                 else{
                     $a = Account::find()
                         ->orFilterWhere(['ilike','full_name','%'.mb_strtoupper($search).'%',false])
                         ->orFilterWhere(['ilike','full_name','%'.$search.'%',false])
                         ->orFilterWhere(['ilike','full_name','%'.mb_strtolower($search).'%',false])
                         ->orFilterWhere(['ilike','brand_name','%'.mb_strtoupper($search).'%',false])
                         ->orFilterWhere(['ilike','brand_name','%'.$search.'%',false])
                         ->orFilterWhere(['ilike','brand_name','%'.mb_strtolower($search).'%',false])
                         ->orFilterWhere(['like','email','%'.$search.'%',false])
                         ->orFilterWhere(['like','description','%'.$search.'%',false])
                         ->orFilterWhere(['like','legal_address','%'.$search.'%',false])->all();
                     if($a){
                         $ids = [];
                         foreach ($a as $ase){
                             $ids[]=$ase->id;
                         }
                         $a = AccountCategory::find()->where(['category_id'=>$cat])->andWhere(['in','account_id',$ids])->all();
                     }

                     if($a){
                         $ids = [];
                         foreach ($a as $ase){
                             $ids[]=$ase->id;
                         }
                         $a = Account::find()->andWhere(['in','id',$ids])->all();
                     }
                 }

            }
            elseif(!$cat && $city){
                $city = Region::findOne(['name'=>$city]);
                $a = Account::find()
                    ->orFilterWhere(['ilike','full_name','%'.mb_strtoupper($search).'%',false])
                    ->orFilterWhere(['ilike','full_name','%'.$search.'%',false])
                    ->orFilterWhere(['ilike','full_name','%'.mb_strtolower($search).'%',false])
                    ->orFilterWhere(['ilike','brand_name','%'.mb_strtoupper($search).'%',false])
                    ->orFilterWhere(['ilike','brand_name','%'.$search.'%',false])
                    ->orFilterWhere(['ilike','brand_name','%'.mb_strtolower($search).'%',false])
                    ->orFilterWhere(['like','email','%'.$search.'%',false])
                    ->orFilterWhere(['like','description','%'.$search.'%',false])
                    ->orFilterWhere(['like','legal_address','%'.$search.'%',false])->andWhere(['city_id'=>$city->id])->all();
            }
             elseif($cat && $city){
                 $city = Region::findOne(['name'=>$city]);
                $a = Account::find()
                    ->orFilterWhere(['ilike','full_name','%'.mb_strtoupper($search).'%',false])
                    ->orFilterWhere(['ilike','full_name','%'.$search.'%',false])
                    ->orFilterWhere(['ilike','full_name','%'.mb_strtolower($search).'%',false])
                    ->orFilterWhere(['ilike','brand_name','%'.mb_strtoupper($search).'%',false])
                    ->orFilterWhere(['ilike','brand_name','%'.mb_strtolower($search).'%',false])
                    ->orFilterWhere(['ilike','brand_name','%'.$search.'%',false])
                    ->orFilterWhere(['like','email','%'.$search.'%',false])
                    ->orFilterWhere(['like','description','%'.$search.'%',false])
                    ->orFilterWhere(['like','legal_address','%'.$search.'%',false])->andWhere(['city_id'=>$city->id])->all();
                if($a){
                    $ids = [];
                    foreach ($a as $ase){
                        $ids[]=$ase->id;
                    }
                    $a = AccountCategory::find()->where(['category_id'=>$cat])->andWhere(['in','account_id',$ids])->all();
                }
                if($a){
                    $ids = [];
                    foreach ($a as $ase){
                        $ids[]=$ase->id;
                    }
                    $a = Account::find()->andWhere(['in','id',$ids])->all();
                }
            }
            else{
                 if($region){

                     $a = Account::find()
                         ->orFilterWhere(['ilike','full_name','%'.mb_strtoupper($search).'%',false])
                         ->orFilterWhere(['ilike','full_name','%'.$search.'%',false])
                         ->orFilterWhere(['ilike','full_name','%'.mb_strtolower($search).'%',false])
                         ->orFilterWhere(['ilike','brand_name','%'.mb_strtoupper($search).'%',false])
                         ->orFilterWhere(['ilike','brand_name','%'.$search.'%',false])
                         ->orFilterWhere(['ilike','brand_name','%'.mb_strtolower($search).'%',false])
                         ->orFilterWhere(['like','email','%'.$search.'%',false])
                         ->orFilterWhere(['like','description','%'.$search.'%',false])
                         ->orFilterWhere(['like','legal_address','%'.$search.'%',false])->andWhere(['in','city_id',$ids])->all();
                 }
                 else{
                     $a = Account::find()
                         ->orFilterWhere(['ilike','full_name','%'.mb_strtoupper($search).'%',false])
                         ->orFilterWhere(['ilike','full_name','%'.$search.'%',false])
                         ->orFilterWhere(['ilike','full_name','%'.mb_strtolower($search).'%',false])
                         ->orFilterWhere(['ilike','brand_name','%'.mb_strtoupper($search).'%',false])
                         ->orFilterWhere(['ilike','brand_name','%'.$search.'%',false])
                         ->orFilterWhere(['ilike','brand_name','%'.mb_strtolower($search).'%',false])
                         ->orFilterWhere(['like','email','%'.$search.'%',false])
                         ->orFilterWhere(['like','description','%'.$search.'%',false])
                         ->orFilterWhere(['like','legal_address','%'.$search.'%',false])->all();
                 }

            }
                if($a){
                    $acc = $a;
                }
            }

        }

        return $this->render('search', ['search' =>$search, 'city_list' => $city_list,'region_list' => $region_list, 'cats' => $cats, 'acc' => $acc,'categ_list'=>$categ_list]);

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
        $query->orderBy(['created_at'=>SORT_DESC]);
        $query->where(['public_status'=>1]);
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
                'dataProvider'=>$dataProvider,

            ]);
    }

    public function actionItem($id){

        $account = Account::findOne((int)$id);
        $aff = Affiliate::findAll(['account_id'=>$account->id]);

        if (!$account){
            throw new ForbiddenHttpException('Нет такого предприятия');
        }
        if($account->verify_status === 1){
            if(Yii::$app->user->isGuest){
                $count = CountView::findOne(['account_id'=>$account->id]);
                if(!$count){
                    $count = new CountView();
                    $count->account_id = $account->id;
                }
                $count->count_for_all = $count->count_for_all+1;
                $count->count_for_month = $count->count_for_month+1;
                $count->save();
            }
            else{
                if (!in_array((User::findOne(Yii::$app->user->id))->role_id,[1,3,4,5,6,7])){
                    $myAccount = (User::findOne(Yii::$app->user->id)->profile->account);
                    if($myAccount->id != $account->id){
                        $count = CountView::findOne(['account_id'=>$account->id]);
                        if(!$count){
                            $count = new CountView();
                            $count->account_id = $account->id;
                        }
                        $count->count_for_all = $count->count_for_all+1;
                        $count->count_for_month = $count->count_for_month+1;

                        $count->save();
                    }
                }

            }
        }

        return $this->render('item',['company'=>$account,'aff'=>$aff,]);
    }
}