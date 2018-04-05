<?php
/**
 * @var $review \common\models\Review
 */

use yii\bootstrap\Html;

$to = $review->about->profile;
$from = $review->author->profile;
$deal = $review->deal;
?>
<div id="review-show">

    <h2><?=$this->title?></h2>

    <div class="row">
        <div class="col-md-9">
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

            <div class="fieldcontain form-group">
                <label class="col-sm-3 control-label">
                    Отзыв о
                </label>
                <div class="col-sm-9">
                    <a href="/companies/item?id=<?=$review->about->id?>">
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

            <div class="fieldcontain form-group">
                <label class="col-sm-3 control-label">
                    Содержание
                </label>
                <div class="col-sm-9">
                    <p class="form-control-static">
                        <?=$review->content?>
                    </p>
                </div>
            </div>
            <?= Html::a(Yii::t('app', 'Назад'), ['index'],['class' =>  'btn create-btn btn-md btn-default']) ?>
        </div>
    </div>
</div>
