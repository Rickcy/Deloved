<?php
use frontend\widgets\ChangePassword;
use frontend\widgets\Contact;
use frontend\widgets\Login;
use frontend\widgets\PasswordReset;
use frontend\widgets\SignUp;
use frontend\widgets\Suggestion;

?>
<div id="footer">


    <div class="bottom_menu" >

        <div class="container">
            <div class="row hidden-xs">
                 <ul style="padding: 10px;text-align: center">
                     <li style="margin:0 15px 0 15px;"><a style="font-size: 1.3em" href="/front/about">О проекте</a></li>
                     <li style="margin:0 15px 0 15px;"><a style="font-size: 1.3em" href="/front/tariffs">Тарифы</a></li>
                     <li style="margin:0 15px 0 15px;"><a style="font-size: 1.3em" href="/front/sogl">Соглашение</a></li>
                     <li style="margin:0 15px 0 15px;"><a style="font-size: 1.3em" href="/article/index">Статьи</a></li>
                     <li style="margin:0 15px 0 15px;"><a style="font-size: 1.3em" href="/goods">Товары</a></li>
                     <li style="margin:0 15px 0 15px;"><a style="font-size: 1.3em" href="/services">Услуги</a></li>

                <!--Если пользователь является гостем-->
                <?php  if(Yii::$app->user->isGuest):?>
                    <li style="margin:0 15px 0 15px;"><a style="font-size: 1.4em" href="javascript:void(0)" data-target="#Contact" data-toggle="modal">Связаться с нами</a></li>
                <?php endif?>
                
                <!--Если пользователь не является гостем-->
                <?php if(!Yii::$app->user->isGuest):?>
                    <li style="margin:0 15px 0 15px;"><a style="font-size: 1.4em" href="javascript:void(0)" data-target="#Contact" data-toggle="modal">Связаться с нами</a></li>
                <?php endif?>




            </ul>
             </div>

            <div class="row visible-xs text-center">
                <div class="row">
                    <div class="col-xs-12">
                        <a style="font-size: 1.3em;color: white" href="/front/about">О проекте</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <a style="font-size: 1.3em;color: white" href="/front/tariffs">Тарифы</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <a style="font-size: 1.3em;color: white" href="/front/sogl">Соглашение</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <a style="font-size: 1.3em;color: white" href="/article/index">Статьи</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <a style="font-size: 1.3em;color: white" href="/goods">Товары</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <a style="font-size: 1.3em;color: white" href="/services">Услуги</a>
                    </div>
                </div>

                    <!--Если пользователь является гостем-->
                    <?php  if(Yii::$app->user->isGuest):?>
                        <div class="row">
                            <div class="col-xs-12">
                                <a style="font-size: 1.3em;color: white" href="javascript:void(0)" data-target="#Contact" data-toggle="modal">Связаться с нами</a>
                            </div>
                        </div>
                    <?php endif?>

                    <!--Если пользователь не является гостем-->
                    <?php if(!Yii::$app->user->isGuest):?>
                        <div class="row">
                            <div class="col-xs-12">
                                <a style="font-size: 1.4em;color: white" href="javascript:void(0)" data-target="#Contact" data-toggle="modal">Связаться с нами</a>
                            </div>
                        </div>
                    <?php endif?>

            </div>
        </div>
</div>

  
    <div class="bottom_block" >
        <div class="container">
            <div class="row">
<!--                <div style="margin-top: 2%" class="col-xs-2 col-sm-1"><b class="lang"  id="lang_ru">RU</b>|<b class="lang" id="lang_en">EN</b></div>-->
                <div class="col-xs-5 col-sm-5" ><a href="/"><img  src="/images/front/logo_footer.gif"></a>
                    <span class="hidden-sm hidden-xs about-del text-center">
			<span  style="font-size: 2.5rem;letter-spacing: .3rem;margin-top: .6rem">Безопасные сделки </span> <br>
                        <span>Все права защищены 2018 © </span>
		</span></div>
        <div class="col-xs-4 col-sm-6  text-right"  style="padding: 0" >
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
    echo SignUp::widget();

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
                    url:'/front/change-language?lang='+$lang,
                    success:function (data) {
                        if(data){
                            window.location.reload();
                        }
                    },
                    error:function () {

                    }
                });

            })
        })
    </script>
    
