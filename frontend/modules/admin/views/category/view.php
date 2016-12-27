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
    <h1><?= Html::encode($this->title) ?></h1>
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
            <tbody>
            <?
            $i=0;
            foreach ($category as $cat):?>
                <tr class="<?=$i%2 == 0 ? 'even' : 'odd'?>">

                    <td>
                        <?= $cat->name?>
                    </td>

                    <td><?=Html::a('Развернуть', ['view', 'id' => $cat->id])?></td>


                    <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>
                        <td>
                            <?= Html::a('', ['delete', 'id' => $cat->id], ['class'=>'glyphicon glyphicon-trash status','data' => [
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
<script>
    $(document).ready(function () {
        $("#create-category").click(function () {
            var cat_name,parent_cat,cat_id;
            cat_name = $("#category_name").val();
            parent_cat =$("#parent_id_category").val();
            cat_id =$("#category_id_category").val();
            console.log(cat_name);
            console.log(parent_cat);
            console.log(cat_id);

            $.ajax({
                type:'POST',
                url:'/admin/category/category/?cat_name='+cat_name+'&parent_cat='+parent_cat+'&cat_id='+cat_id,
                success:function (data) {
                    console.log(data);

                    var obj = $.parseJSON(data);

                    if (obj.success) {
                        showMessage('success', obj.success)
                    }
                    if (obj.danger) {
                        showMessage('danger', obj.danger)
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    showMessage('danger', 'Ошибка соединения');

                }
            })
        })
    })
</script>
