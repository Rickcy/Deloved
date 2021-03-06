<?php
use common\models\User;

$user = User::findIdentity(Yii::$app->user->id);
$profile =$user->getProfile()->one();
?>

<div class="header col-md-12">
<div class="col-xs-12 col-sm-3">
	<a href="/"><img class="hlogo" src="/images/front/logo2.png"/></a>
</div>
	<div class="col-xs-12 col-sm-9">


		<a class="hmenu" style="font-family: Georgia, serif;margin-right: 10px" href="/admin/information/index">Проверить контрагента</a>

		<a class="hmenu" style="font-family: Georgia, serif;margin-right: 10px" href="/companies/index"><?=Yii::t('app', 'Companies')?></a>

		<a class="hmenu" style="font-family: Georgia, serif;margin-right: 10px" href="/goods/index"><?=Yii::t('app', 'Goods')?></a>

		<a class="hmenu" style="font-family: Georgia, serif;" href="/services/index"><?=Yii::t('app', 'Services')?></a>








		<div class="hperson">

			<img id="hperson-avatar" src="/images/admin/avatar.jpg"/>
            <?php if ($profile):?>
                <span id="hperson-name"><?=$profile->fio?></span>
            <?php elseif (!$profile):?>
            <span id="hperson-name"><?=$user->username?></span>
            <?php endif;?>
            <div id="info">

				<a href="/admin/profile/show" class="info-menu" ><?=Yii::t('app', 'My Profile')?></a>

                <?php if ($user->checkRole(['ROLE_USER']) && !$user->profile->isManager()):?>
					<a href="/admin/billing/index" class="info-menu"><?=Yii::t('app', 'Personal Invoice')?></a>
				<?php endif;?>
				<a href="/admin/default/logout" data-method="post" class="info-menu"><?=Yii::t('app', 'Logout')?></a>


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
