<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 31.08.17
 * Time: 23:56
 */
use frontend\models\DocumentForm;
use kartik\date\DatePicker;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
$this->title = Yii::t('app', 'Delivery contract');
?>
<div class="delivery-contract" xmlns:g="http://www.w3.org/1999/xhtml">
    <?php $form =ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{input}<div>{error}</div>'
    ]])?>
    <div id="text">
        <div class="row">

            <div class="text-center">
                <div class="col-xs-6 text-right">ДОГОВОР ПОСТАВКИ №   </div>
                <div class="col-xs-6 text-left"><?=$form->field($documentForm , 'number')->textInput(['class'=>'pdf-control pdf-number'])?></div>

            </div>   </div><br>
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
                                'class'=>'pdf-control'
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
            </div>
        </div>
        <br>
        <div class="row">
            <div class="text-center">Стороны сделки</div>
            <div class="col-sm-6 text-center">
                <div class="col-xs-12">
                    «Продавец» :
                    <br>
                    ИНН
                </div>
                <div class="col-xs-12">
                    <?=$form->field($documentForm , 'inn_executor')->textInput(['class'=>'pdf-control'])?>
                </div>


            </div>
            <div class="col-sm-6 text-center">
                <div class="col-xs-12">
                    «Покупатель» :<br>
                    ИНН
                </div>
                <div class="col-xs-12">
                    <?=$form->field($documentForm , 'inn_customer')->textInput(['class'=>'pdf-control'])?>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-12 text-center" >Товар:</div>
            <br>
            <br>
            <div class="col-xs-6 text-right" >Наименование</div>
            <div class="col-xs-6 text-left" ><?=$form->field($documentForm , 'good_name')->textInput(['class'=>'pdf-control'])?></div>
            <div class="col-xs-6 text-right" >Ассортимент</div>
            <div class="col-xs-6 text-left" ><?=$form->field($documentForm , 'assort')->textInput(['class'=>'pdf-control'])?></div>
            <div class="col-xs-6 text-right" >Количество</div>
            <div class="col-xs-6 text-left" ><?=$form->field($documentForm , 'count')->textInput(['class'=>'pdf-control'])?></div>
            <div class="col-xs-6 text-right" >Единицы измерения</div>
            <div class="col-xs-6 text-left" >          <?php $items = ArrayHelper::map($measure,'id','full_name');

                echo $form->field($documentForm, 'unit')->dropDownList($items,['class'=>'pdf-control'])?>
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-6 text-center" >Тара :</div>
            <div class="col-xs-6 text-center" ><?=$form->field($documentForm, 'tara')->dropDownList(DocumentForm::listTara())?></div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-6 text-center" >Страхование Товара :</div>
            <div class="col-xs-6 text-center" ><?=$form->field($documentForm, 'insurance_goods')->dropDownList(DocumentForm::listInsuranceGoods())?></div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-6 text-center" >Передача товара :</div>
            <div class="col-xs-6 text-center" ><?=$form->field($documentForm, 'transfer_goods')->dropDownList(DocumentForm::listTransferGoods())?></div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-6 text-center" >Место передачи товара :</div>
            <div class="col-xs-6 text-center" ><?=$form->field($documentForm, 'transfer_place')->dropDownList(DocumentForm::listTransferPlace())?></div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-6 text-center" >Доставка товара и расходы :</div>
            <div class="col-xs-6 text-center" ><?=$form->field($documentForm, 'delivery_goods_costs')->dropDownList(DocumentForm::listTransferGoods())?></div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-6 text-center" >Сроки поставки :</div>
            <div class="col-xs-6 text-center" ><?=$form->field($documentForm, 'delivery_time')->dropDownList(DocumentForm::listDeliveryTime())?></div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-6 text-center" >Налог в цене товара :</div>
            <div class="col-xs-6 text-center" ><?=$form->field($documentForm, 'VAT')->dropDownList(DocumentForm::listVAT())?></div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-6 text-center" >Порядок оплаты:</div>
            <div class="col-xs-6 text-center" ><?=$form->field($documentForm, 'delivery_payment_order')->dropDownList(DocumentForm::listDeliveryPaymentOrder())?></div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center" >Cроки действия договора:</div>
            <br>
            <br>
            <div class="col-xs-6 text-right" > Дата окончания  –  </div>
            <div class="col-xs-6 text-left" > <?= $form->field($documentForm, 'date_service_delivery_end')->widget(
                    DatePicker::className(), [
                    'value' => '12/31/2010',
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd.mm.yyyy',

                    ],
                    'options'=>[
                        'class'=>'pdf-control pdf-number'
                    ]
                ]);?>  </div>

        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create Document'), ['class' =>  'btn create-btn btn-md btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>

    </div>




    <?php ActiveForm::end()?>
</div>
