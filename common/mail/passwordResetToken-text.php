<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $profile common\models\Profile */
$profile =$user->getProfiles()->one();
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['front/reset-password', 'token' => $user->password_reset_token]);
?>
Здравствуйте  <?= $profile->fio ?>,<br/>
<br/>
Вы или кто-то другой запросил смену пароля<br/>
Email:  <?= $user->email ?><br/>


Прослейдуйте по этой ссылке для смены пароля:

<?= $resetLink ?><br>
<br>
Не отвечайте на это письмо, т.к. оно сгенерировано автоматически.
