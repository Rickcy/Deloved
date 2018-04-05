<?php
$this->title = 'Проверка контрагента';
?>
<div>
    <div class="col-xs-12" style="margin-bottom: 15px">
        <div class="row">

            <form id="checkAgentInfo" class="col-sm-12 text-left">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="company-data" disabled name="company-data" value="23242321322" placeholder="Введите ИНН контрагента">
                </div>
                <div class="col-sm-6">
                    <button style="margin-top: 5px" class="btn btn-success btn-md"  onclick="$('.data-info').show()"  type="button">Проверить</button>
                </div>
            </form>
        </div>

    </div>

    <div class="row data-info" style="display: none" >
        <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="#main" data-toggle="tab">Общие данные</a></li>
            <li><a href="#finans" data-toggle="tab">Финансовая отчетность</a></li>
            <li><a href="#sud" data-toggle="tab">Судебные дела</a></li>

        </ul>
        <div class="tab-content" style="margin-top: 15px">
            <div class="tab-pane active" id="main">








                <div class="col-xs-12 col-md-12">
                    <h2 class="f-s-16 f-w-400 m-b-15">
                        ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ "АЛДА" </h2>



                    <div class="m-t-5">
                        Статус:&nbsp;
                        <b>Действующее</b><br>
                        Дата регистрации:&nbsp;
                        <b>29.03.2013</b>
                    </div>


                    <div class="m-t-15">
                        <table>
                            <tbody><tr>
                                <td>
                                    ОГРН&nbsp;

                                </td>
                                <td>
                                    &nbsp;
                                    <span id="ogrn">1135476056605</span>&nbsp;&nbsp;&nbsp;
                                    присвоен: 29.03.2013                                            </td>
                            </tr>
                            <tr>
                                <td width="100">
                                    ИНН&nbsp;
                                </td>
                                <td>&nbsp;
                                    <span id="inn">5410776572</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    КПП&nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                    <span id="kpp">541001001</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ОКПО&nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                    <span id="okpo">23588473</span>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>


                    <div class="m-t-15">
                        <b>Юридический адрес:</b>&nbsp;
                        <br>
                        630027, Новосибирская обл, город Новосибирск, улица Тайгинская, 22/1, 22                                    <br>
                    </div>



                    <div class="m-t-15">
                        <b>Руководитель юридического лица</b>&nbsp;<br>
                        <small>Генеральный директор</small><br>
                        <span>Васькович Денис Викторович</span>
                        <br>
                        <table>
                            <tbody><tr>
                                <td width="100">ИНН&nbsp;</td>
                                <td>540230613057</td>
                            </tr>
                            <tr>
                                <td width="100"><small>действует с</small></td>
                                <td><small>2013-03-29</small></td>
                            </tr>
                            </tbody></table>
                    </div>


                    <div class="m-t-15">
                        <b>Учредители</b>&nbsp;<br>
                        <small>
                            Уставный капитал: 10000 руб.
                        </small><br>

                        <table class="hidden-print">
                            <tbody><tr>
                                <td width="50">100%</td>
                                <td>
                                    Васькович Денис Викторович                                                    <br>
                                    <small>
                                        10000 руб., 29.03.2013 , ИНН 540230613057</small>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>


                    <div class="m-t-15">
                    </div>


                    <div class="m-t-15">
                        <b>Основной вид деятельности:</b>&nbsp;<br>
                        47.1 Торговля розничная в неспециализированных магазинах                                    <br>
                        Дополнительные виды деятельности:
                        <a href="#" data-toggle="modal" data-target="#modal-okveds">
                            38 </a>
                    </div>




                    <div class="m-t-15">
                        <b>Налоговый орган</b>&nbsp;<br>
                        <small>
                            Инспекция Федеральной налоговой службы по Калининскому району г. Новосибирска<br>
                            Дата постановки на учет: 29.03.2013 </small>
                    </div>


                    <div class="m-t-15 m-b-15">
                        <b>Регистрация во внебюджетных фондах</b>
                        <table>
                            <thead class="text-left">
                            <tr>
                                <th width="70"><small>Фонд</small></th>
                                <th width="150"><small>Рег. номер</small></th>
                                <th width="100"><small>Дата регистрации</small></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    ПФР&nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                    <span id="pfr">064004090178</span>
                                </td>
                                <td>01.04.2013</td>
                            </tr>
                            <tr>
                                <td>
                                    ФСС&nbsp;
                                </td>
                                <td>
                                    &nbsp;
                                    <span id="fss">540302618654031</span>
                                </td>
                                <td>30.04.2013</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>



                </div>
                <div class="col-xs-12 col-md-12">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="well background-light-blue">
                                <p class="no-indent"><b>Связанные компании по руководителю<br>(аффилированность)</b></p>
                                <p class="no-indent">
                                    <small>Руководитель юридического лица (Генеральный директор)</small><br>
                                    <b>Васькович Денис Викторович, ИНН: 540230613057</b>
                                </p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="text-center" width="100">Название</th>
                                            <th class="text-center" width="100">ИНН</th>
                                            <th class="text-center" width="100">Активность</th>
                                            <th class="text-center" width="100">Дата регистрации</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center">ООО "АЛДА"</td>
                                            <td class="text-center"><a class="check-inn" check-inn="5410776572" href="javascript:void(0)">5410776572</a></td>
                                            <td class="text-center"> Действующее</td>
                                            <td class="text-center">29.03.2013</td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div> <br>
                            </div>
                        </div>




                        <!--            <div class="row">-->
                        <!--                <div class="well background-light-blue">-->
                        <!--                    <p class="no-indent"><b>Связанные компании ГРУППА КОМПАНИЙ "ЭЙДИНГ" (ООО) ИНН 2221121409<br>(аффилированность<a class="hidden-print" href="/lp/affiliation" data-toggle="tooltip" data-delay="1000" title="" data-original-title="Аффилированность – способность физического или юридического лица оказывать влияние на деятельность других юридических лиц или физических лиц, в рамках предпринимательской деятельности."><sup>?</sup></a>)</b></p>-->
                        <!--                    <div class="table-responsive">-->
                        <!--                        <table class="table">-->
                        <!--                            <thead>-->
                        <!--                            <tr>-->
                        <!--                                <th class="text-center">Учреждённые</th>-->
                        <!--                                <th class="text-center">Управляемые</th>-->
                        <!--                                <th class="text-center">Филиалы</th>-->
                        <!--                                <th class="text-center">Представительства</th>-->
                        <!--                            </tr>-->
                        <!--                            </thead>-->
                        <!--                            <tbody>-->
                        <!--                            <tr>-->
                        <!--                                <td class="text-center">-->
                        <!--                                    0 </td>-->
                        <!--                                <td class="text-center">-->
                        <!--                                    0</td>-->
                        <!--                                <td class="text-center">0</td>-->
                        <!--                                <td class="text-center">0</td>-->
                        <!--                            </tr>-->
                        <!--                            </tbody>-->
                        <!--                        </table>-->
                        <!--                    </div>-->
                        <!--                    <br>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <div class="row">
                            <div class="well background-light-blue">

                                <h4>Финансовая отчетность компании<br><small>на конец отчетного периода в рублях</small></h4>
                                <table class="table striped company-fin-info">
                                    <thead>
                                    <tr>
                                        <th>Период</th>
                                        <th>Выручка</th>
                                        <th>Прибыль (убыток)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>2016</td>
                                        <td>14147000</td>
                                        <td>39000</td>
                                    </tr>
                                    <tr>
                                        <td>2015</td>
                                        <td>14180000</td>
                                        <td>-198000</td>

                                    </tr>
                                    <tr>
                                        <td>2014</td>
                                        <td>16313000</td>
                                        <td>8000</td>
                                    </tr>
                                    <tr>
                                        <td>2013</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="/demo-cabinet/create?id=1" style="margin-left: 2rem;border-radius: 50px;padding: 11px 10px 11px 40px;width: 100%;min-width: 194px;color: white;font-weight: bold;margin-bottom: 5px;background: #94c43d url(/images/front/dea.png) no-repeat center left 10px;
    background-size: 20px;box-shadow: 0 0 5px #c5c5c5;">Предложить сделку</a>
            </div>
            <div class="tab-pane" id="finans">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="border-no" width="300"><h4>Бухгалтерский баланс</h4></th>
                                <th><a href="#">2016</a></th>
                                <th><a href="#">2015</a></th>
                                <th><a href="#">2014</a></th>
                                <th><a href="#">2013</a></th>
                                <th><a href="#">2012</a></th>
                            </tr>
                            <tr>
                                <th colspan="6" class="border-no">Актив</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="6"><b>I. ВНЕОБОРОТНЫЕ АКТИВЫ</b></td>
                            </tr>
                            <tr>
                                <td>Нематериальные активы</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Основные средства</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Доходные вложения в материальные ценности</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Финансовые вложения</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Отложенные налоговые активы</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Прочие внеоборотные активы</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>ИТОГО по разделу I</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td colspan="6"><b>II. ОБОРОТНЫЕ АКТИВЫ</b></td>
                            </tr>
                            <tr>
                                <td>Запасы</td>
                                <td>2141000</td>
                                <td>892000</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Налог на добавленную стоимость по приобретенным ценностям</td>
                                <td>10000</td>
                                <td>7000</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Дебиторская задолженность </td>
                                <td>7297000</td>
                                <td>4951000</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Финансовые вложения (за исключением денежных эквивалентов)</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Денежные средства и денежные эквиваленты</td>
                                <td>90000</td>
                                <td>51000</td>
                                <td>18000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Прочие оборотные активы</td>
                                <td>0</td>
                                <td>3000</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>ИТОГО по разделу II</td>
                                <td>9538000</td>
                                <td>5904000</td>
                                <td>18000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>БАЛАНС</td>
                                <td>9538000</td>
                                <td>5904000</td>
                                <td>18000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            </tbody>
                            <thead>
                            <tr>
                                <th colspan="6" class="border-no">Пассив</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="6"><b>III. КАПИТАЛ И РЕЗЕРВЫ</b></td>
                            </tr>
                            <tr>
                                <td>Уставный капитал (складочный капитал, уставный фонд, вклады товарищей)</td>
                                <td>10000</td>
                                <td>10000</td>
                                <td>10000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Собственные акции, выкупленные у акционеров</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Добавочный капитал (без переоценки)</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Резервный капитал</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Нераспределенная прибыль (непокрытый убыток)</td>
                                <td>-151000</td>
                                <td>-189000</td>
                                <td>8000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>ИТОГО по разделу III</td>
                                <td>-141000</td>
                                <td>-179000</td>
                                <td>18000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td colspan="6"><b>IV. ДОЛГОСРОЧНЫЕ ОБЯЗАТЕЛЬСТВА</b></td>
                            </tr>
                            <tr>
                                <td>Заемные средства</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Отложенные налоговые обязательства</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Прочие обязательства</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>ИТОГО по разделу IV</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td colspan="6"><b>V. КРАТКОСРОЧНЫЕ ОБЯЗАТЕЛЬСТВА</b></td>
                            </tr>
                            <tr>
                                <td>Заемные средства</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Кредиторская задолженность</td>
                                <td>9679000</td>
                                <td>6083000</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Доходы будущих периодов</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Прочие обязательства</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>ИТОГО по разделу V</td>
                                <td>9679000</td>
                                <td>6083000</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>БАЛАНС</td>
                                <td>9538000</td>
                                <td>5904000</td>
                                <td>18000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                        <br>
                        <br>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="border-no" width="300"><h4>Отчет о прибылях и убытках</h4></th>
                                <th><a href="#">2016</a></th>
                                <th><a href="#">2015</a></th>
                                <th><a href="#">2014</a></th>
                                <th><a href="#">2013</a></th>
                                <th><a href="#">2012</a></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="6"><b>Доходы и расходы по обычным видам деятельности</b></td>
                            </tr>
                            <tr>
                                <td>Выручка</td>
                                <td>14147000</td>
                                <td>14180000</td>
                                <td>16313000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Себестоимость продаж</td>
                                <td>13477000</td>
                                <td>13699000</td>
                                <td>16303000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Валовая прибыль (убыток)</td>
                                <td>670000</td>
                                <td>670000</td>
                                <td>481000</td>
                                <td>10000</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Коммерческие расходы</td>
                                <td>533000</td>
                                <td>461000</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Управленческие расходы</td>
                                <td>0</td>
                                <td>131000</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Прибыль (убыток) от продаж</td>
                                <td>137000</td>
                                <td>-111000</td>
                                <td>10000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td colspan="6"><b>Прочие доходы и расходы</b></td>
                            </tr>
                            <tr>
                                <td>Проценты к получению</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Проценты к уплате</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Доходы от участия в других организациях</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Прочие доходы</td>
                                <td>0</td>
                                <td>1000</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Прочие расходы</td>
                                <td>81000</td>
                                <td>74000</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Прибыль (убыток) до налогообложения</td>
                                <td>56000</td>
                                <td>-184000</td>
                                <td>10000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Изменение отложенных налоговых активов</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Изменение отложенных налоговых обязательств</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Текущий налог на прибыль</td>
                                <td>17000</td>
                                <td>14000</td>
                                <td>2000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Чистая прибыль (убыток)</td>
                                <td>39000</td>
                                <td>-198000</td>
                                <td>8000</td>
                                <td></td>
                                <td>-</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="sud">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Дело</th>
                            <th>Истец</th>
                            <th>Ответчик</th>
                            <th>Третье лицо</th>
                            <th>Иное лицо</th>
                            <th class="hidden-print">Подробнее</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td width="180">
                                А45-10367/2017<br>
                                <small>18.05.2017</small><br>
                                <small>Сумма иска:<br><b>1493543</b></small>
                            </td>
                            <td>ООО "Алда"<br>
                            </td>
                            <td>ООО "СИБИРЬТРАНССТРОЙ"<br>
                            </td>
                            <td></td>
                            <td></td>
                            <td class="hidden-print"><a href="#" class="look-deal" deal-id="D5671C4B-3392-4BB0-898D-A5006E7D253B">Cмотреть </a></td>
                        </tr>
                        <tr>
                            <td width="180">
                                А45-9204/2014<br>
                                <small>14.05.2014</small><br>
                                <small>Сумма иска:<br><b>64000</b></small>
                            </td>
                            <td>ООО "Алда"<br>
                            </td>
                            <td>ИП Черевко Владимир Ильич<br>
                            </td>
                            <td></td>
                            <td></td>
                            <td class="hidden-print"><a href="#" class="look-deal" deal-id="8B97B861-A07D-44FC-BC58-AE9B57F41722">Cмотреть </a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="modal-okveds" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content arbitration">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="i-times"></i></span></button>
                            <h4 class="modal-title" id="myModalLabel">Виды деятельности</h4>
                        </div>
                        <div class="modal-body text-left">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td width="250">Код ОКВЭД</td>

                                    <td width="250">Наименование ОКВЭД</td>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td width="250">45.1</td>

                                    <td width="250">Торговля автотранспортными средствами</td>

                                </tr>
                                <tr>
                                    <td width="250">45.20</td>

                                    <td width="250">Техническое обслуживание и ремонт автотранспортных средств</td>

                                </tr>
                                <tr>
                                    <td width="250">45.3</td>

                                    <td width="250">Торговля автомобильными деталями, узлами и принадлежностями</td>

                                </tr>
                                <tr>
                                    <td width="250">45.40</td>

                                    <td width="250">Торговля мотоциклами, их деталями, узлами и принадлежностями; техническое обслуживание и ремонт мотоциклов</td>

                                </tr>
                                <tr>
                                    <td width="250">46.1</td>

                                    <td width="250">Торговля оптовая за вознаграждение или на договорной основе</td>

                                </tr>
                                <tr>
                                    <td width="250">46.22</td>

                                    <td width="250">Торговля оптовая цветами и растениями</td>

                                </tr>
                                <tr>
                                    <td width="250">46.24</td>

                                    <td width="250">Торговля оптовая шкурами и кожей</td>

                                </tr>
                                <tr>
                                    <td width="250">46.3</td>

                                    <td width="250">Торговля оптовая пищевыми продуктами, напитками и табачными изделиями</td>

                                </tr>
                                <tr>
                                    <td width="250">46.4</td>

                                    <td width="250">Торговля оптовая непродовольственными потребительскими товарами</td>

                                </tr>
                                <tr>
                                    <td width="250">46.6</td>

                                    <td width="250">Торговля оптовая прочими машинами, оборудованием и принадлежностями</td>

                                </tr>
                                <tr>
                                    <td width="250">46.76</td>

                                    <td width="250">Торговля оптовая прочими промежуточными продуктами</td>

                                </tr>
                                <tr>
                                    <td width="250">46.90</td>

                                    <td width="250">Торговля оптовая неспециализированная</td>

                                </tr>
                                <tr>
                                    <td width="250">47.2</td>

                                    <td width="250">Торговля розничная пищевыми продуктами, напитками и табачными изделиями в специализированных магазинах</td>

                                </tr>
                                <tr>
                                    <td width="250">47.5</td>

                                    <td width="250">Торговля розничная прочими бытовыми изделиями в специализированных магазинах</td>

                                </tr>
                                <tr>
                                    <td width="250">47.75</td>

                                    <td width="250">Торговля розничная косметическими и товарами личной гигиены в специализированных магазинах</td>

                                </tr>
                                <tr>
                                    <td width="250">47.79</td>

                                    <td width="250">Торговля розничная бывшими в употреблении товарами в магазинах</td>

                                </tr>
                                <tr>
                                    <td width="250">47.9</td>

                                    <td width="250">Торговля розничная вне магазинов, палаток, рынков</td>

                                </tr>
                                <tr>
                                    <td width="250">60.10</td>

                                    <td width="250">Деятельность в области радиовещания</td>

                                </tr>
                                <tr>
                                    <td width="250">60.20</td>

                                    <td width="250">Деятельность в области телевизионного вещания</td>

                                </tr>
                                <tr>
                                    <td width="250">63.91</td>

                                    <td width="250">Деятельность информационных агентств</td>

                                </tr>
                                <tr>
                                    <td width="250">68.1</td>

                                    <td width="250">Покупка и продажа собственного недвижимого имущества</td>

                                </tr>
                                <tr>
                                    <td width="250">68.20</td>

                                    <td width="250">Аренда и управление собственным или арендованным недвижимым имуществом</td>

                                </tr>
                                <tr>
                                    <td width="250">68.3</td>

                                    <td width="250">Операции с недвижимым имуществом за вознаграждение или на договорной основе</td>

                                </tr>
                                <tr>
                                    <td width="250">70.10.1</td>

                                    <td width="250">Деятельность по управлению финансово-промышленными группами</td>

                                </tr>
                                <tr>
                                    <td width="250">70.10.2</td>

                                    <td width="250">Деятельность по управлению холдинг-компаниями</td>

                                </tr>
                                <tr>
                                    <td width="250">70.22</td>

                                    <td width="250">Консультирование по вопросам коммерческой деятельности и управления</td>

                                </tr>
                                <tr>
                                    <td width="250">73.11</td>

                                    <td width="250">Деятельность рекламных агентств</td>

                                </tr>
                                <tr>
                                    <td width="250">73.20</td>

                                    <td width="250">Исследование конъюнктуры рынка и изучение общественного мнения</td>

                                </tr>
                                <tr>
                                    <td width="250">74.20</td>

                                    <td width="250">Деятельность в области фотографии</td>

                                </tr>
                                <tr>
                                    <td width="250">74.30</td>

                                    <td width="250">Деятельность по письменному и устному переводу</td>

                                </tr>
                                <tr>
                                    <td width="250">78.10</td>

                                    <td width="250">Деятельность агентств по подбору персонала</td>

                                </tr>
                                <tr>
                                    <td width="250">81.22</td>

                                    <td width="250">Деятельность по чистке и уборке жилых зданий и нежилых помещений прочая</td>

                                </tr>
                                <tr>
                                    <td width="250">81.29.9</td>

                                    <td width="250">Деятельность по чистке и уборке прочая, не включенная в другие группировки</td>

                                </tr>
                                <tr>
                                    <td width="250">82.92</td>

                                    <td width="250">Деятельность по упаковыванию товаров</td>

                                </tr>
                                <tr>
                                    <td width="250">93.2</td>

                                    <td width="250">Деятельность в области отдыха и развлечений</td>

                                </tr>
                                <tr>
                                    <td width="250">96.02</td>

                                    <td width="250">Предоставление услуг парикмахерскими и салонами красоты</td>

                                </tr>
                                <tr>
                                    <td width="250">96.04</td>

                                    <td width="250">Деятельность физкультурно- оздоровительная</td>

                                </tr>
                                <tr>
                                    <td width="250">96.09</td>

                                    <td width="250">Предоставление прочих персональных услуг, не включенных в другие группировки</td>

                                </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
