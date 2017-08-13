<?php
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = Yii::t('app', 'Create Payment Methods');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="create-pay-methods">
    <?php $form = ActiveForm::begin()?>
    <?=$form->field($payMethods,'name')?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create Payment Methods'), ['class' =>  'btn create-btn btn-md btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>

    </div>
    <?php ActiveForm::end()?>
</div>
