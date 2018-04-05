<?php
/* @var $user common\models\User */

use yii\bootstrap\Html;

/* @var $profile common\models\Profile */
$acc = $user->profile->account;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/']);
?>
Здравствуйте!
У вас новое событие в личном кабинете на Бизнес-портале "Деловед”:
Новое сообщение в споре с <?=$acc->brand_name?> <br/>

Чтобы просмотреть - пройдите по ссылке в личный кабинет:

<?= Html::a('Бизнес-портале "Деловед', $resetLink,[]) ?>

На этой письмо отвечать не нужно.
С уважением,    Команда "Деловед”