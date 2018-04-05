<?php

namespace frontend\widgets;


use common\models\User;
use frontend\models\PasswordResetRequestForm;
use Yii;
use yii\bootstrap\Widget;

class PasswordReset extends Widget
{



    public function run()
    {
     $model = new PasswordResetRequestForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $user = User::findOne([
                'status' => User::STATUS_ACTIVE,
                'email' => $model->email,
            ]);

            if (!$user) {
                return false;
            }

            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
                if (!$user->save()) {
                    return false;
                }
            }
            Yii::$app->common->sendMailResetPassword($model->email,$user);
            Yii::$app->session->addFlash('success', 'Вам на почту отрпавленно письмо с дальнейшими инструкциями!');
            Yii::$app->controller->redirect('/');

        }
        return $this->render('resetPassword',['model'=>$model]);
    }


}