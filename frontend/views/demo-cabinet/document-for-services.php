<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 31.01.18
 * Time: 3:28
 */
?>
<div class="contract-for-services" xmlns:g="http://www.w3.org/1999/xhtml">
    <div id="w0" class="form-horizontal" >
            <div class="row">

                <div class="text-center">
                    <div class="col-xs-6 text-right">ДОГОВОР НА ОКАЗАНИЕ УСЛУГ №   </div>
                    <div class="col-xs-6 text-left"><div class="form-group field-documentform-number required">
                            <input id="documentform-number" class="pdf-control pdf-number" name="DocumentForm[number]" type="text"><div><p class="help-block help-block-error"></p></div>
                        </div></div>

                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-6 text-center">
                    <div class="row">
                        <div class="col-xs-12">
                            Место подписания договора :
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group field-documentform-place_signing required">
                                <input id="documentform-place_signing" class="pdf-control ui-autocomplete-input" name="DocumentForm[place_signing]" value="Барнаул" autocomplete="off" type="text"><div><p class="help-block help-block-error"></p></div>
                            </div>                    </div>


                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="row">
                        <div class="col-xs-12">
                            Дата подписания договора
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group field-documentform-date_signing required">
                                <div id="documentform-date_signing-kvdate" class="input-group date"><span class="input-group-addon kv-date-calendar" title="Выбрать дату"><i class="glyphicon glyphicon-calendar"></i></span><span class="input-group-addon kv-date-remove" title="Очистить поле"><i class="glyphicon glyphicon-remove"></i></span><input id="documentform-date_signing" class="pdf-control pdf-number krajee-datepicker form-control" name="DocumentForm[date_signing]" value="30.01.2018" data-datepicker-source="documentform-date_signing-kvdate" data-datepicker-type="2" data-krajee-kvdatepicker="kvDatepicker_1643d6f1" type="text"></div><div><p class="help-block help-block-error"></p></div>
                            </div>                    </div>


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
                        <div class="form-group field-documentform-inn_executor required">
                            <input id="documentform-inn_executor" class="pdf-control inn_executor" name="DocumentForm[inn_executor]" type="text"><div><p class="help-block help-block-error"></p></div>
                        </div>                </div>
                    <button type="button" class="btn btn-success my-data my-data-ispol">Заполнить моими данными</button>



                </div>
                <div class="col-sm-6 text-center">
                    <div class="col-xs-12">
                        «Заказчик» :<br>
                        ИНН
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group field-documentform-inn_customer required">
                            <input id="documentform-inn_customer" class="pdf-control inn_customer" name="DocumentForm[inn_customer]" type="text"><div><p class="help-block help-block-error"></p></div>
                        </div>                </div>
                    <button type="button" class="btn btn-success my-data my-data-zakaz">Заполнить моими данными</button>

                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-xs-12 text-center">Перечень услуг :</div>
                <div class="col-xs-12">
                    <div class="form-group field-documentform-service_list required">
                        <textarea id="documentform-service_list" class="pdf-control" name="DocumentForm[service_list]" rows="2"></textarea><div><p class="help-block help-block-error"></p></div>
                    </div>            </div>
                <br><br>
                <div class="col-xs-12 text-center">Привлечение соисполнителей:</div>
                <div class="col-xs-12 text-center"><div class="form-group field-documentform-attraction_co_executors required">
                        <select id="documentform-attraction_co_executors" class="form-control" name="DocumentForm[attraction_co_executors]">
                            <option value="0">Соисполнители не привлекаются.</option>
                            <option value="1">Соисполнитель привлекается с согласия Заказчика.</option>
                            <option value="2">Участие соисполнителя на усмотрения Исполнителя.</option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div></div>



                <br>
                <div class="col-xs-12 text-center">Cроки оказания услуг:</div>
                <div class="row">
                    <div class="col-xs-4 text-right">
                        Дата начала  –
                    </div>
                    <div class="col-xs-4 text-left">
                        <div class="form-group field-documentform-date_service_delivery_begin required">
                            <div id="documentform-date_service_delivery_begin-kvdate" class="input-group date"><span class="input-group-addon kv-date-calendar" title="Выбрать дату"><i class="glyphicon glyphicon-calendar"></i></span><span class="input-group-addon kv-date-remove" title="Очистить поле"><i class="glyphicon glyphicon-remove"></i></span><input id="documentform-date_service_delivery_begin" class="krajee-datepicker form-control" name="DocumentForm[date_service_delivery_begin]" data-datepicker-source="documentform-date_service_delivery_begin-kvdate" data-datepicker-type="2" data-krajee-kvdatepicker="kvDatepicker_1643d6f1" type="text"></div><div><p class="help-block help-block-error"></p></div>
                        </div>            </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 text-right">
                        Дата окончания  –
                    </div>

                    <div class="col-xs-4 text-left">
                        <div class="form-group field-documentform-date_service_delivery_end required">
                            <div id="documentform-date_service_delivery_end-kvdate" class="input-group date"><span class="input-group-addon kv-date-calendar" title="Выбрать дату"><i class="glyphicon glyphicon-calendar"></i></span><span class="input-group-addon kv-date-remove" title="Очистить поле"><i class="glyphicon glyphicon-remove"></i></span><input id="documentform-date_service_delivery_end" class="pdf-control pdf-number krajee-datepicker form-control" name="DocumentForm[date_service_delivery_end]" data-datepicker-source="documentform-date_service_delivery_end-kvdate" data-datepicker-type="2" data-krajee-kvdatepicker="kvDatepicker_1643d6f1" type="text"></div><div><p class="help-block help-block-error"></p></div>
                        </div>            </div>
                </div>

                <br>
                <div class="col-xs-12 text-center">Место оказания Услуг :</div>

                <div class="col-xs-12 text-center">
                    <div class="form-group field-documentform-location_services required">
                        <input id="documentform-location_services" class="pdf-control ui-autocomplete-input" name="DocumentForm[location_services]" autocomplete="off" type="text"><div><p class="help-block help-block-error"></p></div>
                    </div>            </div>
            </div>
            <br>

            <div class="row">
                <div class="col-xs-12 text-center"> Компенсация расходов Исполнителя :</div>
                <div class="col-xs-12 text-center"><div class="form-group field-documentform-compensation_expenses required">
                        <select id="documentform-compensation_expenses" class="form-control" name="DocumentForm[compensation_expenses]">
                            <option value="0">Заказчик возместит расходы Исполнителя.</option>
                            <option value="1">Заказчик возместит предварительно согласованные расходы.</option>
                            <option value="2">Заказчик не возмещает расходы.</option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div></div>



            </div>
            <br>

            <div class="row">
                <div class="col-xs-12 text-center">  Стоимость  Услуг :</div>
                <br><br>
                <div class="col-xs-6 text-right"> Стоимость составляет</div>
                <div class="col-xs-6 text-left">
                    <div class="form-group field-documentform-cost required">
                        <input id="documentform-cost" class="pdf-control" name="DocumentForm[cost]" type="text"><div><p class="help-block help-block-error"></p></div>
                    </div>
                </div>



                <div class="col-xs-12 text-center">НДС :</div>
                <div class="col-xs-12 text-center"><div class="form-group field-documentform-vat required">
                        <select id="documentform-vat" class="form-control" name="DocumentForm[VAT]">
                            <option value="0">Цена включает НДС 10%</option>
                            <option value="1">Цена включает НДС 18%</option>
                            <option value="2">Цена не включает НДС 10%</option>
                            <option value="3">Цена не включает НДС 18%</option>
                            <option value="4">Поставщик не является плательщиком НДС</option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div></div>

                <div class="col-xs-12 text-center">Порядок оплаты:</div>
                <div class="col-xs-12 text-center"><div class="form-group field-documentform-payment_order required">
                        <select id="documentform-payment_order" class="form-control" name="DocumentForm[payment_order]">
                            <option value="0">100% предварительная оплата.</option>
                            <option value="1">Оплата после получения исполнения.</option>
                            <option value="2">Частичная предоплата и последующая оплата.</option>
                            <option value="3">Оплата частями в течение периода.</option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div></div>

            </div>
            <br>
            <div class="row">
                <div class="col-xs-12 text-center"> Ответственность Сторон:</div>
                <div class="col-xs-12 "><div class="form-group field-documentform-responsibility required">
                        <input name="DocumentForm[responsibility]" value="" type="hidden"><div id="documentform-responsibility"><div class="checkbox"><label><input name="DocumentForm[responsibility][]" value="0" type="checkbox"> Общая ответственность сторон, предусмотренная законом.</label></div>
                            <div class="checkbox"><label><input name="DocumentForm[responsibility][]" value="1" type="checkbox"> Пеня за нарушение сроков Исполнителем.</label></div>
                            <div class="checkbox"><label><input name="DocumentForm[responsibility][]" value="2" type="checkbox"> Пеня за нарушение сроков оплаты Заказчиком</label></div>
                            <div class="checkbox"><label><input name="DocumentForm[responsibility][]" value="3" type="checkbox"> Штраф Заказчику за нарушение сроков передачи документов и информации.</label></div>
                            <div class="checkbox"><label><input name="DocumentForm[responsibility][]" value="4" type="checkbox"> Штраф Исполнителю за нарушение сроков передачи документов и информации.</label></div>
                            <div class="checkbox"><label><input name="DocumentForm[responsibility][]" value="5" type="checkbox"> Исполнитель несет ответственность за сохранность документов</label></div></div><div><p class="help-block help-block-error"></p></div>
                    </div></div>
            </div>
            <br>

        </div>


        <div class="form-group">
            <button type="submit" class="btn create-btn btn-md btn-success">Создать документ</button>        <a class="btn create-btn btn-md btn-default" href="/demo-cabinet/document">Отмена</a>
        </div>




    </div></div>
