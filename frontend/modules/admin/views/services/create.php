<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Services */
/* @var $cat common\models\AccountCategory */

$this->title = Yii::t('app', 'Create services');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="services-create">

        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal','enctype' => 'multipart/form-data'], 'fieldConfig' => [
            'template' => '<div class="col-sm-3 control-label">{label}</div><div class="col-sm-7">{input}</div><div class="col-sm-7 col-sm-offset-3">{error}</div>',
        ]]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>



        <div class="col-sm-12 col-sm-offset-0">
            <div class="col-sm-7">
                <?= $form->field($model, 'price',['template' => '<div class="col-sm-5 control-label">{label}</div><div class="col-sm-7">{input}</div><div class="col-sm-7 col-sm-offset-5">{error}</div>',])->textInput() ?>
            </div>
            <div class="col-sm-4">
                <?$items = ArrayHelper::map($currency,'id','code');
                echo $form->field($model, 'currency_id',['template' => '<div class="col-sm-1"></div><div class="col-sm-8">{input}</div><div class="col-sm-9 col-sm-offset-1">{error}</div>',])->dropDownList($items) ?>
            </div>

        </div>


        <? $items = ArrayHelper::map($measure,'id','full_name');

        echo $form->field($model, 'measure_id')->dropDownList($items)?>


        <?= $form->field($model, 'description')->textarea(['rows' =>5]) ?>


        <hr>


        <?$items = ArrayHelper::map($paymentMethods,'id','name');
        echo $form->field($model, 'payment_methods_id')->dropDownList($items) ?>

        <hr>








        <?= $form->field($model, 'photo_id')->fileInput(['id'=>'imgInput']) ?>

        <?= $form->field($model, 'category_id')->hiddenInput(['id'=>'cat'])->label('Категория услуги') ?>
        <div id="myCat">
            <ul>
                <?foreach ($myCategory as $cat):?>
                    <?if ($cat->getCategory()->one()->getCategorytype()->one()->id==2&&$cat->getCategory()->one()->parent_id!=1&&$cat->getCategory()->one()->getParent()->one()->parent_id==1):?>
                        <li id="<?=$cat->getCategory()->one()->id?>"><?=$cat->getCategory()->one()->name?>
                            <ul>
                                <?if ($cat->getCategory()->one()->getChild()->all()):?>
                                    <?foreach ($cat->getCategory()->one()->getChild()->all() as $child):?>
                                        <li id="<?=$child->id?>">
                                            <?=$child->name?>
                                            <ul>

                                                <?if ($child->getChild()->all()):?>

                                                    <?foreach ($child->getChild()->all() as $c):?>
                                                        <li id="<?=$c->id?>"><?=$c->name?></li>
                                                    <?endforeach;?>


                                                <?endif;?>
                                            </ul>
                                        </li>

                                    <?endforeach;?>

                                <?endif;?>
                            </ul>
                        </li>
                    <?endif;?>

                <?endforeach;?>

            </ul>
        </div>
        <script>
            $(function () {
                $('#myCat') .on('changed.jstree', function (e, data) {
                        var val = '';
                        if (data.selected.length > 0) {
                            val = data.selected[0];
                        }
                        $('#cat').val(val);
                        console.log($('#cat').val())



                    })
                    .jstree({
                        "core" : {
                            "multiple": false,
                            "themes" : {
                                "variant" : "large"
                            }
                        },
                        "checkbox": {
                            "three_state": false,
                            "cascade": "undetermined"
                        },
                        "plugins": ["checkbox", "wholerow"]
                    });
            })
        </script>
        <hr>

        <div class="form-group">
            <?= Html::submitButton( Yii::t('app', 'Create') , ['class' =>  'btn btn-success' ]) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
<script>

    $('#imgInput').change(function () {

    })


</script>