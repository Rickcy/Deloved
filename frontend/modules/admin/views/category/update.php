<?php
/** @var $model common\models\Category**/
?>

    <div style="padding: 30px">



                <input type="text" name="name" required id="category_name_update"  value="<?=$model->name?>" class="form-control">

            <p>
                <a href="javascript:void(0)" class="btn btn-md btn-success" id="update-category" onclick="updateCategory()" style="margin-top:5px"><?=Yii::t('app', 'Update category')?></a>
            </p>


    </div>
<script>
    function updateCategory() {
        
        var cname;
        cname = $("#category_name_update").val();
        $('#myModal').modal('hide');


        $.ajax({
            type:'POST',
            url:'/admin/category/edit-category/?id='+<?=$model->id.'+'?>'&name='+cname,
            success:function (data) {

                var obj = $.parseJSON(data);

                if (obj.success) {
                    showMessage('success', obj.success)
                    $("#<?=$model->id?>").text(cname)
                }
                if (obj.danger) {
                    showMessage('danger', obj.danger)
                }



            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                showMessage('danger', 'Ошибка соединения');

            }
        })
    }
</script>




