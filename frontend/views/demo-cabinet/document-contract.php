<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 31.01.18
 * Time: 3:28
 */
?>
<div class="delivery-contract" xmlns:g="http://www.w3.org/1999/xhtml">
    <div id="w0" class="form-horizontal" action="/admin/document/delivery-contract" method="post">

            <div class="row">

                <div class="text-center">
                    <div class="col-xs-6 text-right">ДОГОВОР ПОСТАВКИ №   </div>
                    <div class="col-xs-6 text-left"><div class="form-group field-documentform-number required">
                            <input id="documentform-number" class="pdf-control pdf-number" name="DocumentForm[number]" type="text"><div><p class="help-block help-block-error"></p></div>
                        </div></div>

                </div>   </div><br>
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
                        «Продавец» :
                        <br>
                        ИНН
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group field-documentform-inn_executor required">
                            <input id="documentform-inn_executor" class="pdf-control" name="DocumentForm[inn_executor]" type="text"><div><p class="help-block help-block-error"></p></div>
                        </div>                </div>
                    <button type="button" class="btn btn-success my-data my-data-ispol">Заполнить моими данными</button>



                </div>
                <div class="col-sm-6 text-center">
                    <div class="col-xs-12">
                        «Покупатель» :<br>
                        ИНН
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group field-documentform-inn_customer required">
                            <input id="documentform-inn_customer" class="pdf-control" name="DocumentForm[inn_customer]" type="text"><div><p class="help-block help-block-error"></p></div>
                        </div>                </div>
                    <button type="button" class="btn btn-success my-data my-data-zakaz">Заполнить моими данными</button>

                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12 text-center">Товар:</div>
                <br>
                <br>
                <div class="col-xs-6 text-right">Наименование</div>
                <div class="col-xs-6 text-left"><div class="form-group field-documentform-good_name">
                        <input id="documentform-good_name" class="pdf-control" name="DocumentForm[good_name]" type="text"><div><p class="help-block help-block-error"></p></div>
                    </div></div>
                <div class="col-xs-6 text-right">Ассортимент</div>
                <div class="col-xs-6 text-left"><div class="form-group field-documentform-assort">
                        <input id="documentform-assort" class="pdf-control" name="DocumentForm[assort]" type="text"><div><p class="help-block help-block-error"></p></div>
                    </div></div>
                <div class="col-xs-6 text-right">Количество</div>
                <div class="col-xs-6 text-left"><div class="form-group field-documentform-count">
                        <input id="documentform-count" class="pdf-control" name="DocumentForm[count]" type="text"><div><p class="help-block help-block-error"></p></div>
                    </div></div>
                <div class="col-xs-6 text-right">Единицы измерения</div>
                <div class="col-xs-6 text-left">          <div class="form-group field-documentform-unit required">
                        <select id="documentform-unit" class="pdf-control" name="DocumentForm[unit]">
                            <option value="1">Единица</option>
                            <option value="3">Киловатт</option>
                            <option value="4">Лист печатный</option>
                            <option value="5">Лист учетно-издательский</option>
                            <option value="6">Литр</option>
                            <option value="7">Мегабайт</option>
                            <option value="8">Мегаватт</option>
                            <option value="9">Метр</option>
                            <option value="10">Метр погонный</option>
                            <option value="11">Миллиграмм</option>
                            <option value="12">Миллилитр</option>
                            <option value="13">Миллиметр</option>
                            <option value="14">Набор</option>
                            <option value="15">Рулон</option>
                            <option value="16">Сантиметр</option>
                            <option value="17">Сота</option>
                            <option value="18">Тонна</option>
                            <option value="19">Упаковка</option>
                            <option value="20">Центнер</option>
                            <option value="21">Штука</option>
                            <option value="22">Экземпляр</option>
                            <option value="23">Ящик</option>
                            <option value="24">Грамм</option>
                            <option value="25">Байт</option>
                            <option value="26">Банка</option>
                            <option value="27">Бит</option>
                            <option value="28">Блок</option>
                            <option value="29">Бобина</option>
                            <option value="30">Брутто-регистровая тонна</option>
                            <option value="31">Бутылка</option>
                            <option value="32">Ватт</option>
                            <option value="33">Гектар</option>
                            <option value="34">Доза</option>
                            <option value="35">Изделие</option>
                            <option value="36">Квадратный метр</option>
                            <option value="37">Кега</option>
                            <option value="38">Ампула</option>
                            <option value="39">Килограмм</option>
                            <option value="40">Километр</option>
                            <option value="41">Комплект</option>
                            <option value="42">Коробка</option>
                            <option value="43">Кубический метр</option>
                            <option value="44">Лист</option>
                            <option value="45">Лист авторский</option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div>            </div>

            </div>
            <br>
            <div class="row">
                <div class="col-xs-6 text-center">Тара :</div>
                <div class="col-xs-6 text-center"><div class="form-group field-documentform-tara">
                        <select id="documentform-tara" class="form-control" name="DocumentForm[tara]">
                            <option value="0">Тара и упаковка не возвращаются.</option>
                            <option value="1">Покупатель возвращает оборотную тару.</option>
                            <option value="2">Покупатель возвращает тару самовывозом поставщика.</option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div></div>

            </div>
            <br>
            <div class="row">
                <div class="col-xs-6 text-center">Страхование Товара :</div>
                <div class="col-xs-6 text-center"><div class="form-group field-documentform-insurance_goods">
                        <select id="documentform-insurance_goods" class="form-control" name="DocumentForm[insurance_goods]">
                            <option value="0">Товар не страхуется </option>
                            <option value="1">Поставщик страхует товар, выгодоприобретателем по договору страхования является Поставщик.</option>
                            <option value="2">Поставщик страхует товар, выгодоприобретателем по договору страхования является Покупатель.</option>
                            <option value="3">Покупатель страхует товар, выгодоприобретателем по договору страхования является Поставщик.</option>
                            <option value="4">Покупатель страхует товар, выгодоприобретателем по договору страхования является Покупатель.</option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div></div>

            </div>
            <br>
            <div class="row">
                <div class="col-xs-6 text-center">Передача товара :</div>
                <div class="col-xs-6 text-center"><div class="form-group field-documentform-transfer_goods">
                        <select id="documentform-transfer_goods" class="form-control" name="DocumentForm[transfer_goods]">
                            <option value="0">Товар передается по адресу нахождения Покупателя.</option>
                            <option value="1">Товар передается по адресу нахождения Поставщика.</option>
                            <option value="2">Товар по отдельному адресу. </option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div></div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-6 text-center">Место передачи товара :</div>
                <div class="col-xs-6 text-center"><div class="form-group field-documentform-transfer_place">
                        <select id="documentform-transfer_place" class="form-control" name="DocumentForm[transfer_place]">
                            <option value="0">Товар передается по адресу нахождения Покупателя </option>
                            <option value="1">Товар передается по адресу нахождения Поставщика</option>
                            <option value="2">Товар по отдельному адресу. </option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div></div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-6 text-center">Доставка товара и расходы :</div>
                <div class="col-xs-6 text-center"><div class="form-group field-documentform-delivery_goods_costs">
                        <select id="documentform-delivery_goods_costs" class="form-control" name="DocumentForm[delivery_goods_costs]">
                            <option value="0">Товар передается по адресу нахождения Покупателя.</option>
                            <option value="1">Товар передается по адресу нахождения Поставщика.</option>
                            <option value="2">Товар по отдельному адресу. </option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div></div>

            </div>
            <br>
            <div class="row">
                <div class="col-xs-6 text-center">Сроки поставки :</div>
                <div class="col-xs-6 text-center"><div class="form-group field-documentform-delivery_time">
                        <select id="documentform-delivery_time" class="form-control" name="DocumentForm[delivery_time]">
                            <option value="0">Покупатель проинформирует о партии товара и сроках поставки.</option>
                            <option value="1">Поставка равными партиями в течении всего срока действия договора.</option>
                            <option value="2">Поставка не позднее определенной даты.</option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div></div>

            </div>
            <br>
            <div class="row">
                <div class="col-xs-6 text-center">Налог в цене товара :</div>
                <div class="col-xs-6 text-center"><div class="form-group field-documentform-vat required">
                        <select id="documentform-vat" class="form-control" name="DocumentForm[VAT]">
                            <option value="0">Цена включает НДС 10%</option>
                            <option value="1">Цена включает НДС 18%</option>
                            <option value="2">Цена не включает НДС 10%</option>
                            <option value="3">Цена не включает НДС 18%</option>
                            <option value="4">Поставщик не является плательщиком НДС</option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div></div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-6 text-center">Порядок оплаты:</div>
                <div class="col-xs-6 text-center"><div class="form-group field-documentform-delivery_payment_order">
                        <select id="documentform-delivery_payment_order" class="form-control" name="DocumentForm[delivery_payment_order]">
                            <option value="0">Оплата до даты отгрузки.</option>
                            <option value="1">Оплата после отгрузки.</option>
                            <option value="2">Оплата частями в течение периода.</option>
                        </select><div><p class="help-block help-block-error"></p></div>
                    </div></div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-center">Cроки действия договора:</div>
                <br>
                <br>
                <div class="col-xs-6 text-right"> Дата окончания  –  </div>
                <div class="col-xs-6 text-left"> <div class="form-group field-documentform-date_service_delivery_end required">
                        <div id="documentform-date_service_delivery_end-kvdate" class="input-group date"><span class="input-group-addon kv-date-calendar" title="Выбрать дату"><i class="glyphicon glyphicon-calendar"></i></span><span class="input-group-addon kv-date-remove" title="Очистить поле"><i class="glyphicon glyphicon-remove"></i></span><input id="documentform-date_service_delivery_end" class="pdf-control pdf-number krajee-datepicker form-control" name="DocumentForm[date_service_delivery_end]" data-datepicker-source="documentform-date_service_delivery_end-kvdate" data-datepicker-type="2" data-krajee-kvdatepicker="kvDatepicker_1643d6f1" type="text"></div><div><p class="help-block help-block-error"></p></div>
                    </div>  </div>

            </div>
        </div>


        <div class="form-group">
            <button type="submit" class="btn create-btn btn-md btn-success">Создать документ</button>        <a class="btn create-btn btn-md btn-default" href="/demo-cabinet/document">Отмена</a>
        </div>




    </form></div>
