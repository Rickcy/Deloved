<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 01.09.17
 * Time: 7:19
 */

namespace app\modules\admin\controllers;


use common\controllers\AuthController;
use common\models\Keeper;
use common\models\Logs;
use common\models\PaymentMethod;
use common\models\PaymentRequest;
use common\models\Tariffs;
use common\models\User;
use frontend\models\BillingForm;
use Yii;
use yii\httpclient\Client;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class BillingController extends AuthController
{

    public $layout = '/admin';
    public $enableCsrfValidation = false;

    public function beforeAction($action)
    {
        if (in_array($action->id, ['incoming'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [],
                'actions' => [
                    'invoice-confirmation' => [
                        'Origin' => ['*'],
                        'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                        'Access-Control-Request-Headers' => ['*'],
                        'Access-Control-Allow-Credentials' => null,
                        'Access-Control-Max-Age' => 86400,
                        'Access-Control-Expose-Headers' => [],
                    ],
                    'payment-notification' => [
                        'Origin' => ['*'],
                        'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                        'Access-Control-Request-Headers' => ['*'],
                        'Access-Control-Allow-Credentials' => null,
                        'Access-Control-Max-Age' => 86400,
                        'Access-Control-Expose-Headers' => [],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex(){

        if (!User::checkRole(['ROLE_USER']) ||  (User::findOne(Yii::$app->user->id))->profile->isManager()) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $account = User::findOne(Yii::$app->user->id)->profile->account;
        $hasKeeper = Keeper::hasKeeper($account);
        $requests = PaymentRequest::findAll(['account_id'=>$account->id]);
        $tariffs = Tariffs::findAll(['currency_id'=>1]);

        $isFist = PaymentRequest::find()->where(['account_id'=>$account->id])->andFilterWhere(['!=','status',PaymentRequest::STATUS_INITIATED])->one();
        if($isFist){
            $methods = PaymentMethod::findAll(['enabled'=>true,'income'=>true]);
        }
        else{
            $methods = PaymentMethod::findAll(['system_id'=>BillingForm::INCOME]);
        }

//        $methods = PaymentMethod::findAll(['enabled'=>true,'income'=>true]);
        $form = new BillingForm();

        return $this->render('index',[
            'methods'=>$methods,
            'tariffs'=>$tariffs,
            'requests'=>$requests,
            'account'=>$account,
            'model'=>$form
        ]);
    }

    public function actionIncome(){

        if (!User::checkRole(['ROLE_USER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $user = User::findOne(Yii::$app->user->id);
        $keeper = Keeper::hasKeeper($user->profile->account);
        $form = new BillingForm();
        $form->keeper = $keeper->id;
        $form->account = $keeper->account_id;
        if($form->load(Yii::$app->request->post()) && $form->validate()){
            $paymentReq = $form->getIncome();
            if($form->method == BillingForm::INCOME ){
                return $this->redirect('/admin/billing/bill?id='.$paymentReq->id);
            }
            else{
                return $this->redirect('/admin/billing/post-redirect?id='.$paymentReq->id);
            }
        }

        return $this->refresh();

    }

    public function actionBill($id){
        $this->layout = null;
        if (!User::checkRole(['ROLE_USER'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $paymentRequest = PaymentRequest::findOne((int)$id);
        if (!$paymentRequest){
            return $this->redirect('/admin/billing/index');
        }
        return $this->render('bill',['paymentRequest'=>$paymentRequest]);

    }

    public function actionInvoiceConfirmation(){


        /* 1. Проверяем на метод запроса. Только POST. */
        if (!Yii::$app->request->isPost) {

            $logs = new Logs();
            $logs->logs = 'Bad request method!';
            $logs->save();

            http_response_code(404);
            return;
        }

        /* 2. Проверяем на флаг предварительного запроса. */
        $post = Yii::$app->request->post();
        if($post['LMI_PREREQUEST'] !=1){
            $logs = new Logs();
            $logs->logs = 'Not prerequest!';
            $logs->save();
            http_response_code(404);
            return;
        }
        /* 3. Проверяем соответсвие данные */
        if (!PaymentRequest::checkParams($post)) {
            $logs = new Logs();
            $logs->logs = 'Bad params!';
            $logs->save();
            http_response_code(404);
            return;
        }

        /* 4. Проверям не находится ли нужный запрос уже в обработке */
        if ((PaymentRequest::findOne($post['LMI_PAYMENT_NO']))->status != PaymentRequest::STATUS_INITIATED) {
            $logs = new Logs();
            $logs->logs = 'Request already exist';
            $logs->save();
            http_response_code(404);
            return;
        }
        /* 5. Если дошли до этого момента, то все отлично. Отвечаем "ДА" серверу ПС. */
        $logs = new Logs();
        $logs->logs = 'Success prerequest. All right!';
        $logs->save();

        return 'YES';

    }


        public function actionPaymentNotification() {

        /* 1. Проверям метод запроса */
            if (!Yii::$app->request->isPost) {
                $logs = new Logs();
                $logs->logs = 'Not prerequest!';
                $logs->save();
                http_response_code(404);
                return;
            }
            $post = Yii::$app->request->post();
        /* 2. Проверям секретный ключ */
            if (!PaymentRequest::checkSecretSign($post)) {
                $logs = new Logs();
                $logs->logs = 'Wrong secret sign!';
                $logs->save();
                http_response_code(404);
                return;
            }

       /* 3. Проверяем соответсвие данные */
            if (!PaymentRequest::checkParams($post)) {
                $logs = new Logs();
                $logs->logs = 'Bad params!';
                $logs->save();
                http_response_code(404);
                return;
            }


        $paymentRequest = PaymentRequest::findOne($post['LMI_PAYMENT_NO']);


        if ($paymentRequest->status == PaymentRequest::STATUS_INITIATED) {
            $paymentRequest->status = PaymentRequest::STATUS_COMPLETE;
            $paymentRequest->save();
            http_response_code(200);
            return;
        }
        else {
            $logs = new Logs();
            $logs->logs = 'Success prerequest. All right!';
            $logs->save();
           http_response_code(200);
           return;
        }

    }



    public function actionAll(){
        if (!User::checkRole(['ROLE_ADMIN'])) {
            throw new ForbiddenHttpException('Доступ запрещен');
        }
        $requests = PaymentRequest::find()->all();
        return $this->render('all',['requests'=>$requests]);
    }


    public function actionPostRedirect($id){
        $user = User::findOne(Yii::$app->user->id);
        $keeper = Keeper::hasKeeper($user->profile->account);
        $paymentRequest = PaymentRequest::findOne((int)$id);
        if(!$paymentRequest){
            return $this->redirect('/admin/billing/index');
        }

        return $this->render('post-redirect',[
            'url'=>'https://paymaster.ru/Payment/Init',
            'merchant_id'=> 'a2498ef4-9f7c-4bc0-ad34-edacc30ffc6b',
            'paymentRequest'=> $paymentRequest,
        ]);
    }


    public function actionCheckRequestStatus($requestId){
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!$requestId) return false;
        $httpClient = new Client();

        $url = BillingForm::SITE.BillingForm::PATH;
        $nonce = uniqid();
        $hash = base64_encode(sha1(BillingForm::LOGIN . ';' . BillingForm::PASS . ';' . $nonce . ';' . $requestId . ';' . BillingForm::MERCHANT_ID,true));
        $data = $httpClient->createRequest()
            ->setMethod('post')
            ->setUrl($url)
            ->setData([
                'login'=>BillingForm::LOGIN,
                'nonce'=>$nonce,
                'invoiceid'=>$requestId,
                'siteAlias'=>BillingForm::MERCHANT_ID,
                'hash'=>$hash,
                ])
            ->send();

        if ($data->isOk){
            $payment = PaymentRequest::findOne((int)$requestId);
            $payment->status = PaymentRequest::getStatusByString($data->data['Payment']['State']);
            if($payment->status == PaymentRequest::STATUS_COMPLETE){
                $payment->account->profile->chargeStatus = 1;
            }
            $payment->save();
            return  $this->renderPartial('partials/details',['data'=>$data->data]);
        }
    }

}