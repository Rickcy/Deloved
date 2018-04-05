<?php

use common\models\User;
use frontend\widgets\ChangeCategory;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $good common\models\Goods */


$this->title = Yii::t('app', 'Goods');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;
?>
<div class="goods-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if ($user->checkRole(['ROLE_USER'])):?>
        <div class="buttons">
            <?php if($accsess):?>
                <?= Html::a(Yii::t('app', 'Create good'), ['create'], ['class' => 'btn btn-success']) ?>
            <?php else:?>
                <a href="javascript:void(0)" data-target="#changeCat" class='btn btn-success' data-toggle="modal"><?=Yii::t('app', 'Create good')?></a>
            <?php endif;?>
        </div>
    <?php endif;?>
    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>

                <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                <td><?=Yii::t('app', 'Accounts')?></td>
                <?php endif;?>

                <td><?=Yii::t('app', 'Name')?></td>

                <td><?=Yii::t('app', 'Price')?></td>

                <td><?=Yii::t('app', 'Date Created')?></td>


                <td>Действия</td>

            </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            foreach ($goods as $good):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">
                    <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                    <td class="good-<?=$good->id?>">
                        <?=$good->account->brand_name ?>
                    </td>
                    <?php endif;?>
                    <td>
                        <?= Html::a($good->name, ['update', 'id' => $good->id]) ?>
                    </td>

                    <td>
                        <?=$good->price ?> <?=$good->currency->name?>/<?=$good->measure->full_name?>
                    </td>
                  
                    <td><?=(new DateTime($good->date_created))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></td>

                    <td>
                        <?= Html::a('', ['delete', 'id' => $good->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this good?'),
                            'method' => 'post',
                        ],])?>
                    </td>

                </tr>
                <?php
                $i++;
            endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<?php if (User::checkRole(['ROLE_USER'])){
    echo  ChangeCategory::widget(['urlRed'=>'/admin/goods/create','isItem'=>'good']);
}
?>

