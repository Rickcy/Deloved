<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 06.02.18
 * Time: 19:22
 */

namespace frontend\widgets;


use frontend\models\QuestionsForm;
use Yii;
use yii\bootstrap\Widget;

class Questions extends Widget
{
    public function run()
    {

        $model = new QuestionsForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            Yii::$app->session->addFlash('success', 'Спасибо за честный ответ');
        }

      return $this->render('questions', ['model' => $model]);
    }

}