<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Account */
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

use yii\jui\AutoComplete;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Account */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Create Account');

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
        
        <li><a href="#seo" data-toggle="tab">SEO</a></li>
        <li><a href="#cat" data-toggle="tab">Категории</a></li>

    </ul>
    <div class="tab-content" style="margin-top: 15px">
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

            <?= $form->field($model, 'profile_name')->widget(
                AutoComplete::className(), [

                'clientOptions' => [
                    'source' => $profiles,
                    'minLength' => 2,
                ],
                'options'=>[
                    'class'=>'form-control'
                ],
            ])->label('Профиль');
            ?>
         

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



            <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'brand_name')->textInput(['maxlength' => true]) ?>

            <?php $items = ArrayHelper::map($org_forms,'id','name');

            echo $form->field($model, 'org_form_id')->dropDownList($items)->label('Организационно-правовая форма')?>

            <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'ogrn')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'legal_address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'date', ['template' => '{label}<div class="col-sm-4">{input}{error}{hint}</div>'])->widget(
                DatePicker::className(), [
                'value' => '12/31/2010',
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'mm/dd/yyyy',

                ]
            ])->label('Дата регистрации');?>

        </div>

        <div class="tab-pane" id="contacts">

            <?= $form->field($model, 'city_name')->widget(
                AutoComplete::className(), [

                'clientOptions' => [
                    'source' => $city_list,
                    'minLength' => 2,
                ],
                'options'=>[
                    'class'=>'form-control'
                ],
            ])->label('Адрес офиса');
            ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'director')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone1')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'work_time')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'web_address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        </div>



        <div class="tab-pane" id="seo">

            <?= $form->field($model, 'description')->textarea(['rows' => 5]) ?>


            <?= $form->field($model, 'keywords')->textarea(['rows' => 3]) ?>

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
                        <?php
                        $i=0;
                        foreach ($categoryType as $catType ):?>

                            <div  class="tab-pane <?=$i==0?"active":""?>" id="<?=$catType->code?>">



                                <ul>
                                    <?php foreach ($category as $cat):?>

                                        <?php if ($cat->categorytype_id==$catType->id&&$cat->parent_id!=1&&$cat->getParent()->one()->parent_id==1):?>

                                            <li id="<?=$cat->id?>"><?=$cat->name?>
                                              
                                            </li>


                                        <?php endif;?>


                                    <?php endforeach;?>
                                </ul>



                            </div>
                            <script>
                                $(function () {
                                    $('#<?=$catType->code?>').jstree({
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
                                    $('#<?=$catType->code?>') .on('changed.jstree', function (e, data) {
                                        var i, j, r = [];
                                        for(i = 0, j = data.selected.length; i < j; i++) {
                                            r.push(data.instance.get_node(data.selected[i]).id);
                                        }
                                        $('#<?=$catType->code=='GOOD'?'account_category_goods':'account_category_service'?>').val(r.join(', '));



                                    })
                                })
                            </script>
                            <?php
                            $i++;
                        endforeach;?>

                    </div>

                </div>



            </div>


            <?= $form->field($model, 'account_category_goods')->hiddenInput(['id'=>'account_category_goods'])->label('') ?>


            <?= $form->field($model, 'account_category_service')->hiddenInput(['id'=>'account_category_service'])->label('') ?>


        </div>

    </div>



    <p><?=$model->rating?></p>
    <p><?=$model->profile_id?></p>
    <p><?=$model->created_at?></p>
    <p><?=$model->updated_at?></p>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Create Account'), ['class' =>  'btn create-btn btn-md btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>

    </div>


    <?php ActiveForm::end(); ?>

</div>