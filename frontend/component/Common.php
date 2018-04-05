<?php

namespace frontend\component;

use common\models\NewAccount;
use common\models\NewClaim;
use common\models\NewClaimPost;
use common\models\NewConsult;
use common\models\NewConsultPost;
use common\models\NewDeal;
use common\models\NewDealPost;
use common\models\NewDispute;
use common\models\NewDisputePost;
use common\models\NewGood;
use common\models\NewReview;
use common\models\NewService;
use common\models\NewSuggestion;
use common\models\NewTask;
use common\models\NewTicket;
use common\models\NewTicketPost;
use Yii;
use yii\base\Component;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;

class Common extends Component {

    const EVENT_NOTIFY = 'notify_admin';

    public function sendMail($subject,$text,$emailFrom='deloved.info@gmail.com',$nameFrom='Deloved'){
        Yii::$app->mail->compose()
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailFrom => $nameFrom])
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
        $new_tickets_posts = NewTicketPost::findAll(['for_profile_id'=>$profile_id]);
        $new_consults = NewConsult::findAll(['for_profile_id'=>$profile_id]);
        $new_consults_posts = NewConsultPost::findAll(['for_profile_id'=>$profile_id]);
        $new_deals = NewDeal::findAll(['for_profile_id'=>$profile_id]);
        $new_deals_posts = NewDealPost::findAll(['for_profile_id'=>$profile_id]);
        $new_reviews = NewReview::findAll(['for_profile_id'=>$profile_id]);
        $new_disputes = NewDispute::findAll(['for_profile_id'=>$profile_id]);
        $new_disputes_posts = NewDisputePost::findAll(['for_profile_id'=>$profile_id]);
        $new_claims = NewClaim::findAll(['for_profile_id'=>$profile_id]);
        $new_claims_posts = NewClaimPost::findAll(['for_profile_id'=>$profile_id]);
        $new_task = NewTask::findAll(['for_profile_id'=>$profile_id]);

        if($new_task){
            $lenta['tasks'] = $new_task;
        }
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
        if($new_tickets_posts){
            $lenta['tickets_posts'] = $new_tickets_posts;
        }
        if($new_consults){
            $lenta['consults'] = $new_consults;
        }
        if($new_consults_posts){
            $lenta['consults_posts'] = $new_consults_posts;
        }
        if($new_deals){
            $lenta['deals'] = $new_deals;
        }
        if($new_deals_posts){
            $lenta['deals_posts'] = $new_deals_posts;
        }
        if($new_disputes){
            $lenta['disputes'] = $new_disputes;
        }
        if($new_disputes_posts){
            $lenta['disputes_posts'] = $new_disputes_posts;
        }
        if($new_claims){
            $lenta['claims'] = $new_claims;
        }
        if($new_claims_posts){
            $lenta['claims_posts'] = $new_claims_posts;
        }
        if($new_reviews){
            $lenta['reviews'] = $new_reviews;
        }
        return $lenta;

    }

    public function sendMailResetPassword($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Password reset for Deloved.ru')
            ->send();

    }


    public function sendMailCreateDeal($emailTo,$user,$name){
        Yii::$app->mail->compose(
            ['html' => 'emailCreateDeal-html', 'text' => 'emailCreateDeal-text'],
            ['user' => $user]

        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Приглашение для заключения безопасной сделки')
            ->send();
    }

    public function sendMailEmailConfirm($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailConfirmToken-html', 'text' => 'emailConfirmToken-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Email Confirm for Deloved.ru')
            ->send();

    }


    public function sendMailNewDeal($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailNewDeal-html', 'text' => 'emailNewDeal-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Новая сделка на Deloved.ru')
            ->send();

    }

    public function sendMailNewClaim($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailNewClaim-html', 'text' => 'emailNewClaim-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Новый иск на Deloved.ru')
            ->send();

    }

    public function sendMailNewMessageDeal($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailNewDealMessage-html', 'text' => 'emailNewDealMessage-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Новое сообщение в сделке на Deloved.ru')
            ->send();

    }

    public function sendMailNewMessageClaim($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailNewClaimMessage-html', 'text' => 'emailNewClaimMessage-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Новое сообщение в иске на Deloved.ru')
            ->send();

    }


    public function sendMailNewMessageTicket($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailNewTicketMessage-html', 'text' => 'emailNewTicketMessage-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Новое сообщение в обращении в тех поддержку на Deloved.ru')
            ->send();

    }



    public function sendMailNewMessageDispute($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailNewDisputeMessage-html', 'text' => 'emailNewDisputeMessage-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Новое сообщение в споре на Deloved.ru')
            ->send();

    }

    public function sendMailNewMessageConsult($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailNewConsultMessage-html', 'text' => 'emailNewConsultMessage-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Новое сообщение в консультации на Deloved.ru')
            ->send();

    }


    public function sendMailNewStatusDispute($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailNewDisputeStatus-html', 'text' => 'emailNewDisputeStatus-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Новый статус в споре на Deloved.ru')
            ->send();

    }


    public function sendMailNewStatusDeal($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailNewDealStatus-html', 'text' => 'emailNewDealStatus-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Новый статус в сделке на Deloved.ru')
            ->send();

    }


    public function sendMailNewStatusConsult($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailNewConsultStatus-html', 'text' => 'emailNewConsultStatus-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Новый статус в консультации на Deloved.ru')
            ->send();

    }
    public function sendMailNewStatusClaim($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailNewClaimStatus-html', 'text' => 'emailNewClaimStatus-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Новый статус в иске на Deloved.ru')
            ->send();

    }

    public function sendMailNewStatusTicket($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailNewTicketStatus-html', 'text' => 'emailNewTicketStatus-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Новый статус в обращении в тех поддержку на Deloved.ru')
            ->send();

    }

    public function sendMailTempalte($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailTemplate-html', 'text' => 'emailTemplate-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Email for Deloved.ru')
            ->send();

    }


    public function sendMailPeriod($emailTo,$user){
        Yii::$app->mail->compose(
            ['html' => 'emailPeriod-html', 'text' => 'emailPeriod-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Закончилась подписка на Deloved.ru')
            ->send();

    }

    public function notifyAdmin($event){
        print "Notify Admin";
    }

    public function sendQuestionsTemplate($emailTo,$user)
    {
        Yii::$app->mail->compose(
            ['html' => 'questionTemplate-html', 'text' => 'questionTemplate-text'],
            ['user' => $user]
        )
            ->setFrom(['admin@deloved.ru'=>'Deloved'])
            ->setTo([$emailTo])
            ->setSubject('Email for Deloved.ru')
            ->send();

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