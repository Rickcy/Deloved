<?php
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;


/** @var $model frontend\models\ChangePassForm**/


$this->title = Yii::t('app', 'Change password');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>

<div class="profile-pass">
    <h3><?= Html::encode($this->title) ?></h3>


    <?php  $form =ActiveForm::begin()?>

    <?=$form->field($model,'old_password')->passwordInput()->label(Yii::t('app','Old password'))?>
    
    <?=$form->field($model,'new_password')->passwordInput()->label(Yii::t('app','New password'))?>
    
    <?=$form->field($model,'repeat_new_password')->passwordInput()->label(Yii::t('app','Repeat password'))?>

    <?=Html::submitButton(Yii::t('app', 'Change password'),['class'=>'btn btn-lg btn-success '])?>
    <?php ActiveForm::end()?>
</div>
