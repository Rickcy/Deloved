<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 01.09.17
 * Time: 7:27
 */

use common\models\PaymentMethod;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

/**
 * @var $tariff \common\models\Tariffs
 * @var $request \common\models\PaymentRequest
 * @var $account \common\models\Account
 */
$this->title = Yii::t('app', 'Billing');
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;
?>
<div class="billing-index">
<?php if (\common\models\User::checkRole(['ROLE_USER']) && $account->profile->chargeStatus == 1):?>

    <div align="center">
        <div class="panel panel-success" style="width:80% "align="center">
            <div class="panel-heading">
                <b style="color: white" class="ft">Расширенная подписка до <?=Yii::$app->formatter->asDatetime($account->profile->chargeTill, "php:d.m.Y");?></b>
            </div>
        </div>

    </div>
<?php endif;?>
    <div align="center">
        <div class="panel panel-primary" style="width:80% "align="center">
            <div class="panel-heading">
                <b class="ft">Продление расширешенной подписки</b>
            </div>

            <div class="panel-body table-responsive">
                <?php $form = ActiveForm::begin(['id' => 'form-bill','action'=>'/admin/billing/income','options'=>['target'=>'_blank']]); ?>

                    <table id="tariff_table" class="table table-hover">

                        <thead>
                        <tr style="border-bottom: 3px solid rgba(176, 208, 83, 0.24)">
                            <td><!--Наименование тарифа--></td>
                            <td align="center" class="ft"><b>Цена за месяц, руб.</b></td>
                            <td align="center" class="ft"><b>Цена тарифа, руб.</b></td>
                            <td align="center" class="ft"><b>Экономия, руб.</b></td>
                            <td><!--Чекбокс--></td></tr>
                        </thead>

                        <tbody>
                        <?php foreach ($tariffs as $tariff):?>
                            <tr>
                                <td align="right">
                                    <b class="fr"><?=$tariff->name?></b>
                                </td>

                                <td align="center">
                                   <?=($tariff->price - ($tariff->price/100*$tariff->sale))/$tariff->months?>
                                </td>

                                <td align="center">
                                    <?=$tariff->price - ($tariff->price/100*$tariff->sale)?>

                                </td>

                                <td align="center">
                                    <?=$tariff->price/100*$tariff->sale?>
                                </td>
                                <td align="center">
                                    <div class="check-box"><input required type="radio" name="tariff" data-amount="<?=$tariff->price - ($tariff->price/100*$tariff->sale)?>" value="<?=$tariff->id?>"/></div>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                    <?=$form->field($model, 'tariff')->textInput(['class'=>'form-control','id'=>'amount','readonly'=>'readonly',' style'=>'display: inline-block; width: 90px; text-align: center'])->label('Cумма:') ?>

                    <?php $items = ArrayHelper::map($methods,'id','name');

                    echo $form->field($model, 'method')->dropDownList($items,['prompt'=>'Выбирите метод','id'=>'selectMethod','class'=>'form-control','style'=>'display: inline-block; width: 220px'])->label('Способ оплаты:')?>

                    <?= Html::submitButton(Yii::t('app', 'Оплатить'), ['class' => 'btn btn-md btn-primary','style'=>'margin-left: 20px']) ?>

                    <?php ActiveForm::end()?>

                <script>

                    $('#selectMethod').change(function () {
                      $('#method-pay').val($(this).val());
                    });

                    $("#tariff_table input[name='tariff']").click(function(){
                        var amount = $('input:radio[name=tariff]:checked').data("amount")
                        $('#amount').val(amount);
                    });

                </script>

            </div>
        </div>


        <br>


        <div class="panel panel-primary" style="width:80% "align="center">

            <div class="panel-heading">
                <b class="ft">История платежей</b>
            </div>

            <div id="historyGrid" class="panel-body table-responsive">
                <table class="table table-hover">
                    <thead style="border-bottom: 3px solid rgba(176, 208, 83, 0.24)">
                    <tr>
                        <th class="ft">Номер счета</th>              <!-- Номер счета -->

                        <th class="ft">
                                Способ оплаты</th>
                        <!--th>Способ оплаты</th-->            <!-- Способ оплаты -->

                        <th class="ft">
                                Дата оплаты</th>
                        <!--<th>Дата создания</th-->            <!-- Дата создания -->

                        <th class="ft">
                                Сумма</th>
                        <!--th>Сумма</th-->                    <!-- Сумма -->

                        <th class="ft">
                                Валюта</th>
                        <!--th>Валюта</th-->

                        <th class="ft">
                                Статус</th>
                        <!--th>Статус</th-->                   <!-- Статус -->
                        <th class="ft">Детализация</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php if (count($requests) > 0):?>
                    <?php foreach ($requests as $request):?>
                        <tr>
                            <td><?=$request->id?></td>
                            <td><?=PaymentMethod::findOne($request->method_id)->name?></td>
                            <td><?=(new DateTime($request->date_created))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i:s')?></td>
                            <td><?=$request->value?></td>
                            <td>Руб</td>
                            <td><?=$request::getStatus($request->status)?>
                            <td>
                                <?php if (PaymentMethod::findOne($request->method_id)->code != 'INCOME_MANUAL' ):?>
                                    <a href="javascript:void(0)"  onclick="checkRequestStatus('<?=$request->id?>')">Подробнее</a>
                                <?php else:?>
                                    <a target="_blank" href="/admin/billing/bill?id=<?=$request->id?>">Подробнее</a>
                                <?php endif;?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script>
        function checkRequestStatus(requestId) {
            $('#modalDetails > div').remove()
            $.ajax({
                type:'GET',
                url:'/admin/billing/check-request-status?requestId='+requestId,
                dataType: 'json',
                success:function(data) {
                    $('#modalDetails').append(data);
                    $('#myModalOption').modal();
                },
                error:function(){
                    console.log('Error')
                }});
            return false
        }
    </script>
</div>
<div id="modalDetails"></div>
