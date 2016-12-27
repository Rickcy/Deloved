<?php

namespace app\modules\admin\controllers;

use common\models\CategoryType;
use Yii;
use common\models\Category;
use common\models\search\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{






    public $layout = '/admin';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $categoryType = Category::find()->where('parent_id=:parent_id',['parent_id'=>1])->all();

        return $this->render('index', [
            'categoryType'=>$categoryType
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=Category::findOne($id);
        $category = Category::find()
            ->where('parent_id=:parent_id',['parent_id'=>$id])
            ->all();
        return $this->render('view', [
            'model'=>$model,'category'=>$category
        ]);
    }

    /**
     * Creates a new Category model.
     * @param $cat_name
     * @param $parent_cat
     * @param $cat_id
     * @return mixed
     */
    public function actionCreateCategory($cat_name,$parent_cat,$cat_id)
    {
        $model = new Category();
        if ($cat_name==''){
            Yii::$app->session->addFlash('danger', "Имя не заполнено");
        }
        if ($cat_name!=''){
        if(Yii::$app->request->isAjax){
            $model->parent_id=$parent_cat;
            $model->name=$cat_name;
            $model->categorytype_id=$cat_id;

        }
            $model->save();
            Yii::$app->session->addFlash('success', "Категория $cat_name добавлена");
    }

    return json_encode(Yii::$app->session->getAllFlashes());
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param $parent_id
     * @return mixed
     */
    public function actionDelete($id,$parent_id)
    {
        $model=$this->findModel($parent_id);
        $this->findModel($id)->delete();
        Yii::$app->session->addFlash('success', 'Category Delete!');
        return $this->redirect(['view','id'=>$model->id]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
