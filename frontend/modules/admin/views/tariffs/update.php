<?php

/** @var $tariff common\models\Tariffs **/

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title" style="text-align: left"><?=Yii::t('app', 'Update Tariff')?></h4>
</div>


<div class="modal-body">
    <?$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label']], 'enableAjaxValidation' => true,
        'validationUrl' => Url::to(['/validate/tariff']),
    ])
    ?>

    <?=$form->field($tariff , 'name')->textInput()?>
    <?=$form->field($tariff , 'price')->textInput()?>

    <? $items = ArrayHelper::map($currency,'id','code');

    echo $form->field($tariff, 'currency_id')->dropDownList($items)->label(Yii::t('app', 'Currency'))?>

    <?=$form->field($tariff , 'months')->dropDownList([
        '1' => '1 месяц',
        '3' => '3 месяца',
        '6' => '6 месяцев',
        '9' => '9 месяцев',
        '12' => '12 месяцев',
    ]);?>



    <?php ActiveForm::end(); ?>
</div>
<div class="modal-footer">
    <div class="form-group">
        <?= Html::button( Yii::t('app', 'Update Tariff'), ['class' =>'btn btn-success','onclick'=>'editTariff()']) ?>
    </div>

</div>
<script>
    function editTariff() {
        var id,price,name,currency_id,months,currency_text;
        id =<?=$tariff->id?>;
        name = $('#tariffs-name').val();
        price = $('#tariffs-price').val();
        months = $('#tariffs-months').val();
        currency_id = $('#tariffs-currency_id').val();
        currency_text = $('#tariffs-currency_id option:selected').text();
        console.log(id);
        console.log(name);
        console.log(price);
        console.log(currency_id);
        console.log(months);
        console.log(currency_text);

        $.ajax({
            type:'POST',
            url:'/admin/tariffs/edit-tariff?id='+id+'&name='+name+'&price='+price+'&months='+months+'&currency_id='+currency_id,
            success:function (data) {
                var obj = $.parseJSON(data);

                if (obj.success) {
                    
                    $('#name<?=$tariff->id?> >a').text(name);
                    $('#price<?=$tariff->id?>').text(price);
                    $('#code<?=$tariff->id?>').text(currency_text);

                    $('#myModal').modal('hide');
                    showMessage('success', obj.success);
                }
                if (obj.danger) {
                    showMessage('danger', obj.danger)
                }
            },
            error:function () {
                showMessage('danger', 'Ошибка соединения');
            }
        })
    }
</script>
