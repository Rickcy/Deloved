<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\NewSuggestion;
use common\models\Profile;
use common\models\Role;
use common\models\Suggestion;
use common\models\SuggestionCat;
use common\models\User;
use Yii;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class SuggestionController extends AuthController
{

    public $layout = '/admin';

    public function actionCreateCategory($cat_name,$cat_type)
    {
        if (!User::checkRole(['ROLE_ADMIN'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        if (empty($cat_name)||empty($cat_type)){
            Yii::$app->session->addFlash('danger', Yii::t('app','NO'));
        }else{
            $model = new SuggestionCat();
            $model->name=$cat_name;
            $model->type=$cat_type;
            $model->save();
            $id_model = $model->id;
            Yii::$app->session->addFlash('success', 'Категория создана');
        }
        $mes = [Yii::$app->session->getAllFlashes(),'id_model'=>$id_model];
        return Json::encode($mes);
    }

    public function actionIndex()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_SUPPORT'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }

        $suggestion_cat = SuggestionCat::find()->all();

        return $this->render('index',['suggestion_cat'=>$suggestion_cat]);
    }

    public function actionShow()
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_SUPPORT','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $profile = User::findOne(Yii::$app->user->id)->profile;
        if (User::checkRole(['ROLE_ADMIN','ROLE_SUPPORT','ROLE_MANAGER'])) {
            Yii::$app->db
                ->createCommand('DELETE FROM new_suggestion 
                    WHERE for_profile_id =:profile_id', [':profile_id' => $profile->id])
                ->execute();
        }
        $suggestions = Suggestion::find()->orderBy(['date_published'=>SORT_DESC])->all();


        return $this->render('show',['suggestions'=>$suggestions]);
    }

    public function actionUpdate($id)
    {
        if (!User::checkRole(['ROLE_ADMIN','ROLE_SUPPORT','ROLE_MANAGER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }


        $model = SuggestionCat::findOne($id);

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

    }


    public function actionEditCategory($id,$name,$type){
        if (empty($name)||empty($type)){
            Yii::$app->session->addFlash('danger', 'Пустое');
        }else{
            $model = SuggestionCat::findOne($id);
            $model->name = $name;
            $model->type = $type;
            $model->save();
            Yii::$app->session->addFlash('success', 'Категория обновлена');
        }

        return json_encode(Yii::$app->session->getAllFlashes());
    }




    public function actionSugDelete($id){
        Suggestion::findOne($id)->delete();

        Yii::$app->session->addFlash('success', 'Обращение удалено');
        return $this->redirect(['show']);

    }

    public function actionDelete($id){
        SuggestionCat::findOne($id)->delete();

        Yii::$app->session->addFlash('success', 'Категория удалена');
        return $this->redirect(['index']);

    }


    protected function findModel($id){
        if (($model = Suggestion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
