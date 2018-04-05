<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 06.02.18
 * Time: 19:13
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;

?>
<div class="modal fade" id="Questions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding: 0!important;overflow-x: hidden" aria-hidden="true">
    <div class="modal-dialog">

        <?php $form = ActiveForm::begin(['id' => 'form-signin', 'options' => ['class' => 'form-signin '], 'fieldConfig' => [
            'template' => '{input}{error}',
            'labelOptions' => ['class' => 'container-l'],

        ],
            'enableAjaxValidation' => false,
            'validationUrl' => Url::to(['/validate/question']),
        ])
        ?>
        <h3 style="margin-bottom: 25px;font-weight: bold;text-align:center!important;color:rgb(148, 196, 61)">Вы не закончили регистрацию
            <div style="background-image: linear-gradient(270deg, rgb(248, 215, 53), rgb(148, 196, 61) 110%);
			width: 98%;
			height: 2px;"></div></h3>
        <div class="text-center">
            <h3 class="text_reg_1">Для нас важно ваше мнение!
                Укажите причину ниже.</h3>
        </div>

        <?=$form->field($model, 'checkboxList')
            ->checkboxList([
                1 => 'Вы не являетесь ИП и у вас нет предприятия',
                2 => 'Форма регистрации очень сложная',
                3 => 'Вы попробовали пройти регистрацию, но возникла ошибка сайте',
                4 => 'Вы не хотели бы оставлять на сайте свой ИНН',
                5 => 'другое (укажите причину):',
            ],[
                'item' =>
                    function ($index, $label, $name, $checked, $value) {
                        return '<label class="container-l">'.$label.'
            <input type="checkbox" name="'.$name.'" value="'.$value.'">
            <span class="checkmark"></span>
        </label>';
                    }]);
        ?>

            <?php /** $form->field($model, 'check1',[  'template' => '<label class="container-l">Вы не являетесь ИП и у вас нет предприятия
            {input}
            <span class="checkmark"></span>
        </label>',])->checkbox([],false)->label(false) **/?>




        <?= $form->field($model, 'reason')->textInput()->label(false) ?>

        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            'captchaAction'=>Url::to(['/companies/captcha'])
        ])->label('') ?>
        <div class="clearfix"></div>
        <?=Html::submitButton('Отправить',['class'=>'btn btn-lg btn-green btn-block ','id'=>'sendBtn' ])?>

        <?php ActiveForm::end()?>




    </div>

</div>
