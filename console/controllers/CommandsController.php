<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 22.01.18
 * Time: 16:21
 */

namespace console\controllers;



use common\models\Profile;
use common\models\User;
use DateInterval;
use DateTime;
use Yii;
use yii\console\Controller;


class CommandsController extends Controller
{
    public function actionCheckUser()
    {
        $count = 0;
        while (true) {
            $exp = (new DateTime())->sub(new DateInterval('PT1H'))->format('Y-m-d H:i');
            $users = User::find()->where(['online'=>User::ONLINE])->all();
            foreach ($users as $user){
                if($exp > date('Y-m-d H:i',$user->profile->updated_at)){
                    $user->online = User::OFFLINE;
                    $user->save();
                }

            }
            $count++;
            sleep(5);
            if ($count >= 100) {
                \Yii::$app->db->close();
                return self::EXIT_CODE_NORMAL;
            }
        }
    }



    public function actionCheckPeriod(){

        $count = 0;
        while (true) {
            $now = date('Y-m-d');
            $profiles = Profile::find()->where(['chargeStatus'=>1])->all();
            /**
             * @var $profile \common\models\Profile
             */
            foreach ($profiles as $profile){
               if(date('Y-m-d',$profile->chargeTill) == $now){
                   Yii::$app->common->sendMailPeriod($profile->user->email, $profile->user);
                   $profile->chargeStatus = 0;
                   $profile->chargeTill = null;
                   $profile->save();
               }
            }
            $count++;
            sleep(60);
            if ($count >= 100) {
                \Yii::$app->db->close();
                return self::EXIT_CODE_NORMAL;
            }
        }

    }
}