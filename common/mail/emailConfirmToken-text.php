<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $profile common\models\Profile */
$profile =$user->getProfiles()->one();
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['front/email-confirm', 'token' => $user->email_confirm_token]);
?>
Зджравствуйте  <?= $profile->fio ?>,

Для подтверждения пройдите по ссылке:

<?= $resetLink ?>
