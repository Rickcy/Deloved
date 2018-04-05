<?php

/**
 * @var $template \common\models\MailTemplate
 */
use common\models\User;
use yii\bootstrap\Html;

$this->title = Yii::t('app', 'Mail');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
?>
<div class="mail-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php if (!$isExist):?>
    <div class="buttons">
        <?= Html::a(Yii::t('app', 'Create a mail template'), ['edit'], ['class' => 'btn btn-success']) ?>
    </div>
    <?php else:?>
        <div class="buttons">
            <?= Html::a(Yii::t('app', 'Edit a mail template'), ['edit'], ['class' => 'btn btn-success']) ?>

            <?= Html::a(Yii::t('app', 'Begin mail'), 'javascript:void(0)', ['class' => 'btn btn-success','id'=>'begin-mail']) ?>
        </div>
    <?php endif;?>
    <?php if ($isExist):?>
        <div class="mail-template">
            <?=$template->template?>
        </div>
    <?php endif;?>
</div>
