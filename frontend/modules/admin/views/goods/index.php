<?php

use common\models\User;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $good common\models\Goods */
/* @var $searchModel common\models\search\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Goods');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone');
?>
<div class="goods-index">
<?//=$array = DateTimeZone::listIdentifiers();
//foreach($array as $value):?>
<!--    <p>--><?//=$value?><!--</p>-->
<?//endforeach;?>

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?if ($user->checkRole(['ROLE_USER'])):?>
        <div class="buttons">
            <?= Html::a(Yii::t('app', 'Create good'), ['create'], ['class' => 'btn btn-success']) ?>
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
            foreach ($goods as $good):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">
                    <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                    <td>
                        <?=$good->getAccount()->one()->full_name ?>
                    </td>
                    <?endif;?>
                    <td>
                        <?= Html::a($good->name, ['update', 'id' => $good->id]) ?>
                    </td>

                    <td>
                        <?=$good->price ?> <?=$good->getCurrency()->one()->name?>/<?=$good->getMeasure()->one()->full_name?>
                    </td>
                  
                    <td><?=Yii::$app->formatter->asDatetime($good->date_created+($timeZone*60), "php:d.m.Y H:i:s");?></td>

                    <td>
                        <?= Html::a('', ['delete', 'id' => $good->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this good?'),
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
