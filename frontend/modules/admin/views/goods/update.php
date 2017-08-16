<?php

use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Goods */
/* @var $cat common\models\AccountCategory */

$this->title = Yii::t('app', 'Edit good');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="goods-update">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="goods-update">

        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
            'template' => '<div class="col-sm-3 control-label">{label}</div><div class="col-sm-7">{input}</div><div class="col-sm-7 col-sm-offset-3">{error}</div>',
        ]]); ?>
        <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
            <?= $form->field($model, 'show_main',[

            ])->radioList([
                '1' => 'Да',
                '0' =>'Нет',

            ],  [
                'class' => 'btn-group',
                'data-toggle' => 'buttons',
                'value'=>$model->show_main,
                'unselect' => null,
                'item' => function ($index, $label, $name, $checked, $value) {
                    return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
                },
            ]); ?>
            
        <?php endif;?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

        <div class="col-sm-12 col-sm-offset-0">
            <div class="col-sm-7">
                <?= $form->field($model, 'price',['template' => '<div class="col-sm-5 control-label">{label}</div><div class="col-sm-7">{input}</div><div class="col-sm-7 col-sm-offset-5">{error}</div>',])->textInput() ?>
            </div>
            <div class="col-sm-4">
                <?php $items = ArrayHelper::map($currency,'id','code');
                echo $form->field($model, 'currency_id',['template' => '<div class="col-sm-1"></div><div class="col-sm-8">{input}</div><div class="col-sm-9 col-sm-offset-1">{error}</div>',])->dropDownList($items) ?>
            </div>

        </div>


        <?php  $items = ArrayHelper::map($measure,'id','full_name');

        echo $form->field($model, 'measure_id')->dropDownList($items)?>


        <?= $form->field($model, 'description')->textarea(['rows' =>5]) ?>




        <?= $form->field($model, 'availability',[

        ])->radioList([
            '1' => 'Есть в наличии',
            '0' =>'Под заказ',

        ],  [
            'class' => 'btn-group',
            'data-toggle' => 'buttons',
            'value'=>$model->availability,
            'unselect' => null,
            'item' => function ($index, $label, $name, $checked, $value) {
                return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
            },
        ]); ?>


        <hr>
        <?php $items = ArrayHelper::map($conditions,'id','name');

        echo $form->field($model, 'condition_id')->dropDownList($items) ?>

        <?php $items = ArrayHelper::map($paymentMethods,'id','name');
        echo $form->field($model, 'payment_methods_id')->dropDownList($items) ?>

        <?php $items = ArrayHelper::map($deliveryMethods,'id','name');
        echo $form->field($model, 'delivery_methods_id')->dropDownList($items) ?>
        <hr>

        <div class="col-sm-3"></div><div class="col-sm-7" id="image-template">
            <?php if($photos !=null):?>
            <?php foreach ($photos as $photo):?>
                    <span><img style='max-width: 25%;margin: 10px' src="<?=$photo['filePath']?>" /><span style="cursor:pointer;" class='deletePhotoGood' path='<?=$photo['filePath']?>' >X</span></span>
            <?php endforeach;?>
            <?php endif;?>
        </div>

        <?= $form->field($model, 'photos[]')->hiddenInput(['id'=>'imgGoodsInput'])->label('Фото') ?>
        <?php if ($user->checkRole(['ROLE_USER'])):?>
        <div class="col-sm-3"></div><div class="col-sm-7"><input type="file" accept="image/*,image/jpeg" id="imgGoods"></div>
        <?php endif;?>

        <?= $form->field($model, 'category_id')->hiddenInput(['id'=>'cat'])->label('Категория товара') ?>
        <div id="myCat">
            <ul>
                <?php foreach ($myCategory as $cat):?>
                    <?php if ($cat->category->categorytype->id==1227 && $cat->category->parent_id !=1 && $cat->category->parent->parent_id==1227):?>
                        <li id="<?=$cat->category->id?>" data-jstree=<?=$cat->category->equelsVar($cat->category->id,$model)?>><?=$cat->category->name?>
                            <ul>
                                <?php if ($cat->category->getChild()->all()):?>
                                    <?php foreach ($cat->category->getChild()->all() as $child):?>
                                        <li id="<?=$child->id?>"  data-jstree=<?=$child->equelsVar($child->id,$model)?>>
                                            <?=$child->name?>
                                            <ul>
                                                <?php if ($child->getChild()->all()):?>

                                                    <?php foreach ($child->getChild()->all() as $c):?>
                                                        <li id="<?=$c->id?>"  data-jstree=<?=$c->equelsVar($c->id,$model)?>><?=$c->name?></li>
                                                    <?php endforeach;?>

                                                <?php endif;?>
                                            </ul>
                                        </li>

                                    <?php endforeach;?>

                                <?php endif;?>
                            </ul>
                        </li>
                    <?php endif;?>

                <?php endforeach;?>

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
            <?= Html::submitButton( Yii::t('app', 'Update') , ['class' =>  'btn create-btn btn-md btn-success' ]) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
