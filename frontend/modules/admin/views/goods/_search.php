<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\GoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'availability') ?>

    <?php // echo $form->field($model, 'rating_count') ?>

    <?php // echo $form->field($model, 'rating_good') ?>

    <?php // echo $form->field($model, 'condition_id') ?>

    <?php // echo $form->field($model, 'payment_methods_id') ?>

    <?php // echo $form->field($model, 'delivery_methods_id') ?>

    <?php // echo $form->field($model, 'account_id') ?>

    <?php // echo $form->field($model, 'category_type_id') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'date_created') ?>

    <?php // echo $form->field($model, 'show_main') ?>

    <?php // echo $form->field($model, 'photo_id') ?>

    <?php // echo $form->field($model, 'measure_id') ?>

    <?php // echo $form->field($model, 'currency_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
