<?php

/* @var $this yii\web\View */

use common\models\User;
use yii\bootstrap\Html;

/* @var $tariff common\models\Tariffs */


$this->title = Yii::t('app', 'Tariffs');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="tariffs-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="buttons">
        <?= Html::a(Yii::t('app', 'Create Tariff'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', 'Name')?></td>




                <td><?=Yii::t('app', 'Price')?></td>
                <td><?=Yii::t('app', 'Currency')?></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            foreach ($tariffs as $tariff):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td id="name<?=$tariff->id?>">
                        <a href="/admin/tariffs/update/?id=<?=$tariff->id?>" id="<?=$tariff->id?>"
                           data-toggle="modal"
                           data-remote="/admin/tariffs/update/?id=<?=$tariff->id?>"
                           data-target="#myModal"><?= $tariff->name?></a>
                    </td>

                    <td id="price<?=$tariff->id?>"><?=$tariff->price?></td>


                    <td id="code<?=$tariff->id?>"><?=Yii::t('app', $tariff->currency->code)?></td>


                    <td>
                        <?= Html::a('', ['delete', 'id' => $tariff->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this tariff?'),
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