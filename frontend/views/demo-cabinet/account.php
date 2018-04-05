<?php
$this->title = 'Мои данные';
?>
<div class="profile-info">



    <h2 class="ft">Общая информация</h2>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="id">ID в системе</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="id" class="form-control grey" name="id">8237</p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="orgForm">Организационно-правовая форма</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="orgForm" class="form-control grey" name="orgForm">ООО</p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="fullName">Полное наименование</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="fullName" class="form-control grey" name="fullName">Сибирская Энергитическая Промышленная Компания</p>
        </div>
        <div class="action-col">

        </div>
    </div>



    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="brandName">Фирменное наименование</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="brandName" class="form-control grey" name="brandName">СибЭнергоПром</p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">

            <label>Логотип</label>
        </div>
        <div class="col-sm-7 ft ">
            <div name="logo">
                <div  id="image-template">

                        <img style='max-width: 25%;margin: 10px' src="/uploads/default/logo_default.png" />

                </div>
            </div>
        </div>
        <div class="action-col ft">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="rating">Деловая репутация</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="rating" class="form-control grey" name="rating">100%</p>
        </div>

    </div>


    <hr>



    <h2 class="ft">Юридическая информация</h2>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="inn">ИНН</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="inn" class="form-control grey" name="inn">84635495735</p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="regNumber">ОГРН</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="regNumber" class="form-control grey" name="regNumber">8346354298483434</p>
        </div>
        <div class="action-col">

        </div>
    </div>



    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="legal_address">Юридический адрес</label>
        </div>
        <div class="col-sm-7 col-xs-10 ft ">
            <input id="legal_address" name="legal_address" class="form-control" type="text" readonly value="ул. Марининская 98" data-old="ул. Марининская 98"
                   placeholder="Отсутствует"/>
        </div>
        <div class="col-sm-1 col-xs-1">
            <span name="change" data-for="legal_address" class="glyphicon glyphicon-pencil pen label-col"></span>
        </div>
    </div>


    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="regDate">Дата регистрации</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="regDate" class="form-control grey" name="regDate">27.09.2005</p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="manager">Руководство</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="manager" class="form-control grey" name="manager">Каприн Василий Иванович</p>
        </div>
        <div class="action-col">
        </div>
    </div>


    <hr>

    <h2 class="ft">Контактная информация</h2>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="city">Фактический город</label>
        </div>
        <div class="col-sm-7 col-xs-10 ft ">

            <?php

            use yii\jui\AutoComplete;

            echo AutoComplete::widget([
                'name'=>'city',
                'value'=>'Калиногорск',
                'id'=>'city',


                'clientOptions' => [
                    'source' => $city_list,
                    'autoFill'=>true,
                    'minLength' => 2,

                ],
                'options'=>[
                    'data-old'=>'Калиногорск',
                    'readonly'=>true,
                    'class'=>'form-control'
                ]
            ])
            ?>
            <div class="pods fr">Город вашего центрального офиса</div>
        </div>

        <div class="col-sm-1 col-xs-1">
            <span name="change" data-for="city" class="glyphicon glyphicon-pencil pen label-col"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="address">Фактический адрес</label>
        </div>
        <div class="col-sm-7 col-xs-10 ft ">
            <input id="address" name="address" type="text" class="form-control" readonly="true" value="ул. Марининская 98" data-old="ул. Марининская 98"
                   placeholder="Отсутствует"/>
            <div class="pods fr">Адрес вашего центрального офиса</div>
        </div>
        <div class="col-sm-1 col-xs-1">
            <span name="change" data-for="address" class="glyphicon glyphicon-pencil pen label-col"></span>
        </div>
    </div>





    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="email">Email</label>
        </div>
        <div class="col-sm-7 col-xs-10 ft ">
            <input id="email" name="email" type="text" class="form-control" readonly value="kaprin@gmail.com" data-old="kaprin@gmail.com"
                   placeholder="Отсутствует"/>
            <div class="pods fr">Адрес электронной почты</div>
        </div>
        <div class="col-sm-1 col-xs-1">
            <span name="change" data-for="email" class="glyphicon glyphicon-pencil pen label-col"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="web_address">Сайт</label>
        </div>
        <div class="col-sm-7 col-xs-10 ft ">
            <input id="web_address" name="web_address" class="form-control" type="text" readonly value="" data-old=""
                   placeholder="Отсутствует"/>
            <div class="pods fr">Адрес веб-сайта</div>
        </div>
        <div class="col-sm-1 col-xs-1">
            <span name="change" data-for="web_address" class="glyphicon glyphicon-pencil pen label-col"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="phone1">Номер телефона №1</label>
        </div>
        <div class="col-sm-7 col-xs-10 ft ">
            <input id="phone1" name="phone1" type="text" class="form-control" readonly value="38-23-84" data-old="38-23-84"
                   placeholder="Отсутствует"/>
            <div class="pods fr">Основной номер телефона</div>
        </div>
        <div class="col-sm-1 col-xs-1">
            <span name="change" data-for="phone1" class="glyphicon glyphicon-pencil pen label-col"></span>
        </div>
    </div>





    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="fax">Факс</label>
        </div>
        <div class="col-sm-7 col-xs-10 ft ">
            <input id="fax" name="fax" type="text" class="form-control" readonly value="" data-old=""
                   placeholder="Отсутствует"/>
            <div class="pods fr">Номер факса</div>
        </div>
        <div class="col-sm-1 col-xs-1">
            <span name="change" data-for="fax" class="glyphicon glyphicon-pencil pen label-col"></span>
        </div>
    </div>


    <hr>


    <h2 class="ft">Дополнительная информация</h2>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="work_time">Время работы</label>
        </div>
        <div class="col-sm-7 col-xs-10 ft ">
            <input id="work_time" name="work_time" class="form-control" type="text" readonly value="ПН-ПТ 9:00 - 18:00" data-old="ПН-ПТ 9:00 - 18:00"
                   placeholder="Отсутствует"/>
            <div class="pods fr">В свободной форме укажите график работы</div>
        </div>
        <div class="col-sm-1 col-xs-1">
            <span name="change" data-for="work_time" class="glyphicon glyphicon-pencil pen label-col"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="description">Описание</label>
        </div>
        <div class="col-sm-7 col-xs-10 ft ">
                <textarea id="description" class="form-control" name="description" type="text" readonly data-old=""
                          placeholder="Отсутствует">
                </textarea>
            <div class="pods fr">Краткое описанеи вашей деятельности, основые направления деятельности, предлагаемые товары и услуги.</div>
        </div>
        <div class="col-sm-1 col-xs-1">
            <span name="change" data-for="description" class="glyphicon glyphicon-pencil pen label-col"></span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="keywords">Ключевые слова</label>
        </div>
        <div class="col-sm-7 col-xs-10 ft ">
                <textarea id="keywords" class="form-control" name="keywords" type="text" readonly data-old=""
                          placeholder="Отсутствуют">
                </textarea>
            <div class="pods fr">Укажите через запятые набор слов наиболее полно отражающих вашу деятельности.
                Ключевые слова используются для более эффективного поиска вашего предприятия</div>
        </div>
        <div class="col-sm-1 col-xs-1">
            <span name="change" data-for="keywords" class="glyphicon glyphicon-pencil pen label-col"></span>
        </div>
    </div>


    <div class="row">
        <h2 class="ft">Филиалы</h2>
        <div class="col-md-3 col-lg-3 col-sm-3 col-xs-2"></div>
        <div class="value-col ft">


            <ul id="affTabNav" class="nav nav-pills">

                    <li class="active"><a id="hrefaff" data-toggle="tab" href="#aff">1</a></li>

                <li id="affPlus">
                    <a href="javascript:void(0)" id="addAffiliates"   ><span class="glyphicon glyphicon-plus"></span></a>
                </li>
            </ul>




            <div id="affTabContent" class="tab-content">
                <div id="aff" class="tab-pane affiliate active">

                    <div name="affiliateBlock" style="width: 100%">



                        <div class="row">
                            <div class="col-md-3" align="left">
                                <label class="label-control">Адрес</label>
                            </div>
                            <div class="col-md-9">
                                <input id="affaddress" class="form-control" value="ул. Марининская 189" style="width: 100%"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3" align="left">
                                <label class="label-control">Город</label>
                            </div>
                            <div class="col-md-9">

                                <?php
                                echo AutoComplete::widget([
                                    'value'=>'Калиногорск',
                                    'id'=>'affcity',


                                    'clientOptions' => [
                                        'source' => $city_list,
                                        'autoFill'=>true,
                                        'minLength' => 2,
                                    ],
                                ])
                                ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3" align="left">
                                <label class="label-control">Email</label>
                            </div>
                            <div class="col-md-9">
                                <input id="affemail" class="form-control" value="kalin-23@gmail.com" style="width: 100%"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3" align="left">
                                <label class="label-control">Телефон</label>
                            </div>
                            <div class="col-md-9">
                                <input id="affphone" class="form-control" value="89-23-21" style="width: 100%"/>
                            </div>
                        </div>


                    </div>
                </div>

            </div>


        </div>

    </div>



    <hr>

    <div class="row">
        <div class="col-sm-8 col-sm-offset-1">
            <div class="tab-pane" id="cat" >
                <ul class="nav nav-pills nav-justified" style="margin-bottom: 20px">
                    <?php
                    $i=0;
                    foreach ($categoryType as $catType ):?>

                        <li style="font-size: 16pt;" class="<?=$i==0?"active":""?>"><a href="#<?=$catType->code?>" data-toggle="tab"><?=$catType->code=='GOOD'?'Категория  товаров':'Категория услуг'?></a></li>

                        <?php
                        $i++;
                    endforeach;?>
                </ul>

                <div class="tab-content ">
                    <?php
                    $i=0;foreach ($categoryType as $catType ):?>

                        <div  class="tab-pane <?=$i==0?"active":""?>" id="<?=$catType->code?>">



                            <ul>
                                <?php foreach ($category as $cat):?>

                                    <?php if ($cat->categorytype_id==$catType->id && $cat->parent_id!=1227 && $cat->parent->parent_id==1227):?>

                                        <li id="<?=$cat->id?>" data-jstree=<?=$cat->equelsVar($cat->id,$myCategory)?>>
                                            <?=$cat->name?>

                                        </li>


                                    <?php endif;?>


                                <?php endforeach;?>
                            </ul>



                        </div>
                        <script>
                            $(function () {
                                $('#<?=$catType->code?>') .on('changed.jstree', function (e, data) {
                                    var i, j, r = [],h =[];
                                    for(i = 0, j = data.selected.length; i < j; i++) {
                                        r.push(data.instance.get_node(data.selected[i]).id);

                                    }
                                    $('#<?=$catType->code=='GOOD'?'account_category_goods':'account_category_service'?>').val(r.join(','));


                                    if($("#saveCategory").hide()){
                                        $("#saveCategory").show()
                                    }


                                })
                                    .jstree({
                                        "core" : {
                                            "themes" : {
                                                "variant" : "large"
                                            }
                                        },
                                        "checkbox": {
                                            "three_state": false,
                                            "cascade": "undetermined"
                                        },
                                        "plugins" : [ "checkbox","wholerow" ]
                                    });
                            })
                        </script>
                        <?php
                        $i++;
                    endforeach;?>

                </div>
            </div>
        </div>

        <div class="col-sm-8 col-sm-offset-1" style="margin-top: 2rem">
            <a href="javascript:void(0)" class="btn btn-success" style="width:100%" id="saveCategory">Сохранить</a>
        </div>
    </div>


</div>
<script>
    $(function () {

        $('[name=change]').click(function(e) {

            var el = e.target || e.srcElement;

            var prop = $(el).data('for');

            if ($('#'+prop).is('[readonly]')) {
                $('#'+prop).attr('readonly', false);
                $(el).removeClass('glyphicon-pencil').removeClass('pen');
                $(el).addClass('glyphicon-ok').addClass('ok')

            } else {
                var oldValue = $('#'+prop).data('old');
                var newValue = $('#'+prop).val();
                if (oldValue != newValue) {

                    $.ajax({
                        type: 'POST',
                        url: '/demo-cabinet/gate',

                        beforeSend: function() {
                            $('#'+prop+'spinner').show();
                        },
                        complete: function (textStatus) {
                            $('#'+prop+'spinner').hide();
                            if (textStatus.status) {

                            } else {

                            }
                        },
                        success: function (data, textStatus) {

                                $('#'+prop).data('old', newValue);
                                showMessage('success', 'Сохранено')



                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            showMessage('danger', 'Ошибка соединения');
                            console.log('Ошибка соединения')
                        }
                    })
                }
                $('#'+prop).attr('readonly', true);
                $(el).removeClass('glyphicon-ok').removeClass('ok');
                $(el).addClass('glyphicon-pencil');
            }
        });
    })
</script>