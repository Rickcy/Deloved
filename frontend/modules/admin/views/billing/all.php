<?php
/**
 * @var $request \common\models\PaymentRequest
 */

use common\models\PaymentMethod;
use yii\bootstrap\Html;

$this->title = Yii::t('app', 'Billing');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="bill-all">
    <h3><?= Html::encode($this->title) ?></h3>
            <table class="table table-hover">
                <thead style="border-bottom: 3px solid rgba(176, 208, 83, 0.24)">
                <tr>
                    <th class="ft">Номер счета</th>              <!-- Номер счета -->
                    <th class="ft">Название предприятия</th>

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
                            <td><?=$request->account->brand_name?></td>
                            <td><?=PaymentMethod::findOne($request->method_id)->name?></td>
                            <td><?=$request->date_created?></td>
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
                <?php endif;?>
                </tbody>
            </table>

</div>
<div id="modalDetails"></div>

