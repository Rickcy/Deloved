<?php
/* @var $user common\models\User */

use yii\bootstrap\Html;

/* @var $profile common\models\Profile */
$profile = $user->profile;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/']);
?>
    Здравствуйте!
    У вас новое событие в личном кабинете на Бизнес-портале "Деловед”:
    Новый статус в консультации <br/>

    Чтобы просмотреть - пройдите по ссылке в личный кабинет:

<?= Html::a('Бизнес-портале "Деловед', $resetLink,[]) ?>

    На этой письмо отвечать не нужно.
    С уважением,    Команда "Деловед”

