<?php
$this->title='Биллинг';
?>
<div class="billing-index">

    <div align="center">
        <div class="panel panel-success" style="width:80% " align="center">
            <div class="panel-heading">
                <b style="color: white" class="ft">Расширенная подписка до 23.05.2018</b>
            </div>
        </div>

    </div>
    <div align="center">
        <div class="panel panel-primary" style="width:80% " align="center">
            <div class="panel-heading">
                <b class="ft">Продление расширешенной подписки</b>
            </div>

            <div class="panel-body table-responsive">
                <div id="form-bill" >
                    <table id="tariff_table" class="table table-hover">

                        <thead>
                        <tr style="border-bottom: 3px solid rgba(176, 208, 83, 0.24)">
                            <td><!--Наименование тарифа--></td>
                            <td class="ft" align="center"><b>Цена за месяц, руб.</b></td>
                            <td class="ft" align="center"><b>Цена тарифа, руб.</b></td>
                            <td class="ft" align="center"><b>Экономия, руб.</b></td>
                            <td><!--Чекбокс--></td></tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td align="right">
                                <b class="fr">1 месяц</b>
                            </td>

                            <td align="center">
                                2000                                </td>

                            <td align="center">
                                2000
                            </td>

                            <td align="center">
                                0                                </td>
                            <td align="center">
                                <div class="check-box"><input required="" name="tariff" data-amount="2000" value="1" type="radio"></div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <b class="fr">3 месяца</b>
                            </td>

                            <td align="center">
                                1900                                </td>

                            <td align="center">
                                5700
                            </td>

                            <td align="center">
                                300                                </td>
                            <td align="center">
                                <div class="check-box"><input required="" name="tariff" data-amount="5700" value="2" type="radio"></div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <b class="fr">6 месяцев</b>
                            </td>

                            <td align="center">
                                1860                                </td>

                            <td align="center">
                                11160
                            </td>

                            <td align="center">
                                840                                </td>
                            <td align="center">
                                <div class="check-box"><input required="" name="tariff" data-amount="11160" value="3" type="radio"></div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <b class="fr">12 месяцев</b>
                            </td>

                            <td align="center">
                                1800                                </td>

                            <td align="center">
                                21600
                            </td>

                            <td align="center">
                                2400                                </td>
                            <td align="center">
                                <div class="check-box"><input required="" name="tariff" data-amount="21600" value="4" type="radio"></div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="form-group field-amount required">
                        <label class="control-label" for="amount">Cумма:</label>
                        <input id="amount" class="form-control" name="BillingForm[tariff]" readonly="readonly" style="display: inline-block; width: 90px; text-align: center" type="text">

                        <p class="help-block help-block-error"></p>
                    </div>
                    <div class="form-group field-selectMethod required">
                        <label class="control-label" for="selectMethod">Способ оплаты:</label>
                        <select id="selectMethod" class="form-control" name="BillingForm[method]" style="display: inline-block; width: 220px">
                            <option value="">Выбирите метод</option>
                            <option value="1">Оплата по счету</option>
                            <option value="2">PayMaster</option>
                            <option value="3">Евросеть</option>
                            <option value="4">Альфа-Банк</option>
                            <option value="5">Банк Русский Стандарт</option>
                            <option value="6">Яндекс.Деньги</option>
                            <option value="7">WebMoney</option>
                            <option value="8">Контакт</option>
                        </select>

                        <p class="help-block help-block-error"></p>
                    </div>
                    <button type="submit" class="btn btn-md btn-primary" style="margin-left: 20px">Оплатить</button>
                </div>
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


        <div class="panel panel-primary" style="width:80% " align="center">

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
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
