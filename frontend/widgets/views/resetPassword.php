<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

/**@var $model \frontend\models\ResetPasswordForm**/
?>

<div class="modal fade" id="resetPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <?php

        $form = ActiveForm::begin(['id' => 'request-password-reset-form','options' => ['class' => 'form-signin text-center'],
            'enableAjaxValidation' => true,
            'validationUrl' => Url::to(['/validate/reset']),
        ])
        ?>


        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Отправить письмо', ['class' => 'btn btn-primary']) ?>
        </div>



        <?php ActiveForm::end(); ?>

    </div>

</div>
