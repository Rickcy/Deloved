<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;

/**@var $model frontend\models\RepeatEmailConfirm
 **/
$this->title = 'Повторный запрос на почту'
?>
<div align="center">
    <div style="width: 80%; border-radius: 4px; border: 1px solid silver; padding: 15px" align="left">



        <span style="text-align: left; font-weight: bold;">Повторный запрос на проверку модератором или на смену почтового ящика</span>

        <?php  $form = ActiveForm::begin(['id'=>'formResend'])?>
            <?=$form->field($model,'email')->textInput(['value' => $user->email])->label('')?>
        <div class="form-group">
            <?= Html::submitButton('Выслать', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            'captchaAction'=>Url::to(['/admin/default/captcha'])
        ])->label('') ?>

        <?php  ActiveForm::end()?>
    </div>
</div>
