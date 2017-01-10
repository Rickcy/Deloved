<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
/** @var $currency common\models\Currency **/

?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title" style="text-align: left"><?=Yii::t('app', 'Update currency')?></h4>
</div>


<div class="modal-body">
    <?$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label']], 'enableAjaxValidation' => true,
        'validationUrl' => Url::to(['/validate/currency']),
    ])
    ?>

    <?=$form->field($currency , 'code')->textInput(['id'=>'currency-code'])?>

    <?=$form->field($currency , 'name')->textInput(['id'=>'currency-name'])?>
    <?php ActiveForm::end(); ?>
</div>
<div class="modal-footer">
    <div class="form-group">
        <?= Html::button( Yii::t('app', 'Update currency'), ['class' =>'btn btn-success','onclick'=>'editCurrency()']) ?>
    </div>

</div>
<script>
    function editCurrency() {
        var id,name,code;
        id =<?=$currency->id?>;
        code = $('#currency-code').val();
        name = $('#currency-name').val();
        console.log(id)
        console.log(code)
        console.log(name)
        
        $.ajax({
            type:'POST',
            url:'/admin/currency/edit-currency?id='+id+'&code='+code+'&name='+name,
            success:function (data) {
                var obj = $.parseJSON(data);

                if (obj.success) {

                    $('#name<?=$currency->id?>').text(name);
                    $('#code<?=$currency->id?>').text(code);

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