<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 17.08.17
 * Time: 15:25
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->title = Yii::t('app', 'Create ticket');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
Yii::$app->formatter->timeZone = 'UTC';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="goods-create">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="goods-create">
        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data'], 'fieldConfig' => [
            'template' => '<div class="col-sm-3 control-label">{label}</div><div class="col-sm-7">{input}</div><div class="col-sm-7 col-sm-offset-3">{error}</div>',
        ]]); ?>

        <?= $form->field($model, 'name')->textInput(['rows'=>10,'maxlength' => true])->label('Тема') ?>

        <hr>

        <div class="form-group text-center">
            <?= Html::submitButton( Yii::t('app', 'Create') , ['class' =>  'btn create-btn btn-md btn-success' ]) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
