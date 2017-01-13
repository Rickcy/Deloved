<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\jui\AutoComplete;
use yii\widgets\Pjax;

/**@var $account common\models\Account**/
/**@var $model common\models\Logo**/
/**@var $cat common\models\Category**/
/**@var $c common\models\Category**/
/**@var $item common\models\Category**/
$image =$account->getMainImage();
$this->title = 'Мои данные';
?>
<div class="profile-info">



    <h2 class="ft">Общая информация</h2>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="id">ID в системе</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="id" class="form-control grey" name="id"><?=Html::encode($account->id)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="orgForm">Организационно-правовая форма</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="orgForm" class="form-control grey" name="orgForm"><?=Html::encode($account->orgForm->name)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="fullName">Полное наименование</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="fullName" class="form-control grey" name="fullName"><?=Html::encode($account->full_name)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>



    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="brandName">Фирменное наименование</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="brandName" class="form-control grey" name="brandName"><?=Html::encode($account->brand_name)?></p>
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




                <?php Pjax::begin(); ?>
                <?if ($account->getMainImage()):?>
                <img width="40%" src="/<?=Html::encode($account->getMainImage()->file)?>" class="img-thumbnail" alt="<?=Html::encode($account->getMainImage()->image_name)?>">
                <?endif;?>
                <?if (!$account->getMainImage()):?>
                    <img width="40%" src="/uploads/default/logo_default.png" class="img-thumbnail" alt="logo_default">
                <?endif;?>
                <?= Html::beginForm(['/admin/account/show'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>

                <?= Html::activeFileInput($model, 'file', ['class' => 'form-control image_input','onchange'=>'submitFiles()']) ?>
                <button type="submit" class="image_btn" style="opacity: 0"></button>
                <?= Html::endForm() ?>

                <?php Pjax::end(); ?>
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
            <p id="rating" class="form-control grey" name="rating"><?=Html::encode($account->rating)?>%</p>
        </div>

    </div>


    <hr>



    <h2 class="ft">Юридическая информация</h2>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="inn">ИНН</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="inn" class="form-control grey" name="inn"><?=Html::encode($account->inn)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="regNumber">ОГРН</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="regNumber" class="form-control grey" name="regNumber"><?=Html::encode($account->ogrn)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>


    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="legalAddress">Юридический адрес</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="legalAddress" class="form-control grey" name="legalAddress"><?=Html::encode($account->legal_address)?></p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="regDate">Дата регистрации</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="regDate" class="form-control grey" name="regDate"><?=Html::encode(Yii::$app->formatter->asDatetime($account->date_reg, "php:d.m.Y"))?></p>
        </div>
        <div class="action-col">

        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 label-col ft  col-sm-offset-1">
            <label for="manager">Руководство</label>
        </div>
        <div class="col-sm-7 ft ">
            <p id="manager" class="form-control grey" name="manager"><?=Html::encode($account->director)?></p>
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

            <?
            echo AutoComplete::widget([
                'name'=>'city',
                'value'=>$account->city->name,
                'id'=>'city',


                'clientOptions' => [
                    'source' => $city_list,
                    'autoFill'=>true,
                    'minLength' => 2,

                ],
                'options'=>[
                    'data-old'=>$account->city->name,
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
            <input id="address" name="address" type="text" class="form-control" readonly="true" value="<?=Html::encode($account->address)?>" data-old="<?=Html::encode($account->address)?>"
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
            <input id="email" name="email" type="text" class="form-control" readonly value="<?=Html::encode($account->email)?>" data-old="<?=Html::encode($account->email)?>"
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
            <input id="web_address" name="web_address" class="form-control" type="text" readonly value="<?=Html::encode($account->web_address)?>" data-old="<?=Html::encode($account->web_address)?>"
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
            <input id="phone1" name="phone1" type="text" class="form-control" readonly value="<?=Html::encode($account->phone1)?>" data-old="<?=Html::encode($account->phone1)?>"
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
            <input id="fax" name="fax" type="text" class="form-control" readonly value="<?=Html::encode($account->fax)?>" data-old="<?=Html::encode($account->fax)?>"
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
            <input id="work_time" name="work_time" class="form-control" type="text" readonly value="<?=Html::encode($account->work_time)?>" data-old="<?=Html::encode($account->work_time)?>"
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
                <textarea id="description" class="form-control" name="description" type="text" readonly data-old="<?=Html::encode($account->description)?>"
                          placeholder="Отсутствует"><?=Html::encode($account->description)?>
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
                <textarea id="keywords" class="form-control" name="keywords" type="text" readonly data-old="<?=Html::encode($account->keywords)?>"
                          placeholder="Отсутствуют"><?=Html::encode($account->keywords)?>
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
                <?$i=0;
                foreach ($affiliate as $aff):?>
                    <li class="<?=$i==0?'active':''?>"><a id="hrefaff<?=$i?>" data-toggle="tab" href="#aff<?=$i?>"><?=$i+1?></a></li>
                <?$i++;
                endforeach;?>
                <li id="affPlus">
                    <a href="javascript:void(0)" id="addAffiliates" onclick="createAffiliates()"  ><span class="glyphicon glyphicon-plus"></span></a>
                </li>
            </ul>

            


                <div id="affTabContent" class="tab-content">
                    <?$i=0;
                    foreach ($affiliate as $aff):?>
                        <?=$this->render("affiliate",['myAccount'=>null,'i'=>$i,'aff'=>$aff,'count'=>$count,'active'=>false,'city_list'=>$city_list])?>
                    <?$i++;
                    endforeach;?>

                </div>
        

        </div>
        
    </div>
    <script>
        function createAffiliates() {
            $.ajax({
                type:'POST',
                url:'/admin/account/add-affiliate',
                success:function(data,textStatus){
                    pushAffiliate(data);
                },error:function(XMLHttpRequest,textStatus,errorThrown){

                }}
            );return false;
        }


        
        function createTab(index){
            var tab = document.createElement('LI');
            var a = document.createElement('A');
            a.setAttribute('href', '#aff'+index);
            a.dataset.toggle = 'tab';
            a.innerText = index+1;
            tab.appendChild(a);
            return tab
        }


        function pushAffiliate(data) {
            var result = [];

            var tab = createTab(document.getElementsByName('affiliateBlock').length);

            result.push($("li.active").removeClass('active').removeClass('in'));
            result.push($(tab).appendTo('#affTabNav'));
            result.push($(tab).addClass('active'));

            result.push($(".tab-pane.active.affiliate").removeClass('active'));
            result.push($(data).appendTo('#affTabContent'));

            result.push($('#affPlus').insertAfter(tab));
            $('#addAffiliates').hide();

            return result
        }
    </script>


    <hr>

    <div class="row">
      <div class="col-sm-8 col-sm-offset-1">
        <div class="tab-pane" id="cat" >
            <ul class="nav nav-pills nav-justified" style="margin-bottom: 20px">
                <?
                $i=0;
                foreach ($categoryType as $catType ):?>

                    <li style="font-size: 16pt;" class="<?=$i==0?"active":""?>"><a href="#<?=$catType->code?>" data-toggle="tab"><?=$catType->code=='GOOD'?'Категория  товаров':'Категория услуг'?></a></li>

                    <?
                    $i++;
                endforeach;?>
            </ul>

            <div class="tab-content ">
                <?
                $i=0;foreach ($categoryType as $catType ):?>

                    <div  class="tab-pane <?=$i==0?"active":""?>" id="<?=$catType->code?>">



                        <ul>
                            <?foreach ($category as $cat):?>

                                <?if ($cat->categorytype_id==$catType->id&&$cat->parent_id!=1&&$cat->getParent()->one()->parent_id==1):?>

                                    <li id="<?=$cat->id?>" data-jstree=<?=$cat->equelsVar($cat->id,$myCategory)?>><?=$cat->name?>
                                    
                                    </li>


                                <?endif;?>


                            <?endforeach;?>
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
                    <?
                    $i++;
                endforeach;?>

            </div>
        </div>
        </div>
        <div class="col-sm-3">
            <a href="javascript:void(0)" class="btn btn-success" style="width:100%" id="saveCategory">Сохранить</a>
        </div>
    </div>


</div>
<input id="account_category_goods" class="w"/>
<input id="account_category_service" class="w"/>

<script>
    $(document).ready(function() {

        $("#saveCategory").click(function () {
            var goods = $("#account_category_goods");
            var category_goods =[];
            goods.each(function () {
                category_goods.push($(this).val())
            });
            var service = $("#account_category_service");
            var category_services =[];
            service.each(function () {
                category_services.push($(this).val())
            });
         


            $.ajax({
                type: 'POST',
                url: '/admin/account/save-category/?goods='+category_goods+'&service='+category_services,
                success:function (data) {
                    var obj = $.parseJSON(data);
                   
                    if (obj.success) {
                        showMessage('success', obj.success)
                    }
                    if (obj.danger) {
                        showMessage('danger', obj.danger)
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showMessage('danger', 'Ошибка соединения');
                 
                }
            })
        });



      

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
                        url: "/admin/account/edit-new/?value="+newValue+'&prop='+prop,

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
                            var obj = $.parseJSON(data);


                            if (obj.success) {
                                $('#'+prop).data('old', newValue);
                                showMessage('success', obj.success)

                            } if (obj.danger) {
                                $('#'+prop).val(oldValue);
                                showMessage('danger', obj.danger)
                            }

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
    });
</script>