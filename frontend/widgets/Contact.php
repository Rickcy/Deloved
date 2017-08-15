<?php
/**
 * Created by PhpStorm.
 * User: User11
 * Date: 08.12.2016
 * Time: 14:55
 */

namespace frontend\widgets;


use common\models\SuggestionCat;
use frontend\models\ContactForm;
use Yii;
use yii\bootstrap\Widget;
use yii\helpers\Url;

class Contact extends Widget
{
    public function run()
    {
     $model = new ContactForm();
        $suggestion_cat = SuggestionCat::find()->where(['type'=>2])->all();
        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            $body ='<div>'.$model->body.'</div>';
            $body .='<p><div>Имя отправителя : '.$model->name.'</div><br>';
            $body .='<div>E-mail : '.$model->email.'</div><br></p>';
            Yii::$app->common->sendMail($model->subject,$body);
            Yii::$app->session->addFlash('success', 'Спасибо за ваше письмо. Мы свяжемся с вами в ближайшее время.');
            Yii::$app->controller->refresh();
        }
        return $this->render('contact',['model'=>$model,'suggestion_cat'=>$suggestion_cat]);
    }


}