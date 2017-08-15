<?php
/* @var $this yii\web\View */
/* @var $model common\models\SuggestionCat */
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Contact us');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title" style="text-align: left"><?=Yii::t('app', 'Update Category')?></h4>
</div>


<div class="modal-body">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label']], 'enableAjaxValidation' => true,
        'validationUrl' => Url::to(['/validate/sug-cat']),
    ])
    ?>

    <?=$form->field($model , 'name')->textInput(['id'=>'category-name'])?>
    <?php $items = ArrayHelper::map([['id'=>1,'name'=>'Внутренняя связь'],['id'=>2,'name'=>'Внешняя связь']],'id','name');
    echo $form->field($model, 'type')->dropDownList($items,['id'=>'category-type'])->label('')?>



    <?php ActiveForm::end(); ?>
</div>
<div class="modal-footer">
    <div class="form-group">
        <?= Html::button( Yii::t('app', 'Update Category'), ['class' =>'btn btn-success','onclick'=>'editCategory()']) ?>
    </div>

</div>
<script>
    function editCategory() {
        var id,name,type,type_name;
        id =<?=$model->id?>;
        name = $('#category-name').val();
        type = $('#category-type').val();
        type_name = Number(type)===1?'Внутренняя связь':'Внешняя связь';
        console.log(id);
        console.log(name);
        console.log(type);


        $.ajax({
            type:'POST',
            url:'/admin/suggestion/edit-category?id='+id+'&name='+name+'&type='+type,
            success:function (data) {
                var obj = $.parseJSON(data);

                if (obj.success) {

                    $('#name<?=$model->id?>').text(name);
                    $('#type<?=$model->id?>').text(type_name);


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

