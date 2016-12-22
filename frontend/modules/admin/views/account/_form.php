<?php

use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div>
<?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
    'template' => '{label}<div class="col-sm-9">{input}</div><div class="col-sm-9 col-sm-offset-3">{error}</div>',
    'labelOptions' => ['class' => 'col-sm-3 control-label'],
],]); ?>

    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
        <li><a href="#contacts" data-toggle="tab">Контакты</a></li>
        <li><a href="#affiliates" data-toggle="tab">Филиалы</a></li>
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


            <? $items = ArrayHelper::map($profiles,'id','fio');

            echo $form->field($model, 'profile_id')->dropDownList($items)->label('Профиль')?>

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

            <? $items = ArrayHelper::map($org_forms,'id','name');

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

        <div class="tab-pane" id="affiliates">
            Affiliates
        </div>

        <div class="tab-pane" id="seo">

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


            <?= $form->field($model, 'keywords')->textarea(['rows' => 6]) ?>

        </div>

        <div class="tab-pane" id="cat">
            Category

        </div>

    </div>



        <p><?=$model->rating?></p>
        <p><?=$model->profile_id?></p>
        <p><?=$model->created_at?></p>
        <p><?=$model->updated_at?></p>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
