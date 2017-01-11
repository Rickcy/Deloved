<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>
<div class="modal fade" id="Suggestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content contact-content" style="width:80%;margin: 0 auto">
            <div class="modal-header" style="background-color: #94C43D">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title " style="text-align: center;color: white">Мы рады вашим обращениям!</h4>
            </div>

            <div class="modal-body">
                <?php $form = ActiveForm::begin(['id' => 'contact-form', 'options' => ['class' => 'form-contact text-center'], 'fieldConfig' => [
                    'template' => '{label}<div class="col-xs-12">{input}</div><div class="col-xs-12">{error}</div>',
                    'labelOptions' => ['class' => 'col-xs-12 control-label']],

                    'enableAjaxValidation' => false,
                    'validationUrl' => Url::to(['/validate/suggestion']),
                ])
                ?>
                <div class="alert alert-info" style="text-align: justify; font-size: 14px">
                    Укажите Ваши предложения, замечания или отзывы о работе портала, заполнив поля ниже.
                </div>

                <?
                $items = ArrayHelper::map($suggestion_cat,'id','name');
                echo $form->field($model, 'suggestion_cat')->label('')->dropDownList($items,['class'=>'contact_form-control form-control'])?>




                <?= $form->field($model, 'content')->textarea(['rows' => 10,'class'=>'contact_form-control form-control','placeholder'=>'Сообщение'])->label('') ?>



                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-lg btn-blue btn-block', 'name' => 'contact-button']) ?>
                </div>

                <?ActiveForm::end()?>
            </div>


        </div>
    </div>
</div>
