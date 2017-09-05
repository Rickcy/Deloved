<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 14.08.17
 * Time: 12:42
 */
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\jui\AutoComplete;

?>
<div class="modal fade" id="SignUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding: 0!important;overflow-x: hidden" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">

        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form-horizontal'],'fieldConfig' => [
            'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
            'labelOptions' => ['class' => 'col-sm-3 control-label'],
        ]]); ?>
        <h3 style="margin-bottom: 25px;font-weight: bold;text-align:center!important;color:rgb(148, 196, 61)">Регистрация
            <div style="background-image: linear-gradient(270deg, rgb(248, 215, 53), rgb(148, 196, 61) 110%);
			width: 98%;
			height: 2px;"></div></h3>


        <?= $form->field($model, 'fio')->textInput(['autofocus' => true])->label(Yii::t('app','Fio')) ?>

        <?= $form->field($model, 'inn')->textInput(['maxlength' => 12])->label('ИНН') ?>

        <?= $form->field($model, 'email')->textInput(['placeholder'=>'name@domain'])->label(Yii::t('app','E-mail address')) ?>

        <?= $form->field($model, 'profile_city')->widget(
            AutoComplete::className(), [

            'clientOptions' => [
                'source' => $city_list,
                'minLength' => 2,
            ],
            'options'=>[
                'class'=>'form-control'
            ],
        ])->label(Yii::t('app','City'));
        ?>
        <div class="text-center">
            <h3 class="text_reg_1">Данные пользователя для авторизации</h3>
        </div>

        <?= $form->field($model, 'username')->textInput(['placeholder'=>'По умоланию используется email'])->label(Yii::t('app','Enter login')) ?>

        <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app','Enter password')) ?>

        <?= $form->field($model,'repassword')->passwordInput()->label(Yii::t('app','Repeat password')) ?>


<div class="div_hidden" style="display: none;">
        <hr>
    <div class="text-center">
        <h3 class="text_reg_1">Данные предприятия/предпринимателя</h3>
    </div>
        <div class="signup_desc">Заполните поля в соответствии с данными ЕГРЮЛ/ЕГРИП. Обратите внимание на примеры </div>
        <?php $items = ArrayHelper::map($org_forms,'id','name');
        $params = [
            'prompt' => Yii::t('app','No select')
        ];
        echo $form->field($model, 'org_form_id')->dropDownList($items,$params)->label(Yii::t('app','Organizational and legal form'))?>

        <?= $form->field($model, 'full_name')->textInput()->label(Yii::t('app','Full name')) ?>

        <?= $form->field($model, 'brand_name')->textInput()->label(Yii::t('app','Brand name')) ?>



        <?= $form->field($model, 'ogrn')->textInput()->label(Yii::t('app','OGRN (OGRN)')) ?>



        <?= $form->field($model, 'legal_address')->textInput()->label(Yii::t('app','Legal address')) ?>

        <?= $form->field($model, 'date', ['template' => '{label}<div class="col-sm-4">{input}{error}{hint}</div>'])->widget(
            DatePicker::className(), [
            'value' => '12/31/2010',
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd.mm.yyyy',

            ]
        ])->label(Yii::t('app','Date registration'));?>


        <div class="col-sm-11 col-sm-offset-1">
            <div class="col-sm-8">
                <?= $form->field($model, 'city_name')->widget(
                    AutoComplete::className(), [

                    'clientOptions' => [
                        'source' => $city_list,
                        'minLength' => 2,
                    ],
                    'options'=>[
                        'class'=>'form-control'
                    ],
                ])->label('Адрес офиса');
                ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'address')->textInput()->label('') ?>
            </div>

        </div>

        <?= $form->field($model, 'director')->textInput()->label(Yii::t('app','Director')) ?>

        <?= $form->field($model, 'phone1')->textInput()->label('Основной номер телефона') ?>

        <?= $form->field($model, 'fax')->textInput()->label('Основной факс') ?>


        <?= $form->field($model, 'work_time')->textInput()->label('Время работы') ?>

        <?= $form->field($model, 'web_address')->textInput()->label('Веб-сайт') ?>

        <?= $form->field($model, 'description')->textarea(['rows'=>6])->label('Описание') ?>

        <?= $form->field($model, 'keywords')->textarea(['rows'=>6])->label('Ключевые слова') ?>
</div>

        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            'captchaAction'=>Url::to(['/front/captcha'])
        ])->label('') ?>

        <?=$form->field($model,'sogl')->checkbox(['class'=>'text-center'])->label('Я согласен с пользовательским соглашением')?>

        <div class="form-group" style="text-align: right">
            <?= Html::submitButton('Завершить регистрацию', ['class' => 'btn btn-md btn-success registr-btn', 'name' => 'signup-button']) ?>
        </div>
        <?php ActiveForm::end()?>


    </div>

</div>
