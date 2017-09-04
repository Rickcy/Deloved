<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $profile common\models\Profile */
$profile =$user->getProfile()->one();
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['main/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Здравствуйте <?= Html::encode($profile->fio) ?>,</p>

    <p>Вы или кто-то другой запросил смену пароля</p>
    <p>Email: <?=$user->email?> </p>
    <p>Прослейдуйте по этой ссылке для смены пароля::</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink,[]) ?></p><br>
    Не отвечайте на это письмо, т.к. оно сгенерировано автоматически.
</div>
