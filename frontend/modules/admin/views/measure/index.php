<?php
/* @var $this yii\web\View */
use common\models\User;
use yii\bootstrap\Html;

/* @var $measure common\models\Measure */


$this->title = Yii::t('app', 'Measure');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);

?>
<div class="measure-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="buttons">
        <?= Html::a(Yii::t('app', 'Create Measure'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', 'Name')?></td>



                <td><?=Yii::t('app', 'Full Name')?></td>
                <td><?=Yii::t('app', 'Type')?></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            foreach ($measures as $measure):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td id="name<?=$measure->id?>">
                        <a href="/admin/measure/update/?id=<?=$measure->id?>" id="<?=$measure->id?>"
                           data-toggle="modal"
                           data-remote="/admin/measure/update/?id=<?=$measure->id?>"
                           data-target="#myModal"><?= $measure->name?></a>
                    </td>

                    <td id="full_name<?=$measure->id?>"><?=$measure->full_name?></td>


                    <td id="code<?=$measure->id?>"><?=Yii::t('app', $measure->type->code)?></td>

                    <td>
                        <?= Html::a('', ['delete', 'id' => $measure->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this $measure?'),
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
