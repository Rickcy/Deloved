<?php


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Account */
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

use yii\jui\AutoComplete;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

/* @var $form yii\widgets\ActiveForm */
$this->title =  $model->full_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accounts'), 'url' => ['index']];

$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div>

    <h3><?= Html::encode($this->title) ?></h3>




    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
        'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
        'labelOptions' => ['class' => 'col-sm-3 control-label'],
    ],]); ?>

    <ul class="nav nav-pills nav-justified">
        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
        <li><a href="#contacts" data-toggle="tab">Контакты</a></li>
        <li><a href="#affiliates" data-toggle="tab">Филиалы</a></li>
        <li><a href="#seo" data-toggle="tab">SEO</a></li>
        <li><a href="#cat" data-toggle="tab">Категории</a></li>

    </ul>

    <div class="tab-content" style="margin-top: 15px;min-height: 300px">

        <div class="tab-pane active" id="main">
            <?= $form->field($model, 'public_status',[
            ])->radioList([
                '1' => 'ON',
                '0' =>'OFF',

            ],  [
                'class' => 'btn-group',
                'data-toggle' => 'buttons',
                'unselect' => null,
                'item' => function ($index, $label, $name, $checked, $value) {
                    return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
                },
            ]); ?>

            <?= $form->field($model, 'verify_status',[

            ])->radioList([
                '1' => 'ON',
                '0' =>'OFF',

            ],  [
                'class' => 'btn-group',
                'data-toggle' => 'buttons',
                'unselect' => null,
                'item' => function ($index, $label, $name, $checked, $value) {
                    return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
                },
            ]); ?>

            <?php  $items = ArrayHelper::map($profiles,'id','fio');
            $params = [
                'prompt' => 'Не выбрано'
            ];
            echo $form->field($model, 'profile_id')->dropDownList($items,$params)->label('Профиль')?>


            <?= $form->field($model, 'show_main',[


            ])->radioList([
                '1' => 'Yes',
                '0' =>'No',

            ],  [
                'class' => 'btn-group',
                'data-toggle' => 'buttons',
                'unselect' => null,
                'item' => function ($index, $label, $name, $checked, $value) {
                    return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
                },
            ]); ?>

    <div class="row">
                <label class="col-sm-3 control-label">

                    Логотип
                </label>

                <div class="col-sm-9">

                    <div  id="image-template">
                        <?php if ($logo):?>
                            <?php foreach ($logo as $logo):?>
                                <img style='max-width: 25%;margin: 10px' src="<?=$logo['file']?>" /><span style="cursor: pointer" class='deleteLogo' >X</span>
                            <?php endforeach;?>
                        <?php endif;?>
                        <?php if (!$logo):?>
                            <img style='max-width: 25%;margin: 10px' src="/uploads/default/logo_default.png" />
                        <?php endif;?>
                    </div>
        
                </div>

    </div>





            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'brand_name')->textInput(['maxlength' => true]) ?>

            <?php  $items = ArrayHelper::map($org_forms,'id','name');

            echo $form->field($model, 'org_form_id')->dropDownList($items)->label('Организационно-правовая форма')?>

            <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'ogrn')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'legal_address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'date', ['template' => '{label}<div class="col-sm-5">{input}{error}{hint}</div>'])->widget(
                DatePicker::className(), [
                'options'=>[
                    'value'=>$model->date_reg!=null?Yii::$app->formatter->asDatetime($model->date_reg, "php:m/d/y"):''
                ],
                'type' => 2,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'm/d/yy',


                ]
            ])->label('Срок подписки');?>

        </div>

        <div class="tab-pane" id="contacts">

            <?= $form->field($model, 'city_name')->widget(
                AutoComplete::className(), [

                'clientOptions' => [
                    'source' => $city_list,
                    'minLength' => 2,
                ],
                'options'=>[
                    'class'=>'form-control',
                    'value'=>$model->city->name,
                ],
            ])->label('Город');
            ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone1')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'work_time')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'web_address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="tab-pane" id="affiliates">

                <div class="col-md-3 col-lg-3 col-sm-3 col-xs-2"></div>
                <div class="value-col ft">


                    <ul id="affTabNav" class="nav nav-pills">
                        <?php $i=0;
                        foreach ($myAffiliates as $aff):?>
                            <li class="<?=$i==0?'active':''?>"><a id="hrefaff<?=$i?>" data-toggle="tab" href="#aff<?=$i?>"><?=$i+1?></a></li>
                            <?php $i++;
                        endforeach;?>

                    </ul>




                        <div id="affTabContent" class="tab-content">
                            <?php $i=0;
                            foreach ($myAffiliates as $aff):?>
                                <?=$this->render("affiliate",['myAccount'=>$model,'i'=>$i,'aff'=>$aff,'count'=>$count,'active'=>false,'city_list'=>$city_list])?>
                                <?php $i++;
                            endforeach;?>

                        </div>


                </div>






        </div>

        <div class="tab-pane" id="seo">

            <?= $form->field($model, 'description')->textarea(['rows'=>5]) ?>


            <?= $form->field($model, 'keywords')->textarea(['rows'=>3]) ?>

        </div>


        <div class="tab-pane" id="cat">


            <div class="col-sm-8 ">


                <div class="tab-pane" id="cat" >
                    <ul class="nav nav-pills" style="margin-bottom: 20px">
                        <?php
                        $i=0;
                        foreach ($categoryType as $catType ):?>

                            <li style="font-size: 16pt;" class="<?=$i==0?"active":""?>"><a href="#<?=$catType->code?>" data-toggle="tab"><?=$catType->code=='GOOD'?'Категория  товаров':'Категория услуг'?></a></li>

                            <?php
                            $i++;
                        endforeach;?>
                    </ul>

                    <div class="tab-content ">
                        <?php $i=0;
                        foreach ($categoryType as $catType ):?>

                            <div  class="tab-pane <?=$i==0?"active":""?>" id="<?=$catType->code?>">



                                <ul>
                                    <?php foreach ($category as $cat):?>

                                        <?php if ($cat->categorytype_id==$catType->id&&$cat->parent_id!=1&&$cat->getParent()->one()->parent_id==1227):?>

                                            <li id="<?=$cat->id?>" data-jstree=<?=$cat->equelsVar($cat->id,$myCategory)?>><?=$cat->name?>
                                              
                                            </li>


                                        <?php endif;?>


                                    <?php endforeach;?>
                                </ul>



                            </div>
                            <script>
                                $(function () {
                                    $('#<?=$catType->code?>') .on('changed.jstree', function (e, data) {
                                            var i, j, r = [];
                                            for(i = 0, j = data.selected.length; i < j; i++) {
                                                r.push(data.instance.get_node(data.selected[i]).id);
                                            }
                                            $('#<?=$catType->code=='GOOD'?'account_category_goods':'account_category_service'?>').val(r.join(','));

                                            if($("#saveCategory").hide()){
                                                $("#saveCategory").show()
                                            }


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
                            <?php
                            $i++;
                        endforeach;?>
                    </div>

                </div>



            </div>
            <div class="col-sm-2">
                <a href="javascript:void(0)" class="btn btn-success" style="width:100%" id="saveCategory">Сохранить</a>
            </div>

            <?= $form->field($model, 'account_category_goods')->hiddenInput(['id'=>'account_category_goods'])->label('') ?>


            <?= $form->field($model, 'account_category_service')->hiddenInput(['id'=>'account_category_service'])->label('') ?>

            <script>
                $(document).ready(function() {

                    $("#saveCategory").click(function () {
                        var goods = $("#account_category_goods");
                        var category_goods = [];
                        goods.each(function () {
                            category_goods.push($(this).val())
                        });
                        var service = $("#account_category_service");
                        var category_services = [];
                        service.each(function () {
                            category_services.push($(this).val())
                        });


                        $.ajax({
                            type: 'POST',
                            url: '/admin/account/save-category/?goods=' + category_goods + '&service=' + category_services+<?='\'&id='.$model->id."'"?>,
                            success: function (data) {
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
                    });

                })
            </script>
        </div>


       </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update Account'), ['class' =>  'btn create-btn btn-md btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>

    </div>

    <?php ActiveForm::end(); ?>




</div>