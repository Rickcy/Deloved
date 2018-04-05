<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;

/* @var $user common\models\User */
/* @var $profile common\models\Profile */
$acc = $user->profile->account;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/']);
?>
    Здравствуйте!<br>
    Вам хотят предложить безопасную сделку <?=$acc->brand_name?> на межотраслевом бизнес-портале "Деловед".<br/>

    Чтобы принять сделку, пройдите по ссылке и зарегистрируйтесь:

<?= Html::a('Бизнес-портале "Деловед', $resetLink,[]) ?>