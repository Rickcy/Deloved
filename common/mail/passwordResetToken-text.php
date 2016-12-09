<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $profile common\models\Profile */
$profile =$user->getProfiles()->one();
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['front/reset-password', 'token' => $user->password_reset_token]);
?>
Зджравствуйте  <?= $profile->fio ?>,

Пройдите по ссылке и введите новый пароль:

<?= $resetLink ?>
