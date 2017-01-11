<?php
/* @var $this yii\web\View */
/* @var $model common\models\SuggestionCat */
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
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
    <?$form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label']], 'enableAjaxValidation' => true,
        'validationUrl' => Url::to(['/validate/sug-cat']),
    ])
    ?>

    <?=$form->field($model , 'name')->textInput(['id'=>'category-name'])?>



    <?php ActiveForm::end(); ?>
</div>
<div class="modal-footer">
    <div class="form-group">
        <?= Html::button( Yii::t('app', 'Update Category'), ['class' =>'btn btn-success','onclick'=>'editCategory()']) ?>
    </div>

</div>
<script>
    function editCategory() {
        var id,name;
        id =<?=$model->id?>;
        name = $('#category-name').val();
       
        console.log(id);
        console.log(name);
       

        $.ajax({
            type:'POST',
            url:'/admin/suggestion/edit-category?id='+id+'&name='+name,
            success:function (data) {
                var obj = $.parseJSON(data);

                if (obj.success) {

                    $('#name<?=$model->id?>').text(name);
                    

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

