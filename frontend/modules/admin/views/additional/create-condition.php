<?php
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = Yii::t('app', 'Create Condition');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="create-condition">
    <?php $form = ActiveForm::begin()?>
    <?=$form->field($conditions,'name')?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create Condition'), ['class' =>  'btn create-btn btn-md btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>

    </div>
    <?php ActiveForm::end()?>
</div>
