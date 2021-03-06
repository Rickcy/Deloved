<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $item common\models\Account*/

$this->title = Yii::t('app', 'Accounts');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
$timeZone = $session->get('timeZone')/60;

?>
<div class="account-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="buttons">
        <?= Html::a(Yii::t('app', 'Create Account'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>



    <div class="table-responsive">
    <table border="0" class="table table-striped">
        <thead class="thead-main">
        <tr>


            <td><?=Yii::t('app', 'Full Name')?></td>



            <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                <td><?=Yii::t('app', 'Public Status')?></td>
                <td><?=Yii::t('app', 'Verify Status')?></td>

            <?php endif;?>
            <td><?=Yii::t('app', 'City')?></td>
            <td><?=Yii::t('app', 'Date Created')?></td>
            <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                <td></td>
            <?php endif;?>
        </tr>
        </thead>
        <tbody>
       <?php
       $i=0;
       foreach ($account as $item):?>
            <tr class=<?=$i%2 == 0 ? 'even' : 'odd'?>>

                <td class="account-<?=$item->id?>">
                    <?= Html::a($item->brand_name, ['update', 'id' => $item->id]) ?>
                </td>
                <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                    <td id="gridRow<?=$item->id?>ps">
                        <?=$this->render("status",['status'=>$item->public_status==1?true:false,'statusClass'=>'publicStatus','iconFalse'=>'glyphicon-lock'])?>
                    </td>
                    <td id="gridRow<?=$item->id?>vs">

                        <?=$this->render("status",['status'=>$item->verify_status==1?true:false,'statusClass'=>'verifyStatus'])?>
                    </td>
                <?php endif;?>

                <td id="gridRow<?=$item->id?>city"><?=$item->city_id?$item->city->name:''?></td>

                <td><?=(new DateTime(Yii::$app->formatter->asDatetime($item->created_at, "php:Y-m-d  H:i")))->add(new DateInterval('PT'.$timeZone.'H'))->format('Y-m-d H:i')?></td>
                <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                    <td>
                        <?= Html::a('', ['delete', 'id' => $item->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],])?>

                    </td>
                <?php endif;?>
            </tr>
       <?php
           $i++;
       endforeach;?>

        </tbody>
    </table>
        <?php echo \yii\widgets\LinkPager::widget([
            'pagination' => $dataProvider->pagination
        ]) ?>
</div>
</div>
<?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
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

                url: '/admin/account/change-status?id='+pid+'&type='+type,
                success: function (data, textStatus) {
                    $(parent).html("").append(jQuery(data).bind("click", onClickPublicStatus));
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                }
            });
        }

        $('span.publicStatus').bind("click", onClickPublicStatus);

        function onClickVerifyStatus(event) {
            var parent = $(event.currentTarget).parent();
            var pid = parent.attr('id');
            pid = pid.replace('gridRow', '');
            pid = pid.replace('vs', '');
            var type ='vs';
            $.ajax({
                type: 'POST',
                url: '/admin/account/change-status?id='+pid+'&type='+type,
                success: function (data, textStatus) {

                    $(parent).html("").append($(data).bind("click", onClickVerifyStatus));
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                }
            });
        }

        $('span.verifyStatus').bind("click", onClickVerifyStatus);
    });
</script>
<?php endif;?>