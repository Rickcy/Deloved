<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 22.12.17
 * Time: 2:47
 */

use yii\bootstrap\Html;

/**
 * @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $profile common\models\Profile */

$acc = $user->profile->account;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/']);
?>
<div >
    <p>Здравствуйте! </p>
    <p>Вам хотят предложить безопасную сделку <?=$acc->brand_name?> на межотраслевом бизнес-портале "Деловед".<br/></p>

    <p>Чтобы принять сделку, пройдите по ссылке и зарегистрируйтесь:</p>

    <p><?= Html::a('Бизнес-портале "Деловед', $resetLink,[]) ?></p>
</div>