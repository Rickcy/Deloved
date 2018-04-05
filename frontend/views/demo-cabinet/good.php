<?php
$this->title = 'Редактировать товар';
?>
<div class="goods-create">

    <h1 class="text-center">Редактировать товар</h1>

    <div class="goods-create">

        <div id="w0" class="form-horizontal" enctype="multipart/form-data">

            <div class="form-group field-goods-name required">
                <div class="col-sm-3 control-label"><label class="control-label" for="goods-name">Название</label></div><div class="col-sm-7"><input id="goods-name" class="form-control" value="Электротранзистор" name="Goods[name]" maxlength="255" type="text"></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>
            <div class="form-group field-goods-model">
                <div class="col-sm-3 control-label"><label class="control-label" for="goods-model">Спецификация</label></div><div class="col-sm-7"><input id="goods-model" value="АП.39 -Т" class="form-control" name="Goods[model]" maxlength="255" type="text"></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>
            <div class="col-sm-12 col-sm-offset-0">
                <div class="col-sm-7">
                    <div class="form-group field-goods-price required">
                        <div class="col-sm-5 control-label"><label class="control-label" for="goods-price">Цена</label></div><div class="col-sm-7"><input value="45 000" id="goods-price" class="form-control" name="Goods[price]" type="text"></div><div class="col-sm-7 col-sm-offset-5"><p class="help-block help-block-error"></p></div>
                    </div>            </div>
                <div class="col-sm-4">
                    <div class="form-group field-goods-currency_id required">
                        <div class="col-sm-1"></div><div class="col-sm-8"><select id="goods-currency_id" class="form-control" name="Goods[currency_id]">
                                <option value="2"> $</option>
                                <option value="1"> Руб</option>
                            </select></div><div class="col-sm-9 col-sm-offset-1"><p class="help-block help-block-error"></p></div>
                    </div>            </div>

            </div>


            <div class="form-group field-goods-measure_id required">
                <div class="col-sm-3 control-label"><label class="control-label" for="goods-measure_id">Единицы измерения</label></div><div class="col-sm-7"><select id="goods-measure_id" class="form-control" name="Goods[measure_id]">
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
                    </select></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>

            <div class="form-group field-goods-description">
                <div class="col-sm-3 control-label"><label class="control-label" for="goods-description">Описание</label></div><div class="col-sm-7"><textarea id="goods-description" class="form-control" name="Goods[description]" rows="5"></textarea></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>



            <div class="form-group field-goods-availability required">
                <div class="col-sm-3 control-label"><label class="control-label">Доступность</label></div><div class="col-sm-7"><div id="goods-availability" class="btn-group" value="1" data-toggle="buttons"><label class="btn btn-default active"><input name="Goods[availability]" value="1" checked="" type="radio">Есть в наличии</label>
                        <label class="btn btn-default"><input name="Goods[availability]" value="0" type="radio">Под заказ</label></div></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>

            <hr>
            <div class="form-group field-goods-condition_id">
                <div class="col-sm-3 control-label"><label class="control-label" for="goods-condition_id">Состояние товара</label></div><div class="col-sm-7"><select id="goods-condition_id" class="form-control" name="Goods[condition_id]">
                        <option value="1">Б/У</option>
                        <option value="2">Новое</option>
                    </select></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>
            <div class="form-group field-goods-payment_methods_id">
                <div class="col-sm-3 control-label"><label class="control-label" for="goods-payment_methods_id">Способы оплаты</label></div><div class="col-sm-7"><select id="goods-payment_methods_id" class="form-control" name="Goods[payment_methods_id]">
                        <option value="1">Наличный расчет</option>
                        <option value="2">Безналичный расчет</option>
                        <option value="3">Любой</option>
                    </select></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>
            <div class="form-group field-goods-delivery_methods_id">
                <div class="col-sm-3 control-label"><label class="control-label" for="goods-delivery_methods_id">Способы доставки</label></div><div class="col-sm-7"><select id="goods-delivery_methods_id" class="form-control" name="Goods[delivery_methods_id]">
                        <option value="1">Самовывоз</option>
                        <option value="2">Доставка</option>
                        <option value="3">Любой</option>
                    </select></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>        <hr>
            <div class="col-sm-3"></div><div class="col-sm-7" id="image-template"></div>

            <div class="form-group field-imgGoodsInput">
                <div class="col-sm-3 control-label"><label class="control-label" for="imgGoodsInput">Фото</label></div><div class="col-sm-7"><input id="imgGoodsInput" class="form-control" name="Goods[photos][]" type="hidden"></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>
            <div class="col-sm-3"></div><div class="col-sm-7"><input accept="image/*,image/jpeg" id="imgGoods" type="file"></div>

            <div class="form-group field-cat required">
                <div class="col-sm-3 control-label"><label class="control-label" for="cat">Категория товара</label></div><div class="col-sm-7"><input id="cat" class="form-control" name="Goods[category_id]" type="hidden"></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>




            <div id="myCat">
                <ul>
                    <?php foreach ($myCategory as $cat):?>
                        <?php if ($cat->category->categorytype->id==1227 && $cat->category->parent_id !=1 && $cat->category->parent->parent_id==1227):?>
                            <li id="<?=$cat->category->id?>"><?=$cat->category->name?>
                                <ul>
                                    <?php if ($cat->category->getChild()->all()):?>
                                        <?php foreach ($cat->category->getChild()->all() as $child):?>
                                            <li id="<?=$child->id?>">
                                                <?=$child->name?>
                                                <ul>

                                                    <?php if ($child->getChild()->all()):?>

                                                        <?php foreach ($child->getChild()->all() as $c):?>
                                                            <li id="<?=$c->id?>"><?=$c->name?></li>
                                                        <?php endforeach;?>


                                                    <?php endif;?>
                                                </ul>
                                            </li>

                                        <?php endforeach;?>

                                    <?php endif;?>
                                </ul>
                            </li>
                        <?php endif;?>

                    <?php endforeach;?>

                </ul>
            </div>
            <script>
                $(function () {
                    $('#myCat') .on('changed.jstree', function (e, data) {
                        var val = '';
                        if (data.selected.length > 0) {
                            val = data.selected[0];
                        }
                        $('#cat').val(val);
                        console.log($('#cat').val())



                    })
                        .jstree({
                            "core" : {
                                "multiple": false,
                                "themes" : {
                                    "variant" : "large"
                                }
                            },
                            "checkbox": {
                                "three_state": false,
                                "cascade": "undetermined"
                            },
                            "plugins": ["checkbox", "wholerow"]
                        });
                })
            </script>
            <hr>

            <div class="form-group">
                <button type="submit" class="btn create-btn btn-md btn-success">Создать</button>            <a class="btn create-btn btn-md btn-default" href="/demo-cabinet/goods">Отмена</a>        </div>

        </div>
    </div>

</div>
