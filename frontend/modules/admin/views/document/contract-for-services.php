<?php
/**
 * @var $account \common\models\Account
 */
use common\models\User;
use frontend\models\DocumentForm;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

use yii\jui\AutoComplete;
$this->title = Yii::t('app', 'Contract for services');
?>
<div class="contract-for-services" xmlns:g="http://www.w3.org/1999/xhtml">
    <?php $form =ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{input}<div>{error}</div>'
    ]])?>
    <div id="text">
        <div class="row">

            <div class="text-center">
                <div class="col-xs-6 text-right">ДОГОВОР НА ОКАЗАНИЕ УСЛУГ №   </div>
                <div class="col-xs-6 text-left"><?=$form->field($documentForm , 'number')->textInput(['class'=>'pdf-control pdf-number'])?></div>

            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-6 text-center">
                <div class="row">
                    <div class="col-xs-12">
                        Место подписания договора :
                    </div>
                    <div class="col-xs-12">
                        <?= $form->field($documentForm, 'place_signing')->widget(
                            AutoComplete::className(), [

                            'clientOptions' => [
                                'source' => $city_list,
                                'minLength' => 2,
                            ],
                            'options'=>[
                                'class'=>'pdf-control',
                                'value' =>$account->city->name
                            ],
                        ])->label('');
                        ?>
                    </div>


                </div>
            </div>
            <div class="col-sm-6 text-center">
                <div class="row">
                    <div class="col-xs-12">
                        Дата подписания договора
                    </div>
                    <div class="col-xs-12">
                        <?= $form->field($documentForm, 'date_signing')->widget(
                            DatePicker::className(), [

                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'dd.mm.yyyy',

                            ],
                            'options'=>[
                                'class'=>'pdf-control pdf-number',
                                'value' => date('d.m.Y'),
                            ]
                        ]);?>
                    </div>


                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="text-center">Стороны сделки</div>
            <div class="col-sm-6 text-center">
                <div class="col-xs-12">
                    «Исполнитель» :
                    <br>
                    ИНН
                </div>
                <div class="col-xs-12">
                    <?=$form->field($documentForm , 'inn_executor')->textInput(['class'=>'pdf-control inn_executor'])?>
                </div>
                <?php if (User::checkRole(['ROLE_USER'])):?>
                <button type="button" class="btn btn-success my-data my-data-ispol">Заполнить моими данными</button>
                <?php endif;?>



            </div>
            <div class="col-sm-6 text-center">
                <div class="col-xs-12">
                    «Заказчик» :<br>
                    ИНН
                </div>
                <div class="col-xs-12">
                    <?=$form->field($documentForm , 'inn_customer')->textInput(['class'=>'pdf-control inn_customer'])?>
                </div>
                <?php if (User::checkRole(['ROLE_USER'])):?>
                <button type="button" class="btn btn-success my-data my-data-zakaz">Заполнить моими данными</button>
                <?php endif;?>

            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-xs-12 text-center" >Перечень услуг :</div>
            <div class="col-xs-12">
                <?=$form->field($documentForm , 'service_list')->textarea(['rows'=>2,'class'=>'pdf-control'])?>
            </div>
             <br><br>
            <div class="col-xs-12 text-center" >Привлечение соисполнителей:</div>
            <div class="col-xs-12 text-center" ><?=$form->field($documentForm, 'attraction_co_executors')->dropDownList(DocumentForm::listCoExecutors())?></div>



            <br>
            <div class="col-xs-12 text-center" >Cроки оказания услуг:</div>
            <div class="row">
            <div class="col-xs-4 text-right">
                Дата начала  –
            </div>
            <div class="col-xs-4 text-left">
                <?= $form->field($documentForm, 'date_service_delivery_begin')->widget(
                    DatePicker::className(), [
                    'value' => '12/31/2010',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd.mm.yyyy',

                    ]
                ]);?>
            </div>
            </div>
            <div class="row">
            <div class="col-xs-4 text-right">
                Дата окончания  –
            </div>

            <div class="col-xs-4 text-left">
                <?= $form->field($documentForm, 'date_service_delivery_end')->widget(
                    DatePicker::className(), [
                    'value' => '12/31/2010',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd.mm.yyyy',

                    ],
                    'options'=>[
                        'class'=>'pdf-control pdf-number'
                    ]
                ]);?>
            </div>
            </div>

            <br>
            <div class="col-xs-12 text-center" >Место оказания Услуг :</div>

            <div class="col-xs-12 text-center">
                <?= $form->field($documentForm, 'location_services')->widget(
                    AutoComplete::className(), [

                    'clientOptions' => [
                        'source' => $city_list,
                        'minLength' => 2,
                    ],
                    'options'=>[
                        'class'=>'pdf-control'
                    ],
                ])
                ?>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-xs-12 text-center" > Компенсация расходов Исполнителя :</div>
            <div class="col-xs-12 text-center" ><?=$form->field($documentForm, 'compensation_expenses')->dropDownList(DocumentForm::listCompensationExpenses())?></div>



        </div>
        <br>

        <div class="row">
            <div class="col-xs-12 text-center" >  Стоимость  Услуг :</div>
            <br><br>
            <div class="col-xs-6 text-right" > Стоимость составляет</div>
            <div class="col-xs-6 text-left" >
                 <?=$form->field($documentForm , 'cost')->textInput(['class'=>'pdf-control'])?>

            </div>



            <div class="col-xs-12 text-center" >НДС :</div>
            <div class="col-xs-12 text-center" ><?=$form->field($documentForm, 'VAT')->dropDownList(DocumentForm::listVAT())?></div>

            <div class="col-xs-12 text-center" >Порядок оплаты:</div>
            <div class="col-xs-12 text-center" ><?=$form->field($documentForm, 'payment_order')->dropDownList(DocumentForm::listPaymentOrder())?></div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12 text-center" > Ответственность Сторон:</div>
            <div class="col-xs-12 " ><?=$form->field($documentForm, 'responsibility')->checkboxList(DocumentForm::listResponsibility())?></div>
          </div>
        <br>

    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create Document'), ['class' =>  'btn create-btn btn-md btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>

    </div>




    <?php ActiveForm::end()?>
</div>
<script>
    $(document).ready(function () {
        var inn;
        $('.my-data-zakaz').click(function () {
            $.ajax({
                type:'post',
                url:'/admin/document/get-my-data',
                success:function (data) {
                    $('#documentform-inn_customer').val(data)
                    $('.my-data').remove();
                },
                error:function () {
                    console.log('Error')
                }
            })

        });
        $('.my-data-ispol').click(function () {
            $.ajax({
                type:'post',
                url:'/admin/document/get-my-data',
                success:function (data) {
                    $('#documentform-inn_executor').val(data)
                    $('.my-data').remove();
                },
                error:function () {
                    console.log('Error')
                }
            })

        })

    });
    function getMyData() {

    }
</script>