<?php

namespace app\modules\admin\controllers;

use common\models\CategoryType;
use common\models\User;
use Yii;
use common\models\Category;
use common\models\search\CategorySearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
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
     * @throws ForbiddenHttpException
     */
    public function actionIndex()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $categoryType = Category::find()->where('parent_id=:parent_id',['parent_id'=>1])->all();

        return $this->render('index', [
            'categoryType'=>$categoryType
        ]);
    }

    /**
     * Displays a single Category model.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionView($id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $model=Category::findOne($id);
        $child=$model->getChild()->all();
        $category = Category::find()
            ->where('parent_id=:parent_id',['parent_id'=>$id])
            ->all();
        return $this->render('view', [
            'model'=>$model,'category'=>$category,'child'=>$child
        ]);
    }

    /**
     * Creates a new Category model.
     * @param $cat_name
     * @param $parent_cat
     * @param $cat_id
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionCreateCategory($cat_name,$parent_cat,$cat_id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $id_model=null;
        $model = new Category();
        if ($cat_name==''){
            Yii::$app->session->addFlash('danger', "Empty Category!");
        }
        if ($cat_name!=''){
        if(Yii::$app->request->isAjax){
            $model->parent_id=$parent_cat;
            $model->name=$cat_name;
            $model->categorytype_id=$cat_id;

        }

            $model->save();
            $id_model = $model->id;
            Yii::$app->session->addFlash('success', "Category $cat_name Add");

    }
        $mes = [Yii::$app->session->getAllFlashes(),'id_model'=>$id_model];
    return Json::encode($mes);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionEditCategory($id,$name){
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $model=$this->findModel($id);
        if($name==''){
            Yii::$app->session->addFlash('danger', "Empty Category!");
            return json_encode(Yii::$app->session->getAllFlashes());
        }
        if(Yii::$app->request->isAjax){
            $model->name = $name;
            $model->save();
            Yii::$app->session->addFlash('success', "Category  Update!");
        }
        return json_encode(Yii::$app->session->getAllFlashes());

    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param $parent_id
     * @return mixed
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws \Exception
     */
    public function actionDelete($id,$parent_id)
    {if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
        throw new ForbiddenHttpException('Доступ запрещен');
    }

        $model=$this->findModel($parent_id);
        $child=$this->findModel($id)->getChild()->all();
        if ($child){
            foreach ($child as $item){
                if ($chi = $item->getChild()->all()){
                    foreach ($chi as $c){
                        if ($h = $c->getChild()->all()){
                            foreach ($h as $z){

                                   $z->delete();

                            }
                        }
                        else{
                            $c->delete();
                        }
                    }
                }
                else{
                    $item->delete();
                }
            }
        }
        $this->findModel($id)->delete();
        Yii::$app->session->addFlash('success', 'Category Delete!');
        return $this->redirect(['view','id'=>$model->id]);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
