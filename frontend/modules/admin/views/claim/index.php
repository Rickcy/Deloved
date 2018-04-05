<?php

use common\models\Claim;
use common\models\Deal;

use common\models\User;
use yii\bootstrap\Html;
$this->title = Yii::t('app', 'Claims');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;

?>
<div class="claim-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if($user->freeUser()):?>
        Данный контент доступен только для пользователей с  <a href="/admin/billing/index">расширенной подпиской</a>
    <?php else:;?>
    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', '№')?></td>

                <td><?=Yii::t('app', 'Accounts')?></td>


                <td><?=Yii::t('app', 'Status')?></td>

                <td><?=Yii::t('app', 'Date Created')?></td>
                <?php if (User::checkRole(['ROLE_ADMIN'])):?>
                    <td><?=Yii::t('app', 'Действия')?></td>
                <?php elseif (User::checkRole(['ROLE_USER'])):?>
                    <td><?=Yii::t('app', 'Ваша роль')?></td>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            /**
             * @var $ticket \common\models\Ticket
             */
            foreach ($claims as $claim):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td>
                        <?= $claim->id ?>

                    </td>

                    <td class="claim-<?=$claim->id?>">
                        <?= Html::a($claim->profile->account->brand_name.'--'.$claim->partner->account->brand_name, ['show', 'id' => $claim->id]) ?>

                    </td>
                    <td>
                        <?= Claim::getNameStatus($claim->status) ?>
                    </td>


                    <td><?=(new DateTime($claim->date_created))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></td>

                    <?php if (User::checkRole(['ROLE_ADMIN'])):?>
                        <td>   <?= Html::a('', ['delete', 'id' => $claim->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this claim?'),
                                'method' => 'post',
                            ],])?></td>

                    <?php elseif (User::checkRole(['ROLE_USER'])):?>
                        <td><?= $claim->profile_id == $user->profile->id ? 'Истец' : 'Ответчик'?></td>
                    <?php endif;?>

                </tr>
                <?php
                $i++;
            endforeach;?>
            </tbody>
        </table>
    </div>
    <?php endif;?>
</div>