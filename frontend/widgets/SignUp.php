<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 14.08.17
 * Time: 12:35
 */

namespace frontend\widgets;


use common\models\Category;
use common\models\CategoryType;
use common\models\OrgForm;
use common\models\Region;
use frontend\models\SignupForm;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Widget;

class SignUp extends Widget
{
    public function run()
    {

        $categoryType = CategoryType::find()->all();
        $category = Category::find()->all();

        $level_id = 18;

        $org_forms = OrgForm::find()->all();

        $city_list= Region::find()
            ->select(['name as  label','name as value','name as name'])
            ->where('level_id=:level_id',[':level_id'=>$level_id])
            ->asArray()
            ->all();

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signUp()) {
                if (Yii::$app->getUser()->login($user)) {
                    Yii::$app->controller->redirect('/admin');
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,'city_list'=>$city_list,'org_forms'=>$org_forms,'categoryType'=>$categoryType,'category'=>$category
        ]);
    }


}