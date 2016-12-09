<?php
use yii\helpers\Html;
/**
 * @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $profile common\models\Profile */

$profile =$user->getProfiles()->one();
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['front/email-confirm', 'token' => $user->email_confirm_token]);
?>
<div class="password-reset">
    <p>Здравствуйте <?= Html::encode($profile->fio) ?>,</p>

    <p>Для подтверждения пройдите по ссылке:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink,[]) ?></p>
</div>
