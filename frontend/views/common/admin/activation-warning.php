<?php
use common\models\User;
use yii\bootstrap\Html;

$user = User::findIdentity(Yii::$app->user->id);
?>
<?php if ($user->checkRole(['ROLE_NONE'])):?>

<div class="alert alert-info" style="padding: 10px; margin-bottom: 10px">
		<button type="button" class="close" id="cActWarn" style="outline: none">&times;</button>
	<ul>
		<li>
Вы зарегистровали учетную запись в системе, но еще не активировали её. На <b><?=$user->email?></b> были высланы инструкции по активации учетной записи.
		</li>
		<li>
Письмо должно должно придти в течении нескольких минут после регистрации.
		</li>
		<li>
Если письмо не приходит, то попробуйте проверить раздел "Спам" в вашем почтовом ящике.
		</li>
		<li>
Если письмо все же не пришло или вы указали не правильный почтовый ящик при регистрации и теперь не можете получить к нему доступ, то нажмите <b><?= Html::a('сюда', ['/admin/default/repeat-email/']) ?></b>
.
		</li>
	</ul>
</div>

	<script>
$(document).ready(function() {
    $('#cActWarn').click(function(){
        var actWarn = jQuery(this).parent();
				actWarn.css('opacity', 0);
				actWarn.animate({height: 0}, 500, function(){
            actWarn.remove();
        });
			});
});
	</script>

<?php endif;?>