<?php

use common\models\User;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$session = Yii::$app->session;
if ($session->has('lang')){
    $lang = $session->get('lang');
}else{
    $lang = Yii::$app->language;
}
$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="category-index">

    <h3><?= Html::encode($this->title) ?></h3>


    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>

                 <td>
                     <?=Yii::t('app', 'Name')?>
                 </td>
                  <td>
                      Действие
                  </td>
        </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            foreach ($categoryType as $catType):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td>
                        <?= $catType->name ?>
                    </td>

                    <td><?=Html::a('Развернуть', ['view', 'id' => $catType->id])?></td>



                </tr>
                <?php
                $i++;
            endforeach;?>
            </tbody>
        </table>
    </div>
</div>
