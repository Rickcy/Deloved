<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
/**@var $model common\models\LoginForm**/
?>
<div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding: 0!important;overflow-x: hidden" aria-hidden="true">
    <div class="modal-dialog">

        <?php $form=ActiveForm::begin(['id' => 'form-signin', 'options' => ['class' => 'form-signin text-center'], 'fieldConfig' => [
            'template' => '{input}{error}',
            'labelOptions' => ['class' => 'col-sm-3 control-label'],

                ],
            'enableAjaxValidation' => true,
            'validationUrl' => Url::to(['/validate/login']),
        ])
        ?>
        <h3 ><?=Yii::t('app', 'The entrance to personal Cabinet')?></h3>
        <h5 ><?=Yii::t('app', 'To manage your company, and also to conduct transactions, you need to log into the system. If you have not yet registered can do so ')?>
            <a href="javascript:void(0)" data-target="#SignUp" data-toggle="modal"><?= Yii::t('app', 'here')?></a> </h5>
        <?=$form->field($model,'username')->label('')->textInput(['class'=>'user_form-control form-control','placeholder'=>Yii::t('app', 'Username')]) ?>

        <?=$form->field($model,'password')->passwordInput(['class'=>'user_form-control form-control','placeholder'=>Yii::t('app', 'Password')])->label('') ?>
        <?=$form->field($model,'timeZone')->hiddenInput(['id'=>'timeZone'])?>
<!--        <a href="#" data-target="#resetPassword" data-dismiss="modal" data-toggle="modal" style="float: left">Забыли пароль?</a>-->
        <?= Html::a(Yii::t('app', 'Are you forgot password?'), ['/#'],['data-dismiss'=>'modal','data-toggle'=>'modal', 'data-target'=>'#resetPassword','style'=>'float: left']) ?>

        <?=$form->field($model,'rememberMe')->checkbox()->label(Yii::t('app', 'Remember me'),['style'=>'float:right']) ?>
        <div class="clearfix"></div>
        <?=Html::submitButton(Yii::t('app', 'Login'),['class'=>'btn btn-lg btn-green btn-block ','id'=>'sendBtn','onclick'=>'yaCounter42521619.reachGoal("vhodlk"); return true;' ])?>

        <?php ActiveForm::end()?>



        <script>
            $('#sendBtn').click(function () {
                x = new Date();
                a = -x.getTimezoneOffset();
                $('#timeZone').val(a);
            })


        </script>
    </div>

</div>
