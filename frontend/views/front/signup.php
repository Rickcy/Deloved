<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

/* @var $category \common\models\Category */
/* @var $cat \common\models\Category */
/* @var $c \common\models\Category */
/* @var $catType \common\models\CategoryType */

use kartik\date\DatePicker;
use yii\captcha\Captcha;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\jui\AutoComplete;

$this->title = 'Регитсрация нового пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1></h1>

<div class="shadow_block">
    <div class="row">

        <div class="col-sm-11 ">

            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
                'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
                'labelOptions' => ['class' => 'col-sm-3 control-label'],
            ],]); ?>
            <h1 style="font-weight: bold;text-align:left!important;color:rgb(148, 196, 61)"><?= Html::encode($this->title) ?>
                <div style="background-image: linear-gradient(270deg, rgb(248, 215, 53), rgb(148, 196, 61) 110%);
			width: 98%;
			height: 4px;"></div></h1>

            <h3 class="text_reg_1">Данные пользователя для авторизации</h3>

            <div class="signup_desc">После регистрации на вашу почту придет письмо об активации.</div>

            <?= $form->field($model, 'fio')->textInput(['autofocus' => true])->label('Имя') ?>

            <?= $form->field($model, 'email')->textInput(['placeholder'=>'name@domain'])->label('Введите адрес эл. почты') ?>

                <?= $form->field($model, 'username')->textInput()->label('Введите логин') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Введите пароль') ?>

                <?= $form->field($model,'repassword')->passwordInput()->label('Повторите пароль') ?>

            

            <hr>

            <h3 class="text_reg_1">Данные предприятия/предпринимателя</h3>

            <div class="signup_desc">Заполните поля в соответствии с данными ЕГРЮЛ/ЕГРИП. Обратите внимание на примеры </div>
            <? $items = ArrayHelper::map($org_forms,'id','name');
            $params = [
                'prompt' => 'Не выбрано'
            ];
            echo $form->field($model, 'org_form_id')->dropDownList($items,$params)->label('Организационно-правовая форма')?>

            <?= $form->field($model, 'full_name')->textInput()->label('Полное наименование') ?>

            <?= $form->field($model, 'brand_name')->textInput()->label('Фирменное название') ?>



            <?= $form->field($model, 'ogrn')->textInput()->label('ОГРН (ОГРНИП)') ?>

            <?= $form->field($model, 'inn')->textInput()->label('ИНН') ?>

            <?= $form->field($model, 'legal_address')->textInput()->label('Юридический адрес') ?>

            <?= $form->field($model, 'date', ['template' => '{label}<div class="col-sm-4">{input}{error}{hint}</div>'])->widget(
                DatePicker::className(), [
                'value' => '12/31/2010',
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'mm/dd/yyyy',
                    
                ]
            ])->label('Дата регистрации');?>


            <div class="col-sm-11 col-sm-offset-1">
                <div class="col-sm-8">
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
                </div>
            <div class="col-sm-4">
            <?= $form->field($model, 'address')->textInput()->label('') ?>
            </div>

            </div>

            <?= $form->field($model, 'director')->textInput()->label('Руководство') ?>

            <?= $form->field($model, 'phone1')->textInput()->label('Основной номер телефона') ?>

            <?= $form->field($model, 'fax')->textInput()->label('Основной факс') ?>


            <?= $form->field($model, 'work_time')->textInput()->label('Время работы') ?>

            <?= $form->field($model, 'web_address')->textInput()->label('Веб-сайт') ?>

                 <?= $form->field($model, 'description')->textarea(['rows'=>6])->label('Описание') ?>

            <?= $form->field($model, 'keywords')->textarea(['rows'=>6])->label('Ключевые слова') ?>


            <hr>
            <h3 class="text_reg_1">Категории деятельности</h3>

            <div class="signup_desc">Отметьте галочками ветки категорий товаров и услуг, которые относятся к виду вашей деятельности.</div>




            <div class="col-sm-9 col-sm-offset-3">
                

                <div class="tab-pane" id="cat" >
                    <ul class="nav nav-pills" style="margin-bottom: 20px">
                        <?
                        $i=0;
                        foreach ($categoryType as $catType ):?>

                            <li style="font-size: 16pt;" class="<?=$i==0?"active":""?>"><a href="#<?=$catType->code?>" data-toggle="tab"><?=$catType->code=='GOOD'?'Категория  товаров':'Категория услуг'?></a></li>

                        <?
                        $i++;
                        endforeach;?>
                    </ul>

                    <div class="tab-content ">
                        <?
                        $i=0;
                        foreach ($categoryType as $catType ):?>

                        <div  class="tab-pane <?=$i==0?"active":""?>" id="<?=$catType->code?>">



                                        <ul>
                                    <?foreach ($category as $cat):?>

                                    <?if ($cat->categorytype_id==$catType->id&&$cat->parent_id!=1&&$cat->getParent()->one()->parent_id==1):?>

                                            <li id="<?=$cat->id?>"><?=$cat->name?>
                                                <ul>
                                            <?foreach ($category as $c):?>

                                                <?if ($c->parent_id===$cat->id):?>

                                                    <li id="<?=$c->id?>"><?=$c->name?>
                                                        <ul>
                                                    <?foreach ($category as $item):?>
                                                        <?if ($item->parent_id===$c->id):?>
                                                      <li id="<?=$item->id?>" ><?=$item->name?></li>
                                                        <?endif;?>
                                                    <?endforeach;?>
                                                        </ul>
                                                    </li>
                                                <?endif?>




                                             <?endforeach;?>
                                                </ul>
                                            </li>


                                        <?endif;?>


                                    <?endforeach;?>
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
                        <?
                            $i++;
                        endforeach;?>

                    </div>

                </div>

                

            </div>


            <?= $form->field($model, 'account_category_goods')->hiddenInput(['id'=>'account_category_goods'])->label('') ?>


            <?= $form->field($model, 'account_category_service')->hiddenInput(['id'=>'account_category_service'])->label('') ?>


            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                'captchaAction'=>Url::to(['/front/captcha'])
            ])->label('') ?>


            <div class="form-group">
                    <?= Html::submitButton('Завершить регистрацию', ['class' => 'btn btn-md btn-success registr-btn', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
        </div>

