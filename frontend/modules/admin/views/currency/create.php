<?php
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

/** @var $currency common\models\Currency **/

$this->title = Yii::t('app', 'Create Currency');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="currency-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?$form =ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
    ]])?>
    <?=$form->field($currency , 'name')->textInput()?>

    <?=$form->field($currency , 'code')->textInput()?>


<!---->
<!-- --><?// $items = ArrayHelper::map($type,'id','code');
//
//    echo $form->field($currency, 'type_id')->dropDownList($items)->label('Категория')?>


    <div class="form-btn">
        <?= Html::submitButton(Yii::t('app', 'Create Currency'), ['class' =>  'btn create-btn btn-md btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>

    </div>

    <?ActiveForm::end()?>
</div>
