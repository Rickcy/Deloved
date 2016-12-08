<?php

namespace frontend\component;

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