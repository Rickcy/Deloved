<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>


<?=$this->render("//common/flash-message")?>

    <div class="row first_block block_main">


    <div class="row text_main">
        <div class="col-xs-10 col-xs-offset-1 text_main_front" >
            <p class="text-center">Заключайте выгодные контракты в режиме онлайн, получайте юридическую защиту сделок, выбирайте контрагентов с высоким деловым рейтингом!</p>
        </div>
    </div>

    <div class="row resixe" style="">




        <div class="row" >
            <div class="col-xs-12">
                <div class="col-xs-10  col-xs-offset-1 col-sm-2 col-sm-offset-1  text-center ico" ><a href="#" style="color: white;" > <img src="/images/front/icon_deal.png" style="max-width:100px;"/><br><span class="text_btn_main" style="font-size: 15pt;color:#94C43D;font-weight: 600 ">Сделки онлайн</span></a></div>
                <div class="col-xs-5 col-xs-offset-1 col-sm-2 col-sm-offset-0 text-center ico" ><a href="#" style="color: white;text-shadow: 0 0 1px whitesmoke;"  ><img src="/images/front/icon_rating.png" style="max-width:100px;"/><br><span class="text_btn_main" style="font-size: 15pt;color:#94C43D;font-weight: 600">Рейтинг</span></a></div>
                <div class="col-xs-5 col-xs-offset-0	 col-sm-2 col-sm-offset-0 text-center ico" ><a href="#" style="color: white;text-shadow: 0 0 1px whitesmoke"  ><img src="/images/front/icon_jurist.png" style="max-width:100px;"/> <br><span class="text_btn_main" style="font-size: 15pt;color:#94C43D;font-weight: 600">Помощь юриста</span></a></div>
                <div class="col-xs-5 col-xs-offset-1 col-sm-2 col-sm-offset-0 text-center ico" ><a href="#" style="color: white;text-shadow: 0 0 1px whitesmoke"  ><img src="/images/front/icon_sud.png" style="max-width:100px;"/> <br><span class="text_btn_main" style="font-size: 15pt;color:#94C43D;font-weight: 600">Третейский суд</span></a></div>
                <div class="col-xs-5 col-xs-offset-0 col-sm-2 col-sm-offset-0 text-center ico" ><a href="#" style="color: white;text-shadow: 0 0 1px whitesmoke"  ><img src="/images/front/icon_mediation.png" style="max-width:100px"/> <br><span class="text_btn_main" style="font-size: 15pt;color:#94C43D;font-weight: 600">Медиация</span></a></div>
            </div>
        </div>

    </div>

    <div class="row playvideo" >
        <div class="col-xs-10 col-xs-offset-1 text-center playvideo">
            <div class="col-xs-0 col-sm-1"></div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-0" style="position: relative;margin-top: 15px">

                <img  src="/images/front/videow.png" style="width: 100%;">
                <img  class="icovideo1" src="/images/front/play_btn.png" style="width: 20%;position: absolute;top: 30%;right: 40%">


            </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-0" style="position: relative;margin-top: 15px">
                <a href="#">
                    <img  src="/images/front/videoq.png" style="width: 100%;">
                    <img  class="icovideo1" src="/images/front/on_btn.png" style="width: 20%;position: absolute;top: 30%;right: 40%">

                </a>
            </div>
        </div>
    </div>
</div>
<div class="shadow_block hidden-xs">


    <div class="row second_block block_main " >
        <!-- Навигационная панель с 3 вкладками -->
        <ul class="nav nav-pills nav-justified" style="margin-left: 5%;width: 89%;box-shadow:0 0 15px #747474;background-color:#4b70b2;border-top-left-radius:10px;border-top-right-radius:15px" role="tablist" id="myTabExample">
            <li class="actives a"><a href="#deal_online" style="min-height: 55px;font-size: 11pt;color: white" role="tab" data-toggle="tab"><img src="/images/front/dea.png" style="max-width:45px;float: left;border-bottom-right-radius: 10px;border-bottom-left-radius:10px "/>СДЕЛКИ <br> ОНЛАЙН</a></li>
            <li class="a"><a href="#rating_system" role="tab" style="min-height:55px;font-size: 11pt;color: white" data-toggle="tab"><img src="/images/front/rating_ultra.png" style="max-width:45px;float: left;border-bottom-right-radius: 10px;border-bottom-left-radius:10px"/>РЕЙТИНГОВАЯ <br> СИСТЕМА</a></li>
            <li class="a"><a href="#jurist_system" role="tab" style="min-height: 55px;font-size: 11pt;color: white" data-toggle="tab"><img src="/images/front/sud_ultra.png" style="max-width:45px;float: left;border-bottom-right-radius: 10px;border-bottom-left-radius:10px"/>ЮРИДИЧЕСКАЯ <br> СЛУЖБА</a></li>
            <li class="a"><a href="#sud_system" role="tab" style="min-height: 55px;font-size: 11pt;color: white" data-toggle="tab"><img src="/images/front/hammer.png" style="max-width:45px;float: left;border-bottom-right-radius: 10px;border-bottom-left-radius:10px"/>ТРЕТЕЙCКИЙ <br> СУД</a></li>
            <li class="a"><a href="#mediation" role="tab" style="min-height: 55px;font-size: 11pt;color: white" data-toggle="tab"><img src="/images/front/mediation_ultra.png" style="max-width:45px;float: left;border-bottom-right-radius: 10px;border-bottom-left-radius:10px"/>МЕДИАЦИЯ <br><b style="opacity: 0">служба</b></a></li>
        </ul>

        <!-- Содержимое вкладок -->
        <div class="tab-content" style="width: 89%;box-shadow: 0 0 20px #9c9c9c;margin-left: 5%  ">
            <!-- Содержимое 1 вкладки -->
            <div class="tab-pane active" id="deal_online">
                <img src="/images/front/deal_online.jpg" style="width: 100%"/>
            </div>

            <!-- Содержимое 2 вкладки -->
            <div class="tab-pane active" id="rating_system">
                <img src="/images/front/rating.jpg" style="width: 100%"/>

            </div>
            <!-- Содержимое 3 вкладки -->
            <div class="tab-pane active" id="jurist_system">
                <img src="/images/front/jurist.jpg" style="width: 100%"/>
            </div>
            <div class="tab-pane active" id="sud_system">
                <img src="/images/front/sud.jpg" style="width: 100%"/>
            </div>
            <div class="tab-pane active" id="mediation">
                <img src="/images/front/mediation.jpg" style="width: 100%"/>
            </div>
        </div>

        <!-- Скрипт для активирования работы вкладок -->
        <script>
            $(function() {
                $('#myTabExample a:first').tab('show')
            });
        </script>
    </div>
</div>

