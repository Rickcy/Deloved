<?php

use common\models\User;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $profile common\models\Profile */


$this->title = Yii::t('app', 'Profiles');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="profile-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', 'Email')?></td>



                <td><?=Yii::t('app', 'Fio')?></td>
                <td><?=Yii::t('app', 'City')?></td>
                <td><?=Yii::t('app', 'Role')?></td>

            </tr>
            </thead>
            <tbody>
            <?
            $i=0;
            foreach ($profiles as $profile):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td id="email-profile<?=$profile->id?>">
                        <a href="/admin/profile/update/?id=<?=$profile->id?>" id="<?=$profile->id?>"
                           data-toggle="modal"
                           data-remote="/admin/profile/update/?id=<?=$profile->id?>"
                           data-target="#myModal"><?= $profile->email?></a>
                    </td>

                    <td id="fio-profile<?=$profile->id?>"><?=$profile->fio?></td>

                    <td id="city-profile<?=$profile->id?>"><?=isset($profile->city->name)?$profile->city->name:''?></td>
                    <td><?=Yii::t('app', $profile->user->role->role_name)?></td>



                </tr>
                <?
                $i++;
            endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<div id="modalContainer"></div>
<script>
    $(document).ready(function () {
       




        function constructModalDOM() {
            return $("<div></div>").
            attr('id', 'myModal').
            addClass("modal").
            addClass("fade").
            attr('tabindex', '-1').
            attr('role', 'dialog').
            attr('aria-labelledby', 'myModalLabel').
            attr('aria-hidden', 'true').
            on('hidden.bs.modal', onHideModal).
            append(
                $("<div></div>").
                addClass("modal-dialog").
                append(
                    $("<div></div>").
                    attr('id', 'myModalContent').
                    addClass("modal-content")
                )
            );
        }

        function onHideModal() {
            $('#myModal').replaceWith(constructModalDOM());
        }

        constructModalDOM().appendTo($('#modalContainer'));

    })
</script>