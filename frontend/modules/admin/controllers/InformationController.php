<?php


namespace app\modules\admin\controllers;


use common\controllers\AuthController;
use common\models\Account;
use common\models\CheckAccounts;
use common\models\User;
use Yii;
use yii\httpclient\Client;
use yii\web\Response;

class InformationController extends AuthController
{
    public $layout = '/admin';




    public function actionIndex($id = null){
        $profile = (User::findOne(Yii::$app->user->id))->profile;
        if($id){
            $account = Account::findOne((int)$id);
            $dataAffs = null;
            $fin = null;
            if($account){
                if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {

                    $checking = CheckAccounts::findOne(['inn'=>$account->inn,'profile_id'=>$profile->id]);

                    if(!$checking){
                        $checkAccounts = new CheckAccounts();
                        $checkAccounts->profile_id = $profile->id;
                        $checkAccounts->name = $account->full_name;
                        $checkAccounts->acc_id = $account->id;
                        $checkAccounts->inn = $account->inn;
                        $checkAccounts->date_check = date('Y-m-d H:i:s');
                        $checkAccounts->ogrn = $account->ogrn;
                        $checkAccounts->is_exist = true;
                        $checkAccounts->save();
                    }
                }
                $httpClient = new Client();
                $data = $httpClient->createRequest()
                    ->setMethod('post')
                    ->setUrl('https://zachestnyibiznesapi.ru/paid/data/search')
                    ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','string'=>$account->inn])
                    ->send();

                if ($data->isOk){
                    if ($account->orgForm->code == 'ИП'){
                        foreach ($data->data['body']['docs'] as $datum){
                            if($datum['ТипДокумента'] == 'ip'){
                                $n = $datum['id'];
                                $ip = true;
                            }
                        }

                    }
                    else{
                        $ip = false;
                        $n = $data->data['body']['docs'][0]['id'];

                    }



                    $response = $httpClient->createRequest()
                        ->setMethod('post')
                        ->setUrl('https://zachestnyibiznesapi.ru/paid/data/card')
                        ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','id'=>$n])
                        ->send();

                    if(!$ip){
                        if(!$response->data['body']['Руководители'][0]['inn']){
                            $dataAffs = [];
                        }
                        else{
                            $httpClients = new Client();
                            $dataAffs = $httpClients->createRequest()
                                ->setMethod('post')
                                ->setUrl('https://zachestnyibiznesapi.ru/paid/data/search')
                                ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','string'=>$response->data['body']['Руководители'][0]['inn']])
                                ->send();

//                            $dataAffs = $dataAffs->data['body']['docs'];
                        }

                    }
                    $httpClients = new Client();
                    $fin = $httpClients->createRequest()
                        ->setMethod('post')
                        ->setUrl('https://zachestnyibiznesapi.ru/v2/data/fs')
                        ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','id'=>$n])
                        ->send();

                    $httpClients = new Client();
                    $sud = $httpClients->createRequest()
                        ->setMethod('post')
                        ->setUrl('https://zachestnyibiznesapi.ru/paid/data/court-arbitration')
                        ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','id'=>$n])
                        ->send();


                    return $this->render('index',['data'=>$response->data['body'],'ip'=>$ip,'dataAffs'=>$dataAffs,'fin'=>$fin->data,'sud'=>$sud->data['body'],'acc' => $account]);
                }
            }
        }
        else{
            $check = CheckAccounts::find()->where(['profile_id'=>$profile->id])->all();
            return $this->render('index',['data'=>null,'check'=>$check]);
        }


    }

    public function actionGetInfo(){

        $innOrOgrn = (int)Yii::$app->request->post('innOrOgrn');
       $isAccount =  Account::findOne(['inn'=>$innOrOgrn]);

       if($isAccount){
           return $this->redirect('/companies/item/?id='.$isAccount->id);
       }
        Yii::$app->response->format = Response::FORMAT_JSON;
        $dataAffs = null;
        $fin = null;
        strlen($innOrOgrn) > 10 ? $ip = true : $ip =false;
        if (is_int($innOrOgrn)){



            $httpClient = new Client();
            $data = $httpClient->createRequest()
                ->setMethod('post')
                ->setUrl('https://zachestnyibiznesapi.ru/paid/data/search')
                ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','string'=>$innOrOgrn])
                ->send();
            if ($data->isOk){

                if ($ip == true){
                    foreach ($data->data['body']['docs'] as $datum){
                        if($datum['ТипДокумента'] == 'ip'){
                            $n = $datum['id'];
                        }
                    }

                }
                else{

                    $n = $data->data['body']['docs'][0]['id'];
                }
                $response = $httpClient->createRequest()
                    ->setMethod('post')
                    ->setUrl('https://zachestnyibiznesapi.ru/paid/data/card')
                    ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','id'=>$n])
                    ->send();
                if(!$ip){
                    $httpClients = new Client();
                    $dataAffs = $httpClients->createRequest()
                        ->setMethod('post')
                        ->setUrl('https://zachestnyibiznesapi.ru/paid/data/search')
                        ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','string'=>$response->data['body']['Руководители'][0]['inn']])
                        ->send();

//                    $dataAffs = $dataAffs->data['body']['docs'];
                }
                $httpClients = new Client();
                $fin = $httpClients->createRequest()
                    ->setMethod('post')
                    ->setUrl('https://zachestnyibiznesapi.ru/v2/data/fs')
                    ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','id'=>$n])
                    ->send();

                $httpClients = new Client();
                $sud = $httpClients->createRequest()
                    ->setMethod('post')
                    ->setUrl('https://zachestnyibiznesapi.ru/paid/data/court-arbitration')
                    ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','id'=>$n])
                    ->send();


                if (!User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])) {
                    $profile = (User::findOne(Yii::$app->user->id))->profile;
                    $checking = CheckAccounts::findOne(['inn'=>$innOrOgrn,'profile_id'=>$profile->id]);
                    if(!$checking) {
                        $checkAccounts = new CheckAccounts();
                        $checkAccounts->profile_id = $profile->id;
                        $checkAccounts->date_check = date('Y-m-d H:i:s');
                        if ($ip) {
                            $checkAccounts->name = 'ИП ' . $response->data['body']['ФИО'];
                            $checkAccounts->inn = $response->data['body']['ИННФЛ'];
                            $checkAccounts->ogrn = $response->data['body']['ОГРНИП'];
                        } else {
                            $checkAccounts->name = $response->data['body']['НаимЮЛПолн'];
                            $checkAccounts->inn = $response->data['body']['ИНН'];
                            $checkAccounts->ogrn = $response->data['body']['ОГРН'];
                        }

                        $checkAccounts->is_exist = false;
                        $checkAccounts->save();
                    }
                }

                return $this->renderPartial('partials/template',[
                    'data'=>$response->data['body'],
                    'ip'=>$ip,'dataAffs'=>$dataAffs,
                    'fin'=>$fin->data,
                    'sud'=>$sud->data['body']]);
            }
        }

    }


    public function actionGetAff(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $inn = Yii::$app->request->post('inn');
        if((integer) $inn){
            $q = '';
        }
        else{
            $q = 'aff_';
            $inn = mb_strtoupper($inn);
        }

        $httpClient = new Client();
        $data = $httpClient->createRequest()
            ->setMethod('post')
            ->setUrl('https://zachestnyibiznesapi.ru/paid/data/search')
            ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','string'=>$q.$inn])
            ->send();
        if ($data->isOk){

            return $this->renderPartial('partials/template-modal-aff',['data'=>$data->data['body']]);
        }
    }







    public function actionGetSudDeal($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $httpClient = new Client();
        $data = $httpClient->createRequest()
            ->setMethod('post')
            ->setUrl('https://zachestnyibiznesapi.ru/v2/data/court-arbitration-card')
            ->setData(['api_key'=>'Az03qrVxXMLfnJba8LZTGufSTO00_zAp','id'=>$id])
            ->send();
        if ($data->isOk){
            return $this->renderPartial('partials/template-modal',['data'=>$data->data]);
        }
    }

}