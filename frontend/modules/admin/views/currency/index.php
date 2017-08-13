<?php
/* @var $this yii\web\View */
use common\models\User;
use yii\bootstrap\Html;

/* @var $cur common\models\Currency */


$this->title = Yii::t('app', 'Currency');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="currency-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="buttons">
        <?= Html::a(Yii::t('app', 'Create Currency'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    
    
    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', 'Name')?></td>



                <td><?=Yii::t('app', 'Code')?></td>

                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            foreach ($currency as $cur):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td id="name<?=$cur->id?>">
                        <a href="/admin/currency/update/?id=<?=$cur->id?>" id="<?=$cur->id?>"
                           data-toggle="modal"
                           data-remote="/admin/currency/update/?id=<?=$cur->id?>"
                           data-target="#myModal"><?= $cur->name?></a>
                    </td>

                    <td id="code<?=$cur->id?>"><?=$cur->code?></td>



                    <td></td>
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
