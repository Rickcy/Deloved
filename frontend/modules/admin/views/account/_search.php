<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\AccountSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'full_name') ?>

    <?= $form->field($model, 'org_form_id') ?>

    <?= $form->field($model, 'brand_name') ?>

    <?= $form->field($model, 'inn') ?>

    <?php // echo $form->field($model, 'kpp') ?>

    <?php // echo $form->field($model, 'legal_address') ?>

    <?php // echo $form->field($model, 'date_reg') ?>

    <?php // echo $form->field($model, 'phone1') ?>

    <?php // echo $form->field($model, 'phone2') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'web_address') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'director') ?>

    <?php // echo $form->field($model, 'work_time') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'public_status') ?>

    <?php // echo $form->field($model, 'verify_status') ?>

    <?php // echo $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
