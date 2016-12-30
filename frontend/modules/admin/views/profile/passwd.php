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


    <? $form =ActiveForm::begin()?>

    <?=$form->field($model,'old_password')->passwordInput()?>
    
    <?=$form->field($model,'new_password')->passwordInput()?>
    
    <?=$form->field($model,'repeat_new_password')->passwordInput()?>

    <?=Html::submitButton('Change password',['class'=>'btn btn-lg btn-success '])?>
    <?ActiveForm::end()?>
</div>
