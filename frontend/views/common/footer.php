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
                <?  if(Yii::$app->user->isGuest):?>
                    <li><a href="#">Связаться с нами</a></li>
                <?endif?>
                
                <!--Если пользователь не является гостем-->
                <?if(!Yii::$app->user->isGuest):?>
                    <li><a href="#">Связаться с нами</a></li>
                <?endif;?>

                <li><a href="#">Отзывы или предложения</a></li>

            </ul>
             </div>
        </div>
</div>


    <div class="bottom_block" >
        <div class="container">
            <div class="row">
        <div class="col-xs-4 col-sm-4 " ><img  src="/images/front/logo_footer.gif">
			<span class="hidden-sm hidden-xs about-del">
			Бизнес портал товаров и услуг<br/>
			Все права защищены &copy; 2015
		</span></div>
        <div class="col-xs-7 text-right"  >
            <a  href="https://vk.com/publicdelovedru" target="_blank"><img width="80px" src="/images/front/vkIcon.png" /></a>
            <a  href="http://www.facebook.com" target="_blank"><img width="80px"  src="/images/front/facebook.png"/></a>

        </div>
    </div>
    </div>

</div>