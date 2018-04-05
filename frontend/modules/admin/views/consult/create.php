<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 17.08.17
 * Time: 15:25
 */
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->title = Yii::t('app', 'Create a question for jurist');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jurist Help'), 'url' => ['index']];
Yii::$app->formatter->timeZone = 'UTC';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="goods-create">
    <h1 class="text-left"><?= Html::encode($this->title) ?></h1>

    <div class="goods-create">
        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
            'template' => '<div class="col-sm-3 control-label">{label}</div><div class="col-sm-5">{input}</div><div class="row"><div class="col-sm-5 col-sm-offset-3">{error}</div></div>',
        ]]); ?>

        <?= $form->field($model, 'name')->textarea(['rows'=>4,'maxlength' => 255,'placeholder'=>''])->label(Yii::t('app','Detail subscribe'))?>
        <hr>

        <div class="form-group text-left">
            <?= Html::submitButton( Yii::t('app', 'Create') , ['class' =>  'btn create-btn btn-md btn-success' ]) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
