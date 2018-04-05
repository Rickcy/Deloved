<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;

/* @var $user common\models\User */
/* @var $profile common\models\Profile */
$acc = $user->profile->account;

$resetLink = 'https://deloved.ru/';
?>
    Здравствуйте <?=$profile->fio?><br>
    У вас заканчился период Расширенной подписки на межотраслевом бизнес-портале "Деловед".<br/>

    Чтобы продлить подписку, пройдите по ссылке и зайдите в кабинет:

<?= Html::a('Бизнес-портале "Деловед', $resetLink,[]) ?>