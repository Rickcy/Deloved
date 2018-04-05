<?php

use common\models\User;
use frontend\widgets\ChangeCategory;
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $service common\models\Goods */

$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;
?>
<div class="services-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if ($user->checkRole(['ROLE_USER'])):?>
        <div class="buttons">

            <?php if($accsess):?>
                <?= Html::a(Yii::t('app', 'Create service'), ['create'], ['class' => 'btn btn-success']) ?>
            <?php else:?>
                <a href="javascript:void(0)" data-target="#changeCat" class='btn btn-success' data-toggle="modal"><?=Yii::t('app', 'Create service')?></a>
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
            foreach ($services as $service):?>
                <tr class=<?=$i%2 == 0 ? 'even' : 'odd'?>>
                    <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                        <td class="service-<?=$service->id?>" >
                            <?=$service->account->brand_name ?>
                        </td>
                    <?php endif;?>
                    <td>
                        <?= Html::a($service->name, ['update', 'id' => $service->id]) ?>
                    </td>

                    <td>
                        <?=$service->price ?> <?=$service->getCurrency()->one()->name?>/<?=$service->getMeasure()->one()->full_name?>
                    </td>

                    <td><?=(new DateTime($service->date_created))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></td>

                    <td>
                        <?= Html::a('', ['delete', 'id' => $service->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this service?'),
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
    echo  ChangeCategory::widget(['urlRed'=>'/admin/services/create','isItem'=>'service']);
}
?>
