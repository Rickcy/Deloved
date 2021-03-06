<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\AutoComplete;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $region common\models\Region */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title" style="text-align: left"><?=Yii::t('app', 'Update profile')?></h4>
</div>


<div class="modal-body">

    <ul class="nav nav-tabs">
        <li class="active"><a href="#main" data-toggle="tab">Общие данные</a></li>

        <?php if (in_array($model->user->role->role_name, ['ROLE_ADMIN','ROLE_MANAGER','ROLE_JURIST','ROLE_JUDGE','ROLE_MEDIATOR','ROLE_SUPPORT'])):?>

            <li><a href="#region" data-toggle="tab">Присвоенные Регионы</a></li>
        <?php endif;?>

    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="main">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label']], 'enableAjaxValidation' => true,
        'validationUrl' => Url::to(['/validate/profile']),
    ])
    ?>



    <?= $form->field($model, 'fio')->textInput(['maxlength' => true,'id'=>'profile-fio']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'id'=>'profile-email']) ?>


    <?php if (in_array($model->user->role->role_name, ['ROLE_ADMIN','ROLE_MANAGER','ROLE_JURIST','ROLE_JUDGE','ROLE_MEDIATOR','ROLE_SUPPORT'])):?>

        <?= $form->field($model, 'experience')->textInput(['id'=>'profile-exp','value'=>$model->getExperience()->one()->experience])->label(Yii::t('app','Experience')) ?>

    <?php endif;?>

    <?= $form->field($model, 'city_name')->widget(
        AutoComplete::className(), [

        'clientOptions' => [
            'source' => $city_list,
            'minLength' => 2,
        ],
        'options'=>[
            'class'=>'form-control profile-city',

            'value'=>isset($model->city->name)?$model->city->name:'',
        ],
    ])->label('Город');
    ?>




    <?= $form->field($model, 'chargeStatus',[
    ])->radioList([
        '0' => Yii::t('app','Starting'),
        '1' =>Yii::t('app','Extended'),

    ],  [
        'class' => 'btn-group ',
        'data-toggle' => 'buttons',
        'item' => function ($index, $label, $name, $checked, $value) {
            return '<label class="btn btn-default ' . ($checked ? ' active ' : '') . '">' .
            Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
        },
    ]); ?>



    <?= $form->field($model, 'date', ['template' => '{label}<div class="col-sm-5">{input}{error}{hint}</div>'])->widget(
        DatePicker::className(), [
        'options'=>[
            'value'=>$model->chargeTill!=null?Yii::$app->formatter->asDatetime($model->chargeTill, "php:m/d/y"):''
        ],
        'type' => 2,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'm/d/yy',


        ]
    ])->label('Срок подписки');?>


    <?php ActiveForm::end(); ?>

</div>

        <?php if (in_array($model->user->role->role_name, ['ROLE_ADMIN','ROLE_MANAGER','ROLE_JURIST','ROLE_JUDGE','ROLE_MEDIATOR','ROLE_SUPPORT'])):?>

        <div class="tab-pane" id="region">

            <ul>
                <?php foreach ($regions as $region):?>

                    <?php if ($region->parent_id!=null&&$region->getParent()->one()->parent_id==null):?>

                        <li id="<?=$region->id?>" data-jstree=<?=$region->equelsVar($region->id,$myRegions)?>><?=$region->name?>
                            <ul>
                                <?php foreach ($regions as $c):?>

                                    <?php if ($c->parent_id===$region->id):?>

                                        <li id="<?=$c->id?>" data-jstree=<?=$c->equelsVar($c->id,$myRegions)?>><?=$c->name?>

                                        </li>
                                    <?php endif?>




                                <?php endforeach;?>
                            </ul>
                        </li>


                    <?php endif;?>


                <?php endforeach;?>
            </ul>

        </div>
            <script>
                $(function () {
                    $('#region') .on('changed.jstree', function (e, data) {
                            var i, j, r = [];
                            for(i = 0, j = data.selected.length; i < j; i++) {
                                r.push(data.instance.get_node(data.selected[i]).id);
                            }
                            $('#region_values').val(r.join(','));
                            console.log($('#region_values').val());




                        })
                        .jstree({
                            "core" : {
                                "themes" : {
                                    "variant" : "large"
                                }
                            },
                            "checkbox" : {
                                "keep_selected_style" : true
                            },
                            "plugins" : [ "checkbox","wholerow" ]
                        });
                })
            </script>

            <input id="region_values" class="hidden"/>
        <?php endif;?>


<div class="modal-footer">
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
      var status = $('#profile-chargestatus>label.active>input').val();
      var chargetill =  $('#profile-date').val();
      var exp =  $('#profile-exp').val();
      if (exp==undefined){
          exp='null'
      }
      var regions_values =$('#region_values')
       var regions =[];
       regions_values.each(function () {
           regions.push($(this).val())
       });


       $.ajax({
           type:'POST',
           url:'/admin/profile/edit-profile/?id='+id_profile+'&fio='+fio+'&email='+email+'&city='+city+'&status='+status+'&date='+chargetill+'&experience='+exp+'&regions='+regions,
           success:function (data) {

               var obj = $.parseJSON(data);

               if (obj.success) {
                   showMessage('success', obj.success);
                   if(email!=''){ $('#email-profile<?=$model->id?>>a').text(email)}

                   $('#fio-profile<?=$model->id?>').text(fio);

                  $('#city-profile<?=$model->id?>').text(city);



                   $('#myModal').modal('hide');
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
