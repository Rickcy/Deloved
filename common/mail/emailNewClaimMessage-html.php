<?php
/* @var $user common\models\User */

use yii\bootstrap\Html;

/* @var $profile common\models\Profile */
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/']);
$acc = $user->profile->account;
?>
<div>
    <p>Здравствуйте! </p>
    <p>У вас новое событие в личном кабинете на Бизнес-портале "Деловед”:</p>
    <p>Новое сообщение в иске с <?=$acc->brand_name?> <br/></p>

    <p>Чтобы просмотреть - пройдите по ссылке в личный кабинет:</p>

    <p><?= Html::a('Бизнес-портале "Деловед', $resetLink,[]) ?></p>

    <p>На этой письмо отвечать не нужно.</p>
    <p>С уважением,
        Команда "Деловед”</p>
</div>