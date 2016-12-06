<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регитсрация нового пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-sm-10 ">

            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
                'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
                'labelOptions' => ['class' => 'col-sm-3 control-label'],
            ],]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true,]) ?>

                <?= $form->field($model, 'email')->textInput(['placeholder'=>'name@domain']) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model,'repassword')->passwordInput(); ?>

                <div class="form-group">
                    <?= Html::submitButton('Завершить регистрацию', ['class' => 'btn btn-md btn-success registr-btn', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

