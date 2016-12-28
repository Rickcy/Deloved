<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\AutoComplete;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title" style="text-align: left">Редактирование Профиля</h4>
</div>


<div class="modal-body">


    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label']], 'enableAjaxValidation' => true,
        'validationUrl' => Url::to(['/validate/profile']),
    ])
    ?>



    <?= $form->field($model, 'fio')->textInput(['maxlength' => true,'id'=>'profile-fio']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'id'=>'profile-email']) ?>

    <?= $form->field($model, 'avatar_id')->textInput(['id'=>'profile-avatar']) ?>

    <?= $form->field($model, 'city_name')->widget(
        AutoComplete::className(), [

        'clientOptions' => [
            'source' => $city_list,
            'minLength' => 2,
        ],
        'options'=>[
            'class'=>'form-control profile-city',

            'value'=>$model->city->name,
        ],
    ])->label('Город');
    ?>




    <?= $form->field($model, 'chargeStatus',[
    ])->radioList([
        '0' => 'Starting',
        '1' =>'Extended ',

    ],  [
        'class' => 'btn-group ',
        'data-toggle' => 'buttons',
        'unselect' => null,
        'item' => function ($index, $label, $name, $checked, $value) {
            return '<label class="btn btn-default ' . ($checked ? ' active profile-status' : '') . '">' .
            Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
        },
    ]); ?>



    <?= $form->field($model, 'date', ['template' => '{label}<div class="col-sm-4">{input}{error}{hint}</div>'])->widget(
        DatePicker::className(), [
        'value' => $model->date,

        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'mm/dd/yyyy',


        ]
    ])->label('Дата регистрации');?>


    <?php ActiveForm::end(); ?>


    <div class="form-group">
        <?= Html::button( Yii::t('app', 'Update profile'), ['class' =>'btn btn-success','onclick'=>'editProfile()']) ?>
    </div>

</div>
<script>
   function editProfile(){
      var id_profile =<?=$model->id?>;
      var fio = $('#profile-fio').val();
      var email = $('#profile-email').val();
      var city = $('#profile-city_name').val();
      var status = $('.profile-status>input').val();
      var chargetill =  $('#profile-date').val();
       console.log(fio);
       console.log(email);
       console.log(city);
       console.log(status);
       console.log(chargetill);

       $.ajax({
           type:'POST',
           url:'/admin/profile/edit-profile/?id='+id_profile+'&fio='+fio+'&email='+email+'&city='+city+'&status='+status+'&date='+chargetill,
           success:function (data) {
               var obj = $.parseJSON(data);

               if (obj.success) {
                   showMessage('success', obj.success)
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
