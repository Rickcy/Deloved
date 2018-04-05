<?php

use common\models\Consult;
use common\models\Deal;

use common\models\User;
use yii\bootstrap\Html;
$this->title = Yii::t('app', 'Jurist Help');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;

?>
<div class="consult-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if($user->freeUser()):?>
        Данный контент доступен только для пользователей с  <a href="/admin/billing/index">расширенной подпиской</a>
    <?php else:;?>
    <?php if (User::checkRole(['ROLE_USER'])):?>
        <div class="buttons">
            <?= Html::a(Yii::t('app', 'Create a question for jurist'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    <?php endif;?>
    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', '№')?></td>

                <td><?=Yii::t('app', 'Предприятие')?></td>


                <td><?=Yii::t('app', 'Status')?></td>

                <td><?=Yii::t('app', 'Date Created')?></td>
                <?php if (User::checkRole(['ROLE_ADMIN','ROLE_MANGER','ROLE_JURIST'])):?>
                    <td><?=Yii::t('app', 'Действия')?></td>
                <?php endif;?>
            </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            /**
             * @var $consult \common\models\Consult
             */
            foreach ($consults as $consult):?>
                <tr class=<?=$i%2 == 0 ? 'even' : 'odd'?>>

                    <td >
                        <?= $consult->id ?>

                    </td>

                    <td class="consult-<?=$consult->id?>">
                        <?= Html::a($consult->profile->account->brand_name, ['show', 'id' => $consult->id]) ?>

                    </td>
                    <td>
                        <?= Consult::getNameStatus($consult->status) ?>
                    </td>


                    <td><?=(new DateTime($consult->date_created))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></td>

                    <?php if (User::checkRole(['ROLE_ADMIN','ROLE_JURIST'])):?>
                        <td>   <?= Html::a('', ['delete', 'id' => $consult->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this consult?'),
                                'method' => 'post',
                            ],])?></td>


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