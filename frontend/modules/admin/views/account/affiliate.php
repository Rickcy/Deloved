<?php
if ($aff):

?>
<div id="aff<?=$i?>" class="tab-pane affiliate <?=$i==0||$active == true ? 'active' : ''?>">
   
    <div name="affiliateBlock" style="width: 100%">

        <input type="hidden" id="aff<?=$i?>id" value="<?=$aff->id?>"/>

        <div class="row">
            <div class="col-md-3" align="left">
                <label>Адресс</label>
            </div>
            <div class="col-md-9">
                <input id="aff<?=$i?>address" class="form-control" value="<?=$aff->address?>" style="width: 100%"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3" align="left">
                <label>Город</label>
            </div>
            <div class="col-md-9">
                <input id="aff<?=$i?>city" class="form-control" value="<?=$aff->city_id?>" style="width: 100%"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3" align="left">
                <label>Email</label>
            </div>
            <div class="col-md-9">
                <input id="aff<?=$i?>email" class="form-control" value="<?=$aff->email?>" style="width: 100%"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3" align="left">
                <label>Телефон</label>
            </div>
            <div class="col-md-9">
                <input id="aff<?=$i?>phone" class="form-control" value="<?=$aff->phone?>" style="width: 100%"/>
            </div>
        </div>

        <a href="javascript:void(0)" class="btn btn-success" onclick="saveAffiliate<?=$i?>()">Сохранить</a>
        <button class="btn btn-default" onclick="if (confirm('Вы действительно хотите удалить филиал?')) {$(this).parent().remove()}{$('#affiliateList').submit()}">Удалить</button>

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

            console.log(id);
            console.log(address);
            console.log(city);
            console.log(email);
            console.log(phone);
            $.ajax({
                type:'POST',
                url:'/admin/account/edit-affiliate?address='+address+'&city='+city+'&email='+email+'&phone='+phone+'&aff_id='+aff_id,
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
    </script>
    <?$i++?>
    <?endif;?>
<?if (!$aff):?>
    <div id="aff<?=$count?>" class="tab-pane affiliate <?=$active == true ? 'active' : ''?>">

        <div name="affiliateBlock" style="width: 100%">



            <div class="row">
                <div class="col-md-3" align="left">
                    <label>Адресс</label>
                </div>
                <div class="col-md-9">
                    <input id="aff<?=$count?>address" class="form-control" value="" style="width: 100%"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3" align="left">
                    <label>Город</label>
                </div>
                <div class="col-md-9">
                    <input id="aff<?=$count?>city" class="form-control" value="" style="width: 100%"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3" align="left">
                    <label>Email</label>
                </div>
                <div class="col-md-9">
                    <input id="aff<?=$count?>email" class="form-control" value="" style="width: 100%"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3" align="left">
                    <label>Телефон</label>
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
            $('#addAffiliates').show();

            var address,city,email,phone;
            address=$("#aff<?=$count?>address").val();
            city =$("#aff<?=$count?>city").val();
            email=$("#aff<?=$count?>email").val();
            phone=$("#aff<?=$count?>phone").val();

            console.log(address);
            console.log(city);
            console.log(email);
            console.log(phone);
            $.ajax({
                type:'POST',
                url:'/admin/account/save-new-affiliate?address='+address+'&city='+city+'&email='+email+'&phone='+phone,
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
    </script>
<?endif?>
