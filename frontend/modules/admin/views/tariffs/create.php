<?php
/* @var $this yii\web\View */
/* @var $tariff common\models\Tariffs */
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Create Tariff');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>

<div class="tariff-create">
    <h3><?= Html::encode($this->title) ?></h3>


    <?$form =ActiveForm::begin([ 'options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
    ]])?>
    <?=$form->field($tariff , 'name')->textInput()?>
    <?=$form->field($tariff , 'price')->textInput()?>



    <? $items = ArrayHelper::map($currency,'id','code');

    echo $form->field($tariff, 'currency_id')->dropDownList($items)->label(Yii::t('app', 'Currency'))?>

    <?=$form->field($tariff , 'months')->dropDownList([
        '1' => '1 месяц',
        '3' => '3 месяца',
        '6' => '6 месяцев',
        '9' => '9 месяцев',
        '12' => '12 месяцев',
    ],
        [
            'prompt' => Yii::t('app', 'Select the number of months'),
        ]);?>


    <div class="form-btn">
        <?= Html::submitButton(Yii::t('app', 'Create Tariff'), ['class' =>  'btn create-btn btn-md btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>

    </div>

    <?ActiveForm::end()?>
</div>