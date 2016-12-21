<?php

?>
<div id="aff<?=$count+1?>" class="tab-pane <?=$i == 0 || $active == true ? 'in active' : ''?>">
   
    <div name="affiliateBlock" style="width: 100%">

        <input type="hidden" name="aff.<?=$i?>.id" value="<?=$aff->id?>"/>

        <div class="row">
            <div class="col-md-3" align="left">
                <label>Адресс</label>
            </div>
            <div class="col-md-9">
                <input name="aff.<?=$count+1?>.address" class="form-control" value="<?=$aff->address?>" style="width: 100%"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3" align="left">
                <label>Город</label>
            </div>
            <div class="col-md-9">
                <input name="aff.<?=$count+1?>.city" class="form-control" value="<?=$aff->city_id?>" style="width: 100%"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3" align="left">
                <label>Email</label>
            </div>
            <div class="col-md-9">
                <input name="aff.<?=$count+1?>.email" class="form-control" value="<?=$aff->email?>" style="width: 100%"/>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3" align="left">
                <label>Телефон</label>
            </div>
            <div class="col-md-9">
                <input name="aff.<?=$count+1?>.phone" class="form-control" value="<?=$aff->phone?>" style="width: 100%"/>
            </div>
        </div>

        <a href="javascript:void(0)" class="btn btn-success" id="saveAffiliate">Сохранить</a>
        <button class="btn btn-default" onclick="if (confirm('Вы действительно хотите удалить филиал?')) {$(this).parent().remove()}{$('#affiliateList').submit()}">Удалить</button>

    </div>
</div>
<?$i++?>