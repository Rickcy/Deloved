<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\AutoComplete;
use yii\jui\DatePicker;

$this->title = 'Регитсрация нового пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>
<!--<pre>-->
<?//=print_r($city_list)?>
<!--  </pre>-->
    <div class="row">
        <div class="col-sm-10 ">

            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
                'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
                'labelOptions' => ['class' => 'col-sm-3 control-label'],
            ],]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true,]) ?>

                <?= $form->field($model, 'email')->textInput(['placeholder'=>'name@domain']) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model,'repassword')->passwordInput(); ?>

            
                <?= $form->field($model, 'city_name')->widget(
                    AutoComplete::className(), [

                    'clientOptions' => [
                        'source' => $city_list,
                        'minLength' => 3,
                    ],
                    'options'=>[
                        'class'=>'form-control'
                    ],
                ]);
                ?>
                
                 <?= $form->field($model, 'address')->textInput() ?>

                 <?= $form->field($model, 'brand_name')->textInput() ?>

                


                 <?= $form->field($model, 'description')->textInput() ?>

                 <?= $form->field($model, 'director')->textInput() ?>

                 <?= $form->field($model, 'full_name')->textInput() ?>

                 <?= $form->field($model, 'fax')->textInput() ?>

                 <?= $form->field($model, 'inn')->textInput() ?>

                 <?= $form->field($model, 'keywords')->textInput() ?>

                 <?= $form->field($model, 'kpp')->textInput() ?>

                 <?= $form->field($model, 'legal_address')->textInput() ?>

                 <?= $form->field($model, 'phone1')->textInput() ?>
            
            
                 <?= $form->field($model, 'phone2')->textInput() ?>
            
                 <?= $form->field($model, 'web_address')->textInput() ?>
            
                 <?= $form->field($model, 'work_time')->textInput() ?>

                 <? $items = ArrayHelper::map($org_forms,'id','name');
                 $params = [
                     'prompt' => 'Не выбрано'
                 ];
                 echo $form->field($model, 'org_form_id')->dropDownList($items,$params);?>

                 <?= $form->field($model, 'fio')->textInput() ?>

                 <?= $form->field($model, 'cellPhone')->textInput() ?>






            <div class="form-group">
                    <?= Html::submitButton('Завершить регистрацию', ['class' => 'btn btn-md btn-success registr-btn', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

