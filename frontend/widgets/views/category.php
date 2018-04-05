<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 26.09.17
 * Time: 12:29
 */
?>
<div class="modal fade" id="changeCat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content contact-content" style="width:100%;margin: 0 auto">
            <div class="modal-header" style="background-color: #94C43D">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title " style="text-align: center;color: white">Выбирите Категории</h4>
            </div>

            <div class="modal-body">
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
    <div class="col-sm-3">
        <a href="javascript:void(0)" class="btn btn-success" style="width:100%" id="saveCategory">Сохранить</a>
    </div>
</div>
<input id="account_category_goods" class="hidden"/>
<input id="account_category_service" class="hidden"/>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {

            $("#saveCategory").click(function () {
                var goods = $("#account_category_goods");
                var category_goods = [];
                goods.each(function () {
                    category_goods.push($(this).val())
                });
                var service = $("#account_category_service");
                var category_services = [];
                service.each(function () {
                    category_services.push($(this).val())
                });
                var item,word;

            <?php if ($item == 'good'):?>
                item = goods;
                word = 'товаров';
                <?php endif;?>
                <?php if ($item == 'service'):?>
                item = service;
                word = 'услуг';
                <?php endif;?>

                if(item.val() === ''){
                    showMessage('danger', 'Выбирите Категорию '+word);
                    return false;
                }
                else {
                    $.ajax({
                        type: 'POST',
                        url: '/admin/account/save-category/?goods=' + category_goods + '&service=' + category_services,
                        success: function (data) {
                            window.location.href = '<?=$urlRed?>';
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            showMessage('danger', 'Выбирите Категории');

                        }
                    })
                }


            });
        })
    </script>
</div>
