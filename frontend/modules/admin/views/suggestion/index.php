<?php
/* @var $this yii\web\View */
/* @var $item common\models\SuggestionCat */
use common\models\User;
use yii\bootstrap\Html;

$this->title = Yii::t('app', 'Category communication');
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="suggestion-list">
    <h3><?= Html::encode($this->title) ?></h3>

<div class="row">
    <div class="col-xs-12 buttons">

        <div class="col-sm-5">
            <input type="text" name="name" required id="category_name" class="form-control">
            
        </div>
        <div class="col-sm-5">
            <a href="javascript:void(0)" class="btn btn-md btn-success" id="create-category" style="margin-top:5px"><?=Yii::t('app', 'Create ')?></a>
        </div>

    </div>
</div>
    
<div class="row">
    <div class="table-responsive">
        <table border="0" class="table table-striped">
            <thead class="thead-main">
            <tr>


                <td><?=Yii::t('app', 'Name')?></td>
                <td></td>
            </tr>
            </thead>
            <tbody class="tbody-category">
            <?php
            $i=0;
            foreach ($suggestion_cat as $item):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td>
                        <a href="/admin/suggestion/update/?id=<?=$item->id?>" id="name<?=$item->id?>"
                           data-toggle="modal"
                           data-remote="/admin/suggestion/update/?id=<?=$item->id?>"
                           data-target="#myModal"><?=$item->name?></a>
                    </td>
                    
                        <td>
                            <?= Html::a('', ['delete', 'id' => $item->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this suggestion?'),
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
</div>

<div id="modalContainer"></div>
<script>
    $(document).ready(function () {
        $("#create-category").click(function () {
            var cat_name;
            cat_name = $("#category_name").val();
       


            $.ajax({
                type:'POST',
                url:'/admin/suggestion/create-category/?cat_name='+cat_name,
                success:function (data) {

                    var obj = $.parseJSON(data);

                    if (obj[0].success) {
                        showMessage('success', obj[0].success);
                        $("#category_name").val('');
                        $(".tbody-category").append("<tr class='odd'><td>" +
                            "<a href='/admin/suggestion/update?id="+obj['id_model']+"' data-remote='/admin/suggestion/update/?id="+obj['id_model']+"' data-target='#myModal' data-toggle='modal'>"+cat_name+"</a></td><td><a class='glyphicon glyphicon-trash status' href='/admin/suggestion/delete?id="+obj['id_model']+"' data-confirm='Are you sure you want to delete this item?' data-method='post'></a> </td> </tr>");

                    }
                    if (obj[0].danger) {
                        showMessage('danger', obj[0].danger)
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showMessage('danger', 'Ошибка соединения');

                }
            })
        });




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