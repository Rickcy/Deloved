<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $profile common\models\Profile */
$profile =$user->getProfile()->one();
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['main/email-confirm', 'token' => $user->email_confirm_token]);
?>
Здравствуйте, <?= $profile->fio ?>!<br>
Вы зарегистрировались на межотраслевом бизнес-портале "Деловед".<br/>

Чтобы активировать свой профиль, пройдите по ссылке:

<?= $resetLink ?>
