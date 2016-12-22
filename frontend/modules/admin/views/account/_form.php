<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
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

            <?= $form->field($model->getUser()->one()->getProfiles()->one(), 'fio')->textInput(['maxlength' => true]) ?>

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

            <div class="form-group field-account-date_reg">
                <label class="col-sm-3 control-label" for="account-date_reg">Дата Регистрации</label><div class="col-sm-9"><input type="text" id="account-date_reg" class="form-control" name="Account[date_reg]" value="<?=Yii::$app->formatter->asDatetime($model->date_reg, "php:d.m.Y");?>" maxlength="255"></div><div class="col-sm-9 col-sm-offset-3"><div class="help-block"></div></div>
            </div>

        </div>

        <div class="tab-pane" id="contacts">

            <?= $form->field($model, 'city_id')->textInput() ?>

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

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

        </div>

        <div class="tab-pane" id="cat">
            Category

        </div>

    </div>



        <p><?=$model->rating?></p>
        <p><?=$model->user_id?></p>
        <p><?=$model->created_at?></p>
        <p><?=$model->updated_at?></p>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
