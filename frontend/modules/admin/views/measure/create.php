<?php
/** @var $measure common\models\Measure **/

use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Create Measure');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>

<div class="measure-create">
    <h3><?= Html::encode($this->title) ?></h3>


    <?php $form =ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
    ]])?>
    <?=$form->field($measure , 'name')->textInput()?>

    <?=$form->field($measure , 'full_name')->textInput()?>

     <?php  $items = ArrayHelper::map($type,'id','code');

        echo $form->field($measure, 'type_id')->dropDownList($items)->label('Категория')?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create Measure'), ['class' =>  'btn create-btn btn-md btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>

    </div>

    <?php ActiveForm::end()?>



</div>
