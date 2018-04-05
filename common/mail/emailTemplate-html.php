<?php

/**
 * @var $this yii\web\View */

use yii\bootstrap\Html;

/* @var $user common\models\User */
/* @var $profile common\models\Profile */

$profile = $user->getProfile()->one();
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/']);
$template = \common\models\MailTemplate::findOne(['type_template'=>\common\models\MailTemplate::MAIL_TEMPLATE_GENERAL]);
?>
<div class="template">
    <?=$template->template?>
    <p><?= Html::a(Html::encode('Бизнес-портал Dеловед'), $resetLink,[]) ?></p>
</div>