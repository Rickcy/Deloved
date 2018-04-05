<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 22.01.18
 * Time: 15:00
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = Yii::t('app', 'Mail');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-edit">
    <h1 class="text-left">Шаблон письма</h1>

    <div class="ticket-create">
        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
            'template' => '<div class="col-sm-1 control-label">{label}</div><div class="col-sm-11">{input}</div><div class="row"><div class="col-sm-5 col-sm-offset-1">{error}</div></div>',
        ]]); ?>

        <?= $form->field($template, 'template')->textarea(['rows'=>15,])->label('')?>
        <hr>

        <div class="form-group text-left">
            <?= Html::submitButton( Yii::t('app', 'Save') , ['class' =>  'btn create-btn btn-md btn-success' ]) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
