<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $service common\models\Goods */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone');
?>
<div class="services-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?if ($user->checkRole(['ROLE_USER'])):?>
        <div class="buttons">
            <?= Html::a(Yii::t('app', 'Create service'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    <?endif;?>
    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>

                <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                    <td><?=Yii::t('app', 'Accounts')?></td>
                <?endif;?>

                <td><?=Yii::t('app', 'Name')?></td>

                <td><?=Yii::t('app', 'Price')?></td>

                <td><?=Yii::t('app', 'Date Created')?></td>


                <td>Действия</td>

            </tr>
            </thead>
            <tbody>
            <?
            $i=0;
            foreach ($services as $service):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">
                    <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                        <td>
                            <?=$service->getAccount()->one()->full_name ?>
                        </td>
                    <?endif;?>
                    <td>
                        <?= Html::a($service->name, ['update', 'id' => $service->id]) ?>
                    </td>

                    <td>
                        <?=$service->price ?> <?=$service->getCurrency()->one()->name?>/<?=$service->getMeasure()->one()->full_name?>
                    </td>

                    <td><?=Yii::$app->formatter->asDatetime($service->date_created+($timeZone*60), "php:d.m.Y H:i:s");?></td>

                    <td>
                        <?= Html::a('', ['delete', 'id' => $service->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this service?'),
                            'method' => 'post',
                        ],])?>
                    </td>

                </tr>
                <?
                $i++;
            endforeach;?>
            </tbody>
        </table>
    </div>
</div>
