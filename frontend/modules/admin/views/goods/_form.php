<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'availability')->textInput() ?>

    <?= $form->field($model, 'rating_count')->textInput() ?>

    <?= $form->field($model, 'rating_good')->textInput() ?>

    <?= $form->field($model, 'condition_id')->textInput() ?>

    <?= $form->field($model, 'payment_methods_id')->textInput() ?>

    <?= $form->field($model, 'delivery_methods_id')->textInput() ?>

    <?= $form->field($model, 'account_id')->textInput() ?>

    <?= $form->field($model, 'category_type_id')->textInput() ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'date_created')->textInput() ?>

    <?= $form->field($model, 'show_main')->textInput() ?>

    <?= $form->field($model, 'photo_id')->textInput() ?>

    <?= $form->field($model, 'measure_id')->textInput() ?>

    <?= $form->field($model, 'currency_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
