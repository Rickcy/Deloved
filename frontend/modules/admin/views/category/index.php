<?php

use common\models\User;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', 'Name')?></td>




                <td>Действие</td>

                <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                    <td></td>
                <?endif;?>
            </tr>
            </thead>
            <tbody>
            <?
            $i=0;
            foreach ($categoryType as $catType):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td>
                        <?= $catType->name ?>
                    </td>

                    <td><?=Html::a('Развернуть', ['view', 'id' => $catType->id])?></td>


                    <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                        <td>
                            <?= Html::a('', ['delete', 'id' => $catType->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],])?>

                        </td>
                    <?endif;?>
                </tr>
                <?
                $i++;
            endforeach;?>
            </tbody>
        </table>
    </div>
</div>
