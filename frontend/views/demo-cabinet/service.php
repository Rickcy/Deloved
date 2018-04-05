<?php
$this->title = 'Редактировать услугу';

use yii\bootstrap\Html;

?>
<div class="goods-create">

    <h1 class="text-center">Редактировать услугу</h1>

    <div class="services-create">

        <div id="w0" class="form-horizontal" action="/admin/services/create" method="post" enctype="multipart/form-data">

            <div class="form-group field-services-name required">
                <div class="col-sm-3 control-label"><label class="control-label" for="services-name">Название</label></div><div class="col-sm-7"><input value="Бурение скважин" id="services-name" class="form-control" name="Services[name]" maxlength="255" type="text"></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>


            <div class="col-sm-12 col-sm-offset-0">
                <div class="col-sm-7">
                    <div class="form-group field-services-price">
                        <div class="col-sm-5 control-label"><label class="control-label" for="services-price">Цена</label></div><div class="col-sm-7"><input value="4500" id="services-price" class="form-control" name="Services[price]" type="text"></div><div class="col-sm-7 col-sm-offset-5"><p class="help-block help-block-error"></p></div>
                    </div>            </div>
                <div class="col-sm-4">
                    <div class="form-group field-services-currency_id required">
                        <div class="col-sm-1"></div><div class="col-sm-8"><select id="services-currency_id" class="form-control" name="Services[currency_id]">
                                <option value="2"> $</option>
                                <option value="1"> Руб</option>
                            </select></div><div class="col-sm-9 col-sm-offset-1"><p class="help-block help-block-error"></p></div>
                    </div>            </div>

            </div>


            <div class="form-group field-services-measure_id required">
                <div class="col-sm-3 control-label"><label class="control-label" for="services-measure_id">Единицы измерения</label></div><div class="col-sm-7"><select id="services-measure_id" class="form-control" name="Services[measure_id]">
                        <option value="2">услуга</option>
                        <option value="46">Киллометр</option>
                        <option value="48">Человек</option>
                        <option value="49">Место</option>
                        <option value="50">Год</option>
                        <option value="51">Декада</option>
                        <option value="52">Квартал</option>
                        <option value="53">Смена</option>
                        <option value="54">Единица</option>
                        <option value="55">Месяц</option>
                        <option value="56">Лист печатный</option>
                        <option value="57">Процент</option>
                        <option value="58">лист учетно-издательский</option>
                        <option value="59">Минута</option>
                        <option value="60">Секунда</option>
                        <option value="61">Символ</option>
                        <option value="62">Неделя</option>
                        <option value="63">Норм/час</option>
                        <option value="64">Слово</option>
                        <option value="65">Сутки</option>
                        <option value="66">Тариф</option>
                        <option value="67">Час</option>
                    </select></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>

            <div class="form-group field-services-description">
                <div class="col-sm-3 control-label"><label class="control-label" for="services-description">Описание</label></div><div class="col-sm-7"><textarea id="services-description" class="form-control" name="Services[description]" rows="5"></textarea></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>

            <hr>


            <div class="form-group field-services-payment_methods_id">
                <div class="col-sm-3 control-label"><label class="control-label" for="services-payment_methods_id">Способы оплаты</label></div><div class="col-sm-7"><select id="services-payment_methods_id" class="form-control" name="Services[payment_methods_id]">
                        <option value="1">Наличный расчет</option>
                        <option value="2">Безналичный расчет</option>
                        <option value="3">Любой</option>
                    </select></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>
            <hr>


            <div class="col-sm-3"></div><div class="col-sm-7" id="image-template"></div>

            <div class="form-group field-imgServiceInput">
                <div class="col-sm-3 control-label"><label class="control-label" for="imgServiceInput">Фото</label></div><div class="col-sm-7"><input id="imgServiceInput" class="form-control" name="Services[photos][]" type="hidden"></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>
            <div class="col-sm-3"></div><div class="col-sm-7"><input accept="image/*,image/jpeg" id="imgService" type="file"></div>


            <div class="form-group field-cat required">
                <div class="col-sm-3 control-label"><label class="control-label" for="cat">Категория услуги</label></div><div class="col-sm-7"><input id="cat" class="form-control" name="Services[category_id]" type="hidden"></div><div class="col-sm-7 col-sm-offset-3"><p class="help-block help-block-error"></p></div>
            </div>
            <div id="myCat">
                <ul>
                    <?php foreach ($myCategory as $cat):?>
                        <?php if ($cat->category->categorytype->id == 1342 && $cat->category->parent_id !=1 && $cat->category->parent->parent_id==1227):?>
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
                    $('#myCat > ul >li:last').remove();
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
                <button type="submit" class="btn btn-success">Создать</button>            <a class="btn create-btn btn-md btn-default" href="/demo-cabinet/services">Отмена</a>        </div>

        </div>
    </div>

    <div></div></div>
