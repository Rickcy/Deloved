<? use yii\bootstrap\Html;
/**@var $role common\models\Role**/
/**@var $user common\models\User**/
?>
<?if ($user->checkRole(['ROLE_NONE'])):?>
    <a href="javascript:void(0)" onclick="emailConfirm()">Повторный запрос на подтверждение</a>
<?endif;?>
<?if ($user->checkRole(['ROLE_USER'])):?>
    Поздравляю в сменили роль на <?=$role->role_name?>

    <a href="javascript:void(0)" onclick="addflash()">Повторный запрос на подтверждение</a>
    <a href="javascript:void(0)" onclick="getflash()">Повторный запрос на подтверждение</a>




<?endif;?>
<script>
    function emailConfirm(){
        $.ajax({
            url: '/admin/default/confirm',
            type: "POST",
            success: function () {
               window.location.reload()
            },
            error: function () {
                console.log('не отправлено');

            }
        });
    }
    function addflash(){
        $.ajax({
            url: '/admin/default/add-flash',
            type: "POST",

            success: function (json,data,textStatus, jqXHR) {
                console.log('отправлено');

            },
            error: function () {
                console.log('не отправлено');

            }
        });
    }
    function getflash(){
        $.ajax({
            url: '/admin/default/get-flash',
            type: "GET",

            success: function (responseText) {
                var a = $.parseJSON(responseText);
                console.log('success');
                console.log('success');
                console.log(a.success);
                console.log(a.danger);
                console.log('danger');





            },
            error: function () {
                console.log('не отправлено');

            }
        });
    }
</script>
