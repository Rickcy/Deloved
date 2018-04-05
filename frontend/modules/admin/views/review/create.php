
<?php use common\models\Review;
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var $to \common\models\Profile
 * @var $from \common\models\Profile
 * @var $review \common\models\Review
 */
$this->title = Yii::t('app','Write Review');
?>
<div id="create-review" >

    <h2><?=$this->title?></h2>

    <div class="row">
        <div class="col-md-12">
<?php if(User::checkRole(['ROLE_USER'])):?>
    <?php if(isset($review->value)):?>
    <div class="fieldcontain form-group">
        <label class="col-sm-3 control-label">
            Публикация
        </label>
        <div class="col-sm-9">
            <p class="form-control-static">
                <?=$review->published ? 'Да' : 'Нет'?>
            </p>
        </div>
    </div>
<?php endif;?>
<?php endif;?>

            <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
                'template' => '<div class="col-sm-3 control-label">{label}</div><div class="col-sm-5">{input}</div><div class="row"><div class="col-sm-5 col-sm-offset-3">{error}</div></div>',
            ]]); ?>
<?php if(User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>

    <div class="fieldcontain form-group">
        <label class="col-sm-3 control-label">
            Публикация
        </label>
        <div class="col-sm-9">
            <div class="btn-group" data-toggle="buttons">
<!--                <label class="btn btn-default --><?//=?><!-- <g:if test="${objInstance?.published == true}">active</g:if>">-->
<!--                <g:radio name="published" value="true" checked="${objInstance?.published == true}"/>Да-->
<!--                </label>-->
<!--                <label class="btn btn-default <g:if test="${objInstance?.published == false}">active</g:if>">-->
<!--                <g:radio name="published" value="false" checked="${objInstance?.published == false}"/>Нет-->
<!--                </label>-->
            </div>
        </div>
    </div>
<?php endif;?>

<div class="fieldcontain form-group">
    <label class="col-sm-3 control-label">
        Отзыв о
    </label>
    <div class="col-sm-9">
        <a href="/companies/item?id=<?=$to->account->id?>">
            <p class="form-control-static">
                <?=$to->account->brand_name?>
            </p>
        </a>
    </div>
</div>

<div class="fieldcontain form-group">
    <label class="col-sm-3 control-label">
        По сделке
    </label>
    <div class="col-sm-9">
        <a href="/admin/deal/show?id=<?=$deal->id?>">
            <p class="form-control-static">
                <?=$deal->buyer->account->brand_name?> & <?=$deal->seller->account->brand_name?>
            </p>
        </a>
    </div>
</div>
<?php if(User::checkRole(['ROLE_USER'])):?>
    <?php if(!isset($review->value)):?>
        <?= $form->field($review, 'value',[
        ])->radioList([
            '1' => 'Положительный',
            '0' =>'Нейтральный',
            '-1' =>'Отрицательный',

        ],  [
            'class' => 'btn-group',
            'data-toggle' => 'buttons',
            'value' => 1,
            'item' => function ($index, $label, $name, $checked, $value) {
                return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
            },
        ])->label(Yii::t('app','Оценка')); ?>

    <?php endif;?>
<?php endif;?>

<?php if(User::checkRole(['ROLE_USER'])):?>
    <?php if(isset($review->value)):?>
    <div class="fieldcontain form-group">
        <label class="col-sm-3 control-label">
            Оценка
        </label>
        <div class="col-sm-9">
            <?php if ($review->value == 1):?>
                <label class="good-review" title="Положительная оценка"><span class="glyphicon glyphicon-plus-sign"></span></label>
            <?php endif;?>
            <?php if ($review->value == 0):?>
                <label class="neutral-review" title="Нейтральная оценка"><span class="glyphicon glyphicon-record"></span></label>
            <?php endif;?>
            <?php if ($review->value == -1):?>
                <label class="bad-review" title="Отрицательная оценка"><span class="glyphicon glyphicon-minus-sign"></span></label>
            <?php endif;?>
        </div>
    </div>
    <?php endif;?>
<?php endif;?>

<?php if(User::checkRole(['ROLE_USER'])):?>
            <?= $form->field($review, 'content')->textarea(['rows'=>8,'maxlength' => 2000,'class'=>'form-control','style'=>'resize: none'])->label(Yii::t('app','Содержание')) ?>



<?php endif;?>


<?php if(User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
    <div class="fieldcontain form-group">
        <label class="col-sm-3 control-label">
            Содержание
        </label>
        <div class="col-sm-9">
            <p class="form-control-static">
                <?=$review->content?>
            </p>
            <div class="pods">Содержание отзыва</div>
        </div>
    </div>
<?php endif;?>





            <div class="form-group text-left">
                <?= Html::submitButton( Yii::t('app', 'Write Review') , ['class' =>  'btn create-btn btn-md btn-success' ]) ?>
                <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>
            </div>

            <?php ActiveForm::end(); ?>
</div>
</div>
</div>