<?php
/* @var $user common\models\User */

use yii\bootstrap\Html;

/* @var $profile common\models\Profile */
$profile = $user->profile;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/']);
?>
    Здравствуйте!
    У вас новое событие в личном кабинете на Бизнес-портале "Деловед”:
    Новое сообщение в обращении в тех поддержку<br/>

    Чтобы просмотреть - пройдите по ссылке в личный кабинет:

<?= Html::a('Бизнес-портале "Деловед', $resetLink,[]) ?>

    На этой письмо отвечать не нужно.
    С уважением,    Команда "Деловед”


