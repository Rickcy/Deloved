
<?php use common\models\Review;
use common\models\User;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/**
 * @var $to \common\models\Profile
 * @var $from \common\models\Profile
 * @var $review \common\models\Review
 */

$to = $review->about->profile;
$from = $review->author->profile;
$deal = $review->deal;
$this->title = Yii::t('app','Edit Review');
?>
<div id="create-review" >

    <h2><?=$this->title?></h2>

    <div class="row">
        <div class="col-md-9">

            <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal'], 'fieldConfig' => [
                'template' => '<div class="col-sm-3 control-label">{label}</div><div class="col-sm-5">{input}</div><div class="row"><div class="col-sm-5 col-sm-offset-3">{error}</div></div>',
            ]]); ?>
            <?php if(User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>


                            <?= $form->field($review, 'published',[
                            ])->radioList([
                                1 => 'Да',
                                0 =>'Нет',


                            ],  [
                                'class' => 'btn-group',
                                'data-toggle' => 'buttons',
                                'value' => 0,
                                'item' => function ($index, $label, $name, $checked, $value) {
                                    return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                                        Html::radio($name, $checked, ['value' => $value]) . $label . '</label>';
                                },
                            ])->label(Yii::t('app','Публикация')); ?>


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
            <?php if(User::checkRole(['ROLE_USER'])):?>
                <?= $form->field($review, 'content')->textarea(['rows'=>8,'maxlength' => 2000,'class'=>'form-control','style'=>'resize: none'])->label(Yii::t('app','Содержание')) ?>

                <?php if (isset($review->remark)):?>
                <div class="fieldcontain form-group">
                        <label class="col-sm-3 control-label" style="color: red">
                            Нарушения
                        </label>
                        <div class="col-sm-9">
                            <p class="form-control-static">
                                <?=$review->remark?>
                            </p>
                            <div class="pods">Отзыв не будет опубликован до тех пор, пока не будут устранены все нарушения.</div>
                        </div>
                    </div>

                <?php endif;?>
            <?php endif;?>

            <?php if(User::checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>

                        <?= $form->field($review, 'remark')->textarea(['rows'=>8,'maxlength' => 2000,'class'=>'form-control','style'=>'resize: none'])->label(Yii::t('app','Замечания')) ?>

            <?php endif;?>
            <div class="form-group text-left">
                <?= Html::submitButton( Yii::t('app', 'Update Review') , ['class' =>  'btn create-btn btn-md btn-success' ]) ?>
                <?= Html::a(Yii::t('app', 'Cancel'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>