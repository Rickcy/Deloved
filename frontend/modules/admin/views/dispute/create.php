<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 05.10.17
 * Time: 1:57
 */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->title = Yii::t('app', 'Открытие Спора');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dispute'), 'url' => ['index']];
?>
<div class="dispute-create">
    <h3 class="text-left"><?= Html::encode($this->title) ?></h3>
    <div class=lead>Спор по сделке : <a href="/admin/deal/show?id=<?=$deal->id?>"><?=$deal->buyer->account->brand_name?> && <?=$deal->seller->account->brand_name?></a> </div>
    <div class=lead>Спор с предприятем: <a href="/companies/item?id=<?=$partner->account->id?>"><?=$partner->account->brand_name?></a></div>
    <div class="dispute-create">
        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
            'template' => '<div class="col-sm-2 control-label">{label}</div><div class="col-sm-6">{input}</div><div class="row"><div class="col-sm-5 col-sm-offset-3">{error}</div></div>',
        ]]); ?>

        <?= $form->field($dispute, 'detailText')->textarea(['rows'=>5,'maxlength'=>255])->label(Yii::t('app','Detail subscribe')) ?>
        <hr>

        <div class="form-group text-left">
            <?= Html::submitButton( Yii::t('app', 'Create') , ['class' =>  'btn create-btn btn-md btn-success' ]) ?>
            <?= Html::a(Yii::t('app', 'Cancel'), '/admin/deal/show?id='.$deal->id,['class' =>  'btn create-btn btn-md btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
