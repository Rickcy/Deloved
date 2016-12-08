<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
/**@var $model common\models\LoginForm**/
?>
<div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <?php $form=ActiveForm::begin(['id' => 'form-signin', 'options' => ['class' => 'form-signin text-center'],
            'enableAjaxValidation' => true,
            'validationUrl' => Url::to(['/validate/login']),
        ])
        ?>
        <h4 >Вход в личный кабинет</h4>
        <h5 >Чтобы управлять своей компанией, а также вести сделки, нужно авторизоваться в системе.
            Если вы еще не зарегистрированны, можете сделать это здесь</h5>
        <?=$form->field($model,'username')->label('')->textInput(['class'=>'user_form-control form-control','placeholder'=>'Имя']) ?>

        <?=$form->field($model,'password')->passwordInput(['class'=>'user_form-control form-control','placeholder'=>'Пароль'])->label('') ?>

        <?=$form->field($model,'rememberMe')->checkbox()->label('Запомнить меня') ?>
        <div class="clearfix"></div>
        <?=Html::submitButton('Войти',['class'=>'btn btn-lg btn-green btn-block '])?>

        <?ActiveForm::end()?>




    </div>

</div>
