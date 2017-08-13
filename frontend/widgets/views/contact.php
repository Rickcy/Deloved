<?php
?>

<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/**@var $model frontend\models\ContactForm**/
?>
<div class="modal fade" id="Contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content contact-content" style="width:80%;margin: 0 auto">
        <div class="modal-header" style="background-color: #94C43D">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title " style="text-align: center;color: white">Мы рады вашим обращениям!</h4>
        </div>

      <div class="modal-body">
        <?php $form = ActiveForm::begin(['id' => 'contact-form', 'options' => ['class' => 'form-contact text-center'],
            'enableAjaxValidation' => false,
            'validationUrl' => Url::to(['/validate/contact']),
        ])
        ?>
        <?= $form->field($model, 'name')->label('')->textInput(['class'=>'contact_form-control form-control','placeholder'=>'Имя']) ?>

        <?= $form->field($model, 'email')->label('')->textInput(['class'=>'contact_form-control form-control','placeholder'=>'E-mail'])?>

        <?php $items = ArrayHelper::map($suggestion_cat,'id','name');
        echo $form->field($model, 'subject')->dropDownList($items,['class'=>'contact_form-control form-control','prompt'=>Yii::t('app', 'Select category')])->label('') ?>

        <?= $form->field($model, 'body')->textarea(['rows' => 4,'class'=>'contact_form-control form-control','placeholder'=>'Сообщение'])->label('') ?>

        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            'captchaAction'=>Url::to(['/front/captcha'])
        ])->label('') ?>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-lg btn-blue btn-block', 'name' => 'contact-button']) ?>
        </div>

        <?php ActiveForm::end()?>
</div>


</div>
</div>
</div>