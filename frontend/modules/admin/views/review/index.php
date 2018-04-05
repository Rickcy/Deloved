<?php

use common\models\Review;
use common\models\User;
use yii\bootstrap\Html;

/**
 * @var $review \common\models\Review
 */
$this->title = Yii::t('app', 'Reviews');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="review-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php if($user->freeUser()):?>
        Данный контент доступен только для пользователей с  <a href="/admin/billing/index">расширенной подпиской</a>
    <?php else:;?>
    <?php if (User::checkRole(['ROLE_USER'])):?>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#my" data-toggle="tab">Мои</a></li>
            <li><a href="#about" data-toggle="tab">Обо мне</a></li>
        </ul>
    <?php endif;?>
    <div class="tab-content" style="margin-top: 15px">
        <div class="tab-pane active" id="my">

            <div class="table-responsive">
                <table border="0" class="table table-striped  table-hover">
                    <thead style="border-bottom: 3px solid rgba(176, 208, 83, 0.24)">
                    <tr>


                        <?php if (!User::checkRole(['ROLE_USER'])):?>
                            <th >  <?=Yii::t('app','Accounts')?></th>
                        <?php endif;?>
                        <?php if (User::checkRole(['ROLE_USER'])):?>
                            <th >   <?=Yii::t('app','Предприятие')?></th>
                        <?php endif;?>


                        <th >   <?=Yii::t('app','Автор')?></th>
                        <th >   <?=Yii::t('app','Оценка')?></th>
                        <th >   <?=Yii::t('app','Опубликовано')?></th>
                        <th >   <?=Yii::t('app','Date Created')?></th>
                        <?php if (!User::checkRole(['ROLE_USER'])):?>
                            <th >  <?=Yii::t('app','Действия')?></th>
                        <?php endif;?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($reviewAsAuthor)):?>
                    <?php  $i=0; foreach ($reviewAsAuthor as $review):?>
                    <tr class=<?= 0 == $i%2 ? 'even' : 'odd'?>>
                        <?php
                            $isEdit = \common\models\NewReview::findOne(['new_review_id'=>$review->id,'for_profile_id'=>$review->author->profile->id]);
                        ?>
                        <td class="review-<?=$review->id?>"><a href="/admin/review/<?=$isEdit ?'edit':'show'?>?id=<?=$review->id?>">Отзыв о <?=$review->about->brand_name?></a></td>
                        <td><?=$review->author->brand_name?></td>
                        <td><?=Review::getValue($review->value)?></td>
                        <td><?=$review->published ?'Да':'Нет'?></td>
                        <td><?=$review->date_created?></td>
                    </tr>
                    <?php  $i++; endforeach;?>
                    <?php endif;?>
                    <?php if (isset($reviewAll)):?>
                        <?php  $i=0; foreach ($reviewAll as $review):?>
                    <tr class=<?= 0 == $i%2 ? 'even' : 'odd'?>>
                        <td class="review-<?=$review->id?>"><a href="/admin/review/edit?id=<?=$review->id?>"><?=$review->author->brand_name?> --> <?=$review->about->brand_name?></a></td>
                        <td><?=$review->author->brand_name?></td>
                        <td><?=Review::getValue($review->value)?></td>
                        <td><?=$review->published ?'Да':'Нет'?></td>
                        <td><?=$review->date_created?></td>
                            <td>
                                <?= Html::a('', ['delete', 'id' => $review->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this review?'),
                                    'method' => 'post',
                                ],])?>
                            </td>
                    </tr>
                        <?php  $i++; endforeach;?>
                    <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="about">
            <div class="table-responsive">
                <table border="0" class="table table-striped  table-hover">
                    <thead style="border-bottom: 3px solid rgba(176, 208, 83, 0.24)">
                    <tr>
                        <th >   <?=Yii::t('app','Предприятие')?></th>
                        <th >   <?=Yii::t('app','Автор')?></th>
                        <th >   <?=Yii::t('app','Оценка')?></th>
                        <th >   <?=Yii::t('app','Опубликованно')?></th>
                        <th >   <?=Yii::t('app','Date Created')?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($reviewAsAbout)):?>
                    <?php  $i=0; foreach ($reviewAsAbout as $review):?>
                    <tr class=<?= 0 == $i%2 ? 'even' : 'odd'?>>
                        <td class="review-<?=$review->id?>"><a href="/admin/review/show?id=<?=$review->id?>">Отзыв о <?=$review->about->brand_name?></a></td>
                        <td><?=$review->author->brand_name?></td>
                        <td><?=Review::getValue($review->value)?></td>
                        <td><?=$review->published ?'Да':'Нет'?></td>
                        <td><?=$review->date_created?></td>
                    </tr>
                            <?php  $i++; endforeach;?>
                    <?php endif;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif;?>
</div>
