<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $category common\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$user = User::findIdentity(Yii::$app->user->id);
?>
<div class="category-view">
    <div class="row">
    <div><h3 style="float: left"><?= Html::encode($this->title) ?></h3>

    </div>
        <div style="float: right;position: relative;right: 3% ">
            <?=Html::a(Yii::t('app', 'Return'), [$model->parent_id==1?'index':'view', $model->parent_id==1?'':'id' => $model->parent_id],['class'=>'btn btn-md btn-default','style'=>'font-size:20px;margin-bottom:0%'])?>
        </div>

    <div class="col-xs-12 buttons">

        <div class="col-sm-5">
        <input type="text" name="name" required id="category_name" class="form-control">
        <input type="text" name="parent_id" id="parent_id_category" class="hidden" value="<?=$model->id?>">
        <input type="text" name="category_id" id="category_id_category" class="hidden" value="<?=$model->categorytype_id?>">

        </div>
        <div class="col-sm-5">
            <a href="javascript:void(0)" class="btn btn-md btn-success" id="create-category" style="margin-top:5px"><?=Yii::t('app', 'Create category')?></a>
        </div>

        </div>
    </div>
    <div class="row">
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
            <tbody class="tbody-category">
            <?
            $i=0;
            foreach ($category as $cat):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td>
                        <a href="/admin/category/update/?id=<?=$cat->id?>" id="<?=$cat->id?>"
                        data-toggle="modal"
                        data-remote="/admin/category/update/?id=<?=$cat->id?>"
                        data-target="#myModal"><?= $cat->name?></a>
                    </td>

                    <td><?=Html::a('Развернуть', ['view', 'id' => $cat->id])?></td>


                    <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                        <td>
                            <?= Html::a('', ['delete', 'id' => $cat->id,'parent_id'=>$model->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
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

</div>
<div id="modalContainer"></div>


<script>
    $(document).ready(function () {
        $("#create-category").click(function () {
            var cat_name,parent_cat,cat_id;
            cat_name = $("#category_name").val();
            parent_cat =$("#parent_id_category").val();
            cat_id =$("#category_id_category").val();


            $.ajax({
                type:'POST',
                url:'/admin/category/create-category/?cat_name='+cat_name+'&parent_cat='+parent_cat+'&cat_id='+cat_id,
                success:function (data) {

                    var obj = $.parseJSON(data);

                    if (obj[0].success) {
                        showMessage('success', obj[0].success)
                    }
                    if (obj[0].danger) {
                        showMessage('danger', obj[0].danger)
                    }
                    $("#category_name").val('');
                    $(".tbody-category").append("<tr class='odd'><td>"+cat_name+"</td><td><a href='/admin/category/view?id="+obj['id_model']+"'>Развернуть</a></td><td><a class='glyphicon glyphicon-trash status' href='/admin/category/delete?id="+obj['id_model']+"&amp;parent_id="+parent_cat+"' data-confirm='Are you sure you want to delete this item?' data-method='post'></a> </td> </tr>");
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
