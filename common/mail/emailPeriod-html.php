<?php
use yii\bootstrap\Html;

/**
 * @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $profile common\models\Profile */

$profile = $user->profile;

$resetLink = 'https://deloved.ru/';
?>
<div >
    <p>Здравствуйте <?=$profile->fio?></p>
    <p>У вас закончился период Расширенной подписки на межотраслевом бизнес-портале "Деловед".<br/></p>

    <p>Чтобы продлить подписку, пройдите по ссылке и зайдите в кабинет:</p>

    <p><?= Html::a('Бизнес-портале "Деловед', $resetLink,[]) ?></p>
</div>