<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

/* @var $category \common\models\Category */
/* @var $cat \common\models\Category */
/* @var $c \common\models\Category */
/* @var $catType \common\models\CategoryType */

use kartik\date\DatePicker;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\jui\AutoComplete;

$this->title = 'Регитсрация нового пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1></h1>

<div class="shadow_block">
    <div class="row">

        <div class="col-sm-11 ">

            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
                'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
                'labelOptions' => ['class' => 'col-sm-3 control-label'],
            ]]); ?>
            <h1 style="font-weight: bold;text-align:left!important;color:rgb(148, 196, 61)"><?= Html::encode($this->title) ?>
                <div style="background-image: linear-gradient(270deg, rgb(248, 215, 53), rgb(148, 196, 61) 110%);
			width: 98%;
			height: 4px;"></div></h1>

            <h3 class="text_reg_1">Данные пользователя для авторизации</h3>

            <div class="signup_desc">После регистрации на вашу почту придет письмо об активации.</div>

            <?= $form->field($model, 'fio')->textInput(['autofocus' => true])->label('Имя') ?>

            <?= $form->field($model, 'email')->textInput(['placeholder'=>'name@domain'])->label('Введите адрес эл. почты') ?>

                <?= $form->field($model, 'username')->textInput()->label('Введите логин') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Введите пароль') ?>

                <?= $form->field($model,'repassword')->passwordInput()->label('Повторите пароль') ?>

                     <?= $form->field($model, 'profile_city')->widget(
                         AutoComplete::className(), [

                         'clientOptions' => [
                             'source' => $city_list,
                             'minLength' => 2,
                         ],
                         'options'=>[
                             'class'=>'form-control'
                         ],
                     ])->label('Ваш город');
                     ?>

            <hr>

            <h3 class="text_reg_1">Данные предприятия/предпринимателя</h3>

            <div class="signup_desc">Заполните поля в соответствии с данными ЕГРЮЛ/ЕГРИП. Обратите внимание на примеры </div>
            <?php $items = ArrayHelper::map($org_forms,'id','name');
            $params = [
                'prompt' => 'Не выбрано'
            ];
            echo $form->field($model, 'org_form_id')->dropDownList($items,$params)->label('Организационно-правовая форма')?>

            <?= $form->field($model, 'full_name')->textInput()->label('Полное наименование') ?>

            <?= $form->field($model, 'brand_name')->textInput()->label('Фирменное название') ?>



            <?= $form->field($model, 'ogrn')->textInput()->label('ОГРН (ОГРНИП)') ?>

            <?= $form->field($model, 'inn')->textInput()->label('ИНН') ?>

            <?= $form->field($model, 'legal_address')->textInput()->label('Юридический адрес') ?>

            <?= $form->field($model, 'date', ['template' => '{label}<div class="col-sm-4">{input}{error}{hint}</div>'])->widget(
                DatePicker::className(), [
                'value' => '12/31/2010',
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'mm/dd/yyyy',
                    
                ]
            ])->label('Дата регистрации');?>


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

            <?= $form->field($model, 'director')->textInput()->label('Руководство') ?>

            <?= $form->field($model, 'phone1')->textInput()->label('Основной номер телефона') ?>

            <?= $form->field($model, 'fax')->textInput()->label('Основной факс') ?>


            <?= $form->field($model, 'work_time')->textInput()->label('Время работы') ?>

            <?= $form->field($model, 'web_address')->textInput()->label('Веб-сайт') ?>

                 <?= $form->field($model, 'description')->textarea(['rows'=>6])->label('Описание') ?>

            <?= $form->field($model, 'keywords')->textarea(['rows'=>6])->label('Ключевые слова') ?>


            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                'captchaAction'=>Url::to(['/front/captcha'])
            ])->label('') ?>


            <div class="form-group">
                    <?= Html::submitButton('Завершить регистрацию', ['class' => 'btn btn-md btn-success registr-btn', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
        </div>

