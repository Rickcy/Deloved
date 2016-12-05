<div>
    <div class="row bottom_menu" >

        <div class="col-xs-12">
            <ul style="padding: 0">
                <li>Статьи</li>
                <li>О портале</li>
                <li>Цены</li>
                <li>Соглашение</li>
                
                <!--Если пользователь является гостем-->
                <?  if(Yii::$app->user->isGuest):?>
                    <li>Связаться с нами</li>
                <?endif?>
                
                <!--Если пользователь не является гостем-->
                <?if(!Yii::$app->user->isGuest):?>
                    <li>Связаться с нами</li>
                <?endif;?>
                
                <li>Отзывы или предложения</li>

            </ul>
        </div>
    </div>


    <div class="row bottom_block" >
        <div class="col-xs-4 col-sm-4 col-sm-offset-1" ><img  src="/images/front/logo_footer.gif"/>
			<span class="hidden-sm hidden-xs">
			Бизнес портал товаров и услуг<br/>
			Все права защищены &copy; 2015
		</span></div>
        <div class="col-xs-6" >
            <a href="https://vk.com/publicdelovedru" target="_blank"><img  src="/images/front/vkIcon.png" /></a>
            <a href="http://www.facebook.com" target="_blank"><img  src="/images/front/facebook.png"/></a>

        </div>

    </div>

</div>
