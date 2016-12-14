<?php
use common\models\User;

$user = User::findIdentity(Yii::$app->user->id);
$profile =$user->getProfiles()->one();
?>

<div class="header col-md-12">
<div class="col-xs-12 col-sm-2">
	<a href="/"><img class="hlogo" src="/images/front/logo2.png"/></a>
</div>
	<div class="col-xs-12 col-sm-10">


		<a class="hmenu" style="font-family: Georgia, serif;margin-right: 10px" href="#">Главная</a>

		<a class="hmenu" style="font-family: Georgia, serif;margin-right: 10px" href="#">Партнеры</a>

		<a class="hmenu" style="font-family: Georgia, serif;margin-right: 10px" href="#">Товары</a>

		<a class="hmenu" style="font-family: Georgia, serif;" href="#">Услуги</a>








		<div class="hperson">

			<img id="hperson-avatar" src="/images/admin/avatar.jpg"/>
            <?if ($profile):?>
                <span id="hperson-name"><?=$profile->fio?></span>
            <?elseif (!$profile):?>
            <span id="hperson-name"><?=$user->username?></span>
            <?endif;?>
            <div id="info">

				<a href="#" class="info-menu" >Мой профиль</a>

                <?if ($user->checkRole(['ROLE_USER'])):?>
					<a href="#" class="info-menu">Лицевой счет</a>
				<?endif;?>
				<a href="/admin/default/logout" data-method="post" class="info-menu">    Выйти</a>


			</div>

		</div>

		<script>
$('#hperson-avatar,#hperson-name').click(function() {
    var info = $("#info")
				if (info.is(':visible')) {
                    info.hide()
					return false
				}
				info.show()
				return false
			})
		</script>

	


	
	</div>

</div>
