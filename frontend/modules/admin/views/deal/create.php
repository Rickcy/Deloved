<?php
/**@var $otherAccount \common\models\Account **/
/**@var $good \common\models\Goods **/
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->title = Yii::t('app', 'Create Deal');
Yii::$app->formatter->timeZone = 'UTC';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="goods-create">
    <h3 class="text-left"><?= Html::encode($this->title) ?></h3>

    <div class="goods-create">
        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
            'template' => '<div class="col-sm-3 control-label">{label}</div><div class="col-sm-5">{input}</div><div class="row"><div class="col-sm-5 col-sm-offset-3">{error}</div></div>',
        ]]); ?>
        <h3>Сделка предлагается предприятию : <a href="/companies/item?id=<?=$otherAccount->id?>"><?=$otherAccount->brand_name?></a></h3>
        <hr>
        <?php if(isset($good)):?>
        <?php if($good):?>
        <h3>Наименование : <?=$good->name?>   за <?=$good->price?> <?=$good->currency->name?> за 1 <?=$good->measure->name?> </h3>
        <?php endif;?>
        <?php endif;?>

        <?= $form->field($deal, 'isBuyer',[
        ])->radioList([
            '1' => 'Я хочу купить',
            '0' =>'Я хочу продать',

        ],  [
            'class' => 'btn-group',
            'data-toggle' => 'buttons',
            'value' => 1,
            'item' => function ($index, $label, $name, $checked, $value) {
                return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
            },
        ])->label(Yii::t('app','Select your status')); ?>
        
        <hr>
        <?php if (!$good):?>
        <?= $form->field($deal, 'detailText')->textarea(['rows'=>6,'required'=>'required'])->label(Yii::t('app','Content'))?>
        <?php endif;?>
        <div class="form-group text-left">
            <?= Html::submitButton( Yii::t('app', 'Create Deal') , ['class' =>  'btn create-btn btn-md btn-success' ]) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
