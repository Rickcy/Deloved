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
            'validationUrl' => Url::to(['/validate/index']),
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


<!--        <form class="form-signin" action='${ request.contextPath }/j_spring_security_check' method='POST' id='loginForm' autocomplete='on' style="z-index: 1000">-->
<!--            <h3 class="form-signin-heading" style="font-family: 'Palatino Linotype', 'Book Antiqua', Palatino, serif">Вход в личный кабинет</h3>-->
<!--            <h5 class="form-sigin-h5" style="text-align: center;width: 90%;margin-left: 5%;font-family: Georgia, serif;font-size: 11pt">Чтобы управлять своей компанией, а также вести сделки, нужно авторизоваться в системе.-->
<!--                Если вы еще не зарегистрированны, можете сделать это <g:link controller="signup" action="index">здесь</g:link></h5>-->
<!---->
<!--            <input style="margin-bottom: 1%;border-radius: 10px;font-family: Georgia, serif" type="text" class="form-control" name='j_username' id='username' placeholder="${message(code: "springSecurity.login.username.label")}" autofocus>-->
<!--            <input type="password" style="border-radius: 10px;font-family: Georgia, serif" class="form-control" name='j_password' id='password' placeholder="${message(code: "springSecurity.login.password.label")}">-->
<!--            <label class="checkbox" style="font-family: Georgia, serif;">-->
<!--                <input type="checkbox" name='${rememberMeParameter}' id='remember_me' <g:if test='${hasCookie}'>checked='checked'</g:if>>-->
<!--                <g:message code="springSecurity.login.remember.me.label"/>-->
<!--            </label>-->
<!---->
<!--            <div style="float: left;margin-top: 4%;font-family: Georgia, serif;font-size: 90%"><g:link controller="recover">Забыли пароль?</g:link></div>-->
<!--            <div class="clearfix"></div>-->
<!--            <div class="btn btn-lg btn-primary btn-block loginin" style="font-family: 'Palatino Linotype', 'Book Antiqua', Palatino, serif" onclick="authAjax()"><g:message code="springSecurity.login.button"/></div>-->
<!---->
<!---->
<!--        </form>-->

    </div>

</div>
