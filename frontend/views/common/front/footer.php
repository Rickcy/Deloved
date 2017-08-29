<?php
use frontend\widgets\ChangePassword;
use frontend\widgets\Contact;
use frontend\widgets\Login;
use frontend\widgets\PasswordReset;
use frontend\widgets\Suggestion;

?>
<div id="footer">


    <div class="bottom_menu" >

        <div class="container">
            <div class="row">
                 <ul style="padding: 0;text-align: center">
                <li><a href="#">Статьи</a></li>
                <li><a href="#">О портале</a></li>
                <li><a href="#">Цены</a></li>
                <li><a href="#">Соглашение</a></li>
                
                <!--Если пользователь является гостем-->
                <?php  if(Yii::$app->user->isGuest):?>
                    <li><a href="#" data-target="#Contact" data-toggle="modal">Связаться с нами</a></li>
                <?php endif?>
                
                <!--Если пользователь не является гостем-->
                <?php if(!Yii::$app->user->isGuest):?>
                    <li><a href="/admin/ticket/create">Связаться с нами</a></li>
                <?php endif?>


                <!--Если пользователь является гостем-->
                <?php  if(Yii::$app->user->isGuest):?>
                    <li><a href="javascript:void(0)" onclick="noAuth()">Отзывы или предложения</a></li>
                <?php endif?>

                <!--Если пользователь не является гостем-->
                <?php if(!Yii::$app->user->isGuest):?>
                    <li><a href="#" data-target="#Suggestion" data-toggle="modal">Отзывы или предложения</a></li>
                <?php endif;?>


            </ul>
             </div>
        </div>
</div>

  
    <div class="bottom_block" >
        <div class="container">
            <div class="row">
                <div style="margin-top: 2%" class="col-xs-2 col-sm-1"><b class="lang"  id="lang_ru">RU</b>|<b class="lang" id="lang_en">EN</b></div>
        <div class="col-xs-5 col-sm-5" ><img  src="/images/front/logo_footer.gif">
			<span class="hidden-sm hidden-xs about-del">
			Бизнес портал товаров и услуг<br/>
			Все права защищены &copy; 2015
		</span></div>
        <div class="col-xs-4 col-sm-5  text-right"  style="padding: 0" >
            <a  href="https://vk.com/publicdelovedru" target="_blank"><img width="80px" src="/images/front/vkIcon.png" /></a>
            <a  href="http://www.facebook.com" target="_blank"><img width="80px"  src="/images/front/facebook.png"/></a>

        </div>
    </div>
    </div>

</div>
<?php if(Yii::$app->user->isGuest) {
    echo Login::widget();
    echo PasswordReset::widget();
    echo Contact::widget();
}
?>
<?php if(!Yii::$app->user->isGuest){
    echo Suggestion::widget();
}?>
    <script>
        function noAuth() {
            $('#Login').modal('show');
        }


        $(function () {
            $('.lang').click(function () {
                    var $lang =$(this).text();
                $.ajax({
                    type:'POST',
                    url:'/admin/account/change-language?lang='+$lang,
                    success:function () {
                        window.location.reload();
                    },
                    error:function () {

                    }
                });

            })
        })
    </script>
    
