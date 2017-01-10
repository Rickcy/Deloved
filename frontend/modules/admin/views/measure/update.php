<?php

/** @var $measure common\models\Measure **/

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title" style="text-align: left"><?=Yii::t('app', 'Update measure')?></h4>
</div>


<div class="modal-body">
    <?$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label']], 'enableAjaxValidation' => true,
        'validationUrl' => Url::to(['/validate/measure']),
    ])
    ?>

    <?=$form->field($measure , 'name')->textInput(['id'=>'measure-name'])?>

    <?=$form->field($measure , 'full_name')->textInput(['id'=>'measure-full-name'])?>

    <? $items = ArrayHelper::map($type,'id','code');

    echo $form->field($measure, 'type_id')->dropDownList($items)->label('Категория')?>


    <?php ActiveForm::end(); ?>
</div>
<div class="modal-footer">
    <div class="form-group">
        <?= Html::button( Yii::t('app', 'Update measure'), ['class' =>'btn btn-success','onclick'=>'editMeasure()']) ?>
    </div>

</div>
<script>
    function editMeasure() {
        var id,name,full_name,type_id,type_text;
        id =<?=$measure->id?>;
        name = $('#measure-name').val();
        full_name = $('#measure-full-name').val();
        type_id = $('#measure-type_id').val();
        type_text = $('#measure-type_id option:selected').text();
        console.log(id);
        console.log(name);
        console.log(full_name);
        console.log(type_id);
        console.log(type_text);

        $.ajax({
            type:'POST',
            url:'/admin/measure/edit-measure?id='+id+'&name='+name+'&full_name='+full_name+'&type_id='+type_id,
            success:function (data) {
                var obj = $.parseJSON(data);

                if (obj.success) {

                    $('#name<?=$measure->id?>').text(name);
                    $('#full_name<?=$measure->id?>').text(full_name);
                    $('#type_id<?=$measure->id?>').text(type_text);

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
