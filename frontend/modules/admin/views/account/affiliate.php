<?php
use yii\jui\AutoComplete;
/**@var $aff common\models\Affiliate**/
if ($aff):

?>
<div id="aff<?=$i?>" class="tab-pane affiliate <?=$i==0||$active == true ? 'active' : ''?>">
   
    <div name="affiliateBlock" style="width: 100%">

        <input type="hidden" id="aff<?=$i?>id" value="<?=$aff->id?>"/>

        <div class="row">
            <div class="col-md-3" align="left">
                <label class="label-control">Адресс</label>
            </div>
            <div class="col-md-9">
                <input id="aff<?=$i?>address" class="form-control" value="<?=$aff->address?>" style="width: 100%"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3" align="left">
                <label class="label-control">Город</label>
            </div>
            <div class="col-md-9">
<!--                <input id="aff--><?//=$i?><!--city" class="form-control" value="--><?//=$aff->city_id?><!--" style="width: 100%"/>-->
                <?php
                echo AutoComplete::widget([
                    'value'=>$aff->getCity()->one()->name,
                    'id'=>'aff'.$i.'city',
                  

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
                <input id="aff<?=$i?>email" class="form-control" value="<?=$aff->email?>" style="width: 100%"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3" align="left">
                <label class="label-control">Телефон</label>
            </div>
            <div class="col-md-9">
                <input id="aff<?=$i?>phone" class="form-control" value="<?=$aff->phone?>" style="width: 100%"/>
            </div>
        </div>

        <a href="javascript:void(0)" class="btn btn-success" onclick="saveAffiliate<?=$i?>()">Сохранить</a>
        <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteAffiliate<?=$i?>()">Удалить</a>

    </div>
</div>
    <script>
        function saveAffiliate<?=$i?>() {
            $('#addAffiliates').show();

            var address,city,email,phone,aff_id;
            aff_id=$("#aff<?=$i?>id").val();
            address=$("#aff<?=$i?>address").val();
            city =$("#aff<?=$i?>city").val();
            email=$("#aff<?=$i?>email").val();
            phone=$("#aff<?=$i?>phone").val();


            $.ajax({
                type:'POST',
                url:'/admin/account/edit-affiliate?address='+address+'&city='+city+'&email='+email+'&phone='+phone+'&aff_id='+aff_id<?if ($myAccount!=null) echo'+\'&id='.$myAccount->id.'\','?><?if ($myAccount==null) echo ','?>
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

        }
        function deleteAffiliate<?=$i?>() {
            var aff_id=$("#aff<?=$i?>id").val();
            $.ajax({
                type:'POST',
                url:'/admin/account/delete-affiliate?aff_id='+aff_id,
                success:function (data) {

                    var obj = $.parseJSON(data);

                    if (obj.success) {
                        showMessage('success', obj.success)
                    }
                    if (obj.danger) {
                        showMessage('danger', obj.danger)
                    }

                    $('#aff<?=$i?>').remove();
                    $('#hrefaff<?=$i?>').remove();

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showMessage('danger', 'Ошибка соединения');

                }
            })
        }
    </script>
    <?php $i++?>
    <?php endif;?>
<?php if (!$aff):?>
    <div id="aff<?=$count?>" class="tab-pane affiliate <?=$active == true ? 'active' : ''?>">

        <div name="affiliateBlock" style="width: 100%">



            <div class="row">
                <div class="col-md-3" align="left">
                    <label class="label-control">Адресс</label>
                </div>
                <div class="col-md-9">
                    <input id="aff<?=$count?>address" class="form-control" value="" style="width: 100%"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3" align="left">
                    <label class="label-control">Город</label>
                </div>
                <div class="col-md-9">
<!--                    <input id="aff--><?//=$count?><!--city" class="form-control" value="" style="width: 100%"/>-->
                    <?php
                    echo AutoComplete::widget([
                        'name' => 'country',
                        'id' => 'aff'.$count.'city',
                        'clientOptions' => [
                            'source' => $city_list,
                            'autoFill'=>true,
                            'minLength' => 2,
                        ],
                    ]);;?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 " align="left">
                    <label class="label-control">Email</label>
                </div>
                <div class="col-md-9">
                    <input id="aff<?=$count?>email" class="form-control" value="" style="width: 100%"/>

                </div>
            </div>

            <div class="row">
                <div class="col-md-3" align="left">
                    <label class="label-control">Телефон</label>
                </div>
                <div class="col-md-9">
                    <input id="aff<?=$count?>phone" class="form-control" value="" style="width: 100%"/>
                </div>
            </div>

            <a href="javascript:void(0)" class="btn btn-success" onclick="saveNewAffiliate()">Сохранить</a>


        </div>
    </div>
    <script>
        function saveNewAffiliate() {


            var address,city,email,phone;
            address=$("#aff<?=$count?>address").val();
            city =$("#aff<?=$count?>city").val();
            email=$("#aff<?=$count?>email").val();
            phone=$("#aff<?=$count?>phone").val();

            $.ajax({
                type:'POST',
                url:'/admin/account/save-new-affiliate?address='+address+'&city='+city+'&email='+email+'&phone='+phone,
                success:function (data) {
                    var obj = $.parseJSON(data);

                    if (obj.success) {
                        showMessage('success', obj.success)
                        $('#addAffiliates').show();
                    }
                    if (obj.danger) {
                        showMessage('danger', obj.danger)
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showMessage('danger', 'Ошибка соединения');

                }
            })

        }
    </script>
<?php endif?>
