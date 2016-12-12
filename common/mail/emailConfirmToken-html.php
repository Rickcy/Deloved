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
    <p>Здравствуйте, <?= $profile->fio ?>! </p>
    <p>Вы зарегистрировались на межотраслевом бизнес-портале "Деловед".<br/></p>

    <p>Чтобы активировать свой профиль, пройдите по ссылке:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink,[]) ?></p>
</div>
