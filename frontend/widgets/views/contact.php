<?php
?>

<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;
/**@var $model frontend\models\ContactForm**/
?>
<div class="modal fade" id="Contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <?php $form = ActiveForm::begin(['id' => 'contact-form', 'options' => ['class' => 'form-signin text-center'],
            'enableAjaxValidation' => false,
            'validationUrl' => Url::to(['/validate/contact']),
        ])
        ?>
        <?= $form->field($model, 'name')->label('')->textInput(['class'=>'user_form-control form-control','placeholder'=>'Имя']) ?>

        <?= $form->field($model, 'email')->label('')->textInput(['class'=>'user_form-control form-control','placeholder'=>'E-mail'])?>

        <?= $form->field($model, 'subject')->dropDownList(['Вопросы по регистрации'=>'Вопросы по регистрации','Реклама'=>'Реклама', 'Сотрудничество'=>'Сотрудничество','Другое'=>'Другое'],['class'=>'user_form-control form-control','prompt'=>'Выбирите тему'])->label('') ?>

        <?= $form->field($model, 'body')->textarea(['rows' => 6,'class'=>'user_form-control form-control','placeholder'=>'Сообщение'])->label('') ?>

        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            'captchaAction'=>Url::to(['/front/captcha'])
        ])->label('') ?>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-lg btn-blue btn-block', 'name' => 'contact-button']) ?>
        </div>

        <?ActiveForm::end()?>
</div>
    </div>