<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 22.01.18
 * Time: 15:22
 */

use yii\bootstrap\Html;

/* @var $user common\models\User */
/* @var $profile common\models\Profile */

$profile = $user->getProfile()->one();
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/']);
$template = \common\models\MailTemplate::findOne(['type_template'=>\common\models\MailTemplate::MAIL_TEMPLATE_GENERAL]);
?>
<?=$template->template?>
<br>
<?= Html::a(Html::encode('Бизнес-портал Dеловед'), $resetLink,[]);

