<?php
/**
 * Created by PhpStorm.
 * User: User11
 * Date: 11.01.2017
 * Time: 11:18
 */

namespace frontend\widgets;


use common\models\SuggestionCat;
use frontend\models\SuggestionForm;
use Yii;
use yii\bootstrap\Widget;

class Suggestion extends Widget
{
    public function run()
    {
        $suggestion_cat = SuggestionCat::find()->all();
        $model = new SuggestionForm();
            if ($model->load(Yii::$app->request->post()) && $model->createSug()){

                Yii::$app->session->addFlash('success', 'Спасибо за ваше обращения');
                Yii::$app->controller->refresh();
            }
        return $this->render('suggestion',['model'=>$model,'suggestion_cat'=>$suggestion_cat]);
    }


}