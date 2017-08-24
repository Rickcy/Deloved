<?php

namespace frontend\component;

use common\models\NewAccount;
use common\models\NewGood;
use common\models\NewService;
use common\models\NewSuggestion;
use common\models\NewTicket;
use Yii;
use yii\base\Component;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

class Common extends Component {

    const EVENT_NOTIFY = 'notify_admin';

    public function sendMail($subject,$text,$emailFrom='kuden.and.ko@gmail.com',$nameFrom='Deloved'){
        Yii::$app->mail->compose()
            ->setFrom(['Rickcy@yandex.ru'=>'Deloved'])
            ->setTo([$emailFrom=> $nameFrom])
            ->setSubject($subject)
            ->setTextBody($text)
            
            ->send();
        //$this->trigger(self::EVENT_NOTIFY);
    }

    public function getLenta($profile_id){
        $lenta =[];
        $new_accounts = NewAccount::findAll(['for_profile_id'=>$profile_id]);
        $new_goods = NewGood::findAll(['for_profile_id'=>$profile_id]);
        $new_services = NewService::findAll(['for_profile_id'=>$profile_id]);
        $new_suggestions = NewSuggestion::findAll(['for_profile_id'=>$profile_id]);
        $new_tickets = NewTicket::findAll(['for_profile_id'=>$profile_id]);
        if($new_accounts){
            $lenta['accounts'] = $new_accounts;
        }
        if($new_goods){
            $lenta['goods'] = $new_goods;
        }
        if($new_services){
            $lenta['services'] = $new_services;
        }
        if($new_suggestions){
            $lenta['suggestions'] = $new_suggestions;
        }
        if($new_tickets){
            $lenta['tickets'] = $new_tickets;
        }
        return $lenta;

    }

    public function sendMailResetPassword($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
            ['user' => $user]
        )
            ->setFrom(['Rickcy@yandex.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Password reset for Deloved.ru')
            ->send();

    }

    public function sendMailEmailConfirm($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailConfirmToken-html', 'text' => 'emailConfirmToken-text'],
            ['user' => $user]
        )
            ->setFrom(['Rickcy@yandex.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Email Confirm for Deloved.ru')
            ->send();

    }

    public function notifyAdmin($event){
        print "Notify Admin";
    }

//    public static function getTitleAdvert($data){
//
//        return $data['bedroom'].' Bed Rooms and '.$data['kitchen'].' Kitchen Room Aparment on Sale';
//    }
//
//    public static function getImageAdvert($data,$general = true,$original = false){
//
//        $image = [];
//        $base = '/';
//        if($general){
//
//            $image[] = $base.'uploads/adverts/'.$data['id'].'/general/small_'.$data['general_image'];
//        }
//        else{
//            $path = \Yii::getAlias("@frontend/web/uploads/adverts/".$data['id']);
//            $files = BaseFileHelper::findFiles($path);
//
//            foreach($files as $file){
//                if (strstr($file, "small_") && !strstr($file, "general")) {
//                    $image[] = $base . 'uploads/adverts/' . $data['id'] . '/' . basename($file);
//                }
//            }
//        }
//
//        return $image;
//    }
//
//    public static function substr($text,$start=0,$end=50){
//
//        return mb_substr($text,$start,$end);
//    }
//
//
//    public static function getType($row){
//        return ($row['sold']) ? 'Sold' : 'New';
//    }
//
//    public function getUrlAdvert($row){
//
//        return Url::to(['/front/front/view-advert', 'id' => $row['id']]);
//    }
}