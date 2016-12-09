<? use yii\bootstrap\Html;
/**@var $role common\models\Role**/
/**@var $user common\models\User**/
?>
<?if ($user->checkRole(['ROLE_NONE'])):?>
    <a href="javascript:void(0)" onclick="emailConfirm()">Повторный запрос на подтверждение</a>
<?endif;?>
<?if ($user->checkRole(['ROLE_USER'])):?>
    Поздравляю в сменили роль на <?=$role->role_name?>

    <a href="javascript:void(0)" onclick="flash()">Повторный запрос на подтверждение</a>




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
    function flash(){
        $.ajax({
            url: '/admin/default/flash',
            type: "POST",
            success: function () {
               
            },
            error: function () {
               

            }
        });
    }
</script>
