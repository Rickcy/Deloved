<?php


use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Create task');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['tasks']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '<div class="col-sm-3 control-label">{label}</div><div class="col-sm-5">{input}</div><div class="row"><div class="col-sm-5 col-sm-offset-3">{error}</div></div>',
    ]]); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?php  $items = ArrayHelper::map($managers,'id','fio');
    $params = [
        'prompt' => 'Выбирете менеджера'
    ];
    echo $form->field($model, 'manager_id')->dropDownList($items,$params)?>

    <?php
     $data = ArrayHelper::toArray($deals, [
        'common\models\Deal' => [
            'id',
            'name' => function ($deal) {
                return $deal->buyer->account->brand_name.' && '.$deal->seller->account->brand_name;
            },
        ],
    ]);
    $items = ArrayHelper::map($data,'id','name');
    $params = [
        'prompt' => 'Выбирете Сделку'
    ];
    echo $form->field($model, 'deal_id')->dropDownList($items,$params)?>


    <?= $form->field($model, 'comment')->textarea(['rows'=>6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create task'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
