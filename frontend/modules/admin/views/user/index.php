<?php

use common\models\User;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/**@var $item common\models\User**/

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', 'Username')?></td>



                <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                    <td><?=Yii::t('app', 'Enabled')?></td>

                <?endif;?>
                <td><?=Yii::t('app', 'Role')?></td>
            </tr>
            </thead>
            <tbody>
            <?
            $i=0;
            foreach ($users as $item):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td>
                        <?= Html::encode($item->username) ?>
                    </td>
                    <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                        <td id="gridRow<?=$item->id?>ps">
                            <?=$this->render("status",['status'=>$item->status==1?true:false,'statusClass'=>'publicStatus','iconFalse'=>'glyphicon-lock'])?>
                        </td>

                    <?endif;?>

                    <td id="<?=$item->id?>"><?=$item->role->role_name?></td>

                    <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                        <td>
                            <?= Html::a('', ['delete', 'id' => $item->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
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
<?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
    <script type="application/javascript">
        $(function () {

            function onClickPublicStatus(event) {
                var parent = $(event.currentTarget).parent();
                var pid = parent.attr('id');
                pid = pid.replace('gridRow', '');
                pid = pid.replace('ps', '');
                var type ='ps';
                jQuery.ajax({
                    type: 'POST',

                    url: '/admin/user/change-status?id='+pid+'&type='+type,
                    success: function (data, textStatus) {
                        $(parent).html("").append(jQuery(data).bind("click", onClickPublicStatus));
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                    }
                });
            }

            $('span.publicStatus').bind("click", onClickPublicStatus);


        });
    </script>
<?endif;?>