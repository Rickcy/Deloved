<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Create manager');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Managers'), 'url' => ['managers']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manager-create">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '<div class="col-sm-3 control-label">{label}</div><div class="col-sm-5">{input}</div><div class="row"><div class="col-sm-5 col-sm-offset-3">{error}</div></div>',
    ]]); ?>

    <?= $form->field($model, 'fio')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'repassword')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create manager'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
