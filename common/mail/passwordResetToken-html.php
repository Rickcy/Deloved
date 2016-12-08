<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $profile common\models\Profile */
$profile =$user->getProfiles()->one();
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['front/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Здравствуйте <?= Html::encode($profile->fio) ?>,</p>

    <p>Пройдите по ссылке и введите новый пароль:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink,[]) ?></p>
</div>
