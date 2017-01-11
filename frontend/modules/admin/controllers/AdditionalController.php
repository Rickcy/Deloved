<?php

namespace app\modules\admin\controllers;

use common\controllers\AuthController;
use common\models\Condition;
use common\models\DeliveryMethods;
use common\models\PaymentMethods;
use Yii;

class AdditionalController extends AuthController
{
    public $layout = '/admin';

    public function actionCreateCondition()
    {
        $conditions = new Condition();
        if ($conditions->load(Yii::$app->request->post())){
            $conditions->save();
            Yii::$app->session->addFlash('success', "Condition Created");
            return $this->redirect(['index']);
        }

        return $this->render('create-condition',[
            'conditions'=>$conditions
        ]);
    }

    public function actionCreateDeliveryMethods()
    {
        $deliveryMethods = new DeliveryMethods();

        if ($deliveryMethods->load(Yii::$app->request->post())){
            $deliveryMethods->save();
            Yii::$app->session->addFlash('success', "Delivery methods Created");
            return $this->redirect(['index']);
        }


        return $this->render('create-delivery-methods',[
            'deliveryMethods'=>$deliveryMethods
        ]);
    }


    public function actionCreatePayMethods()
    {
        $payMethods = new PaymentMethods();

        if ($payMethods->load(Yii::$app->request->post())){
            $payMethods->save();
            Yii::$app->session->addFlash('success', "Payment methods Created");
            return $this->redirect(['index']);
        }

        return $this->render('create-pay-methods',[
            'payMethods'=>$payMethods
        ]);
    }

    public function actionIndex()
    {
        $conditions = Condition::find()->all();
        $deliveryMethods = DeliveryMethods::find()->all();
        $payMethods = PaymentMethods::find()->all();


        return $this->render('index',[
            'conditions'=>$conditions,
            'deliveryMethods'=>$deliveryMethods,
            'payMethods'=>$payMethods
        ]);
    }

    public function actionDeletePayMethod($id){

        PaymentMethods::findOne($id)->delete();

        Yii::$app->session->addFlash('success', "Payment methods was Deleted");
        return $this->redirect(['index']);
    }


    public function actionDeleteDeliveryMethod($id){

        DeliveryMethods::findOne($id)->delete();

        Yii::$app->session->addFlash('success', "Delivery methods was Deleted");
        return $this->redirect(['index']);
    }

    public function actionDeleteCondition($id){

        Condition::findOne($id)->delete();

        Yii::$app->session->addFlash('success', "Condition was Deleted");
        return $this->redirect(['index']);
    }

}
