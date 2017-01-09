<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'username')->textInput() ?>




    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'repassword')->passwordInput() ?>





    <?= $form->field($model, 'status',[


    ])->radioList([
        '1' => 'Enabled',
        '0' =>'Disabled',

    ],  [
        'class' => 'btn-group',
        'data-toggle' => 'buttons',
        'value'=>0,
        'unselect' => null,
        'item' => function ($index, $label, $name, $checked, $value) {
            return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
        },
    ]); ?>


    <? $items = ArrayHelper::map($role,'id','role_name');

    echo $form->field($model, 'role')->dropDownList($items)->label('Role')?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
