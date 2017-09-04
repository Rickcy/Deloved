<?php

/* @var $this yii\web\View */

$session = Yii::$app->session;
if ($session->has('lang')){
    $lang = $session->get('lang');
}else{
    $lang = Yii::$app->language;
}
$this->title = Yii::t('app','About us');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">

    <div class="shadow_block">
        <div class="row" style="margin-top:6%;padding: 2% 8%;width: 110%;margin-left: -5%;background-color: white">

            <div class="col-sm-12" >
                <h2 class="h2_main_name" style="font-weight: bold;text-align:left!important;color:rgb(148, 196, 61)"><img style="min-width:40px;width: 5%;margin-left: 1%;margin-right: 1%" src="/images/front/icon_deal.png"/>СДЕЛКИ ОНЛАЙН
                    <div style="background-image: linear-gradient(270deg, rgb(248, 215, 53), rgb(148, 196, 61) 110%);
      width: 98%;
      height: 4px;"></div></h2>

                <div style="margin-top: 3%">
                    <div class="col-sm-6 h2_main_name" style="font-size: 17pt;padding-top: 5%">Выбор надежного контрагента и предложение сделки в один клик – просто и удобно!
                        <div class="row">
                            <a style="float: left;margin:12px;color: rgb(148, 196, 61);border: 1px solid rgb(148, 196, 61);padding: 5px;-webkit-border-radius:7px ;-moz-border-radius:7px ;border-radius:7px ;">Подробнее</a>
                        </div>

                    </div>

                    <div  class="col-sm-6"><img style="width: 100%" src="/images/front/deal_online1.jpg"/></div>

                </div>
                <br><br>
                <div style="margin-top: 3%">
                    <div class="col-sm-6 col-sm-push-6 h2_main_name"  style="font-size: 17pt;padding-top: 5%;">Доступность деловой переписки, фиксация всех этапов сделки, удобный поиск.

                    </div>
                    <div class="col-sm-6 col-sm-pull-6"><img style="width: 100%" src="/images/front/deal_online2.jpg"/></div>





                </div>

            </div>
        </div>
    </div>
    <div class="shadow_block">
        <div class="row" style="margin-top:8%;padding: 2% 8%;width: 110%;margin-left: -5%;background-color: white">

            <div class="col-sm-12" >
                <h2 class="h2_main_name" style="font-weight: bold;text-align:left!important;color:rgb(75, 100, 190)"><img style="min-width:40px;width: 5%;margin-left: 1%;margin-right: 1%" src="/images/front/icon_rating.png"/>РЕЙТИНГОВАЯ СИСТЕМА
                    <div style="background-image: linear-gradient(270deg, rgb(149, 184, 234), rgb(75, 100, 190) 110%);
    width: 98%;
    height: 4px;"></div></h2>

                <div style="margin-top: 3%">
                    <div class="col-sm-6 h2_main_name" style="font-size: 17pt;padding-top: 5%">Избегайте рисков – работайте с проверенными контрагентами!
                        <div class="row">
                            <a style="float: left;margin:12px;color: rgb(75, 100, 190);border: 1px solid rgb(75, 100, 190);padding: 5px;-webkit-border-radius:7px ;-moz-border-radius:7px ;border-radius:7px ;">Подробнее</a>
                        </div>
                    </div>

                    <div class="col-sm-6"><img style="width: 100%" src="/images/front/rating1.jpg"/></div>
                </div>
                <br><br>
                <div style="margin-top: 3%">
                    <div class="col-sm-6  col-sm-push-6 h2_main_name" style="font-size: 17pt;padding-top: 5%">Формируйте деловой рейтинг на основе успешности сделок, отзывов и результатов споров.</div>


                    <div class="col-sm-6 col-sm-pull-6"><img style="width: 100%" src="/images/front/rating2.jpg"/></div>


                </div>

            </div>
        </div>
    </div>
    <div class="shadow_block">
        <div class="row" style="margin-top:8%;padding: 2% 8%;width: 110%;margin-left: -5%;background-color: white">

            <div class="col-sm-12" >
                <h2 class="h2_main_name" style="font-weight: bold;text-align:left!important;color:rgb(148, 196, 61)"><img style="min-width:40px;width: 6%;margin-left: 1%;margin-right: 1%" src="/images/front/icon_jurist.png"/>ЮРИДИЧЕСКАЯ СЛУЖБА
                    <div style="background-image: linear-gradient(270deg, rgb(248, 215, 53), rgb(148, 196, 61) 110%);
      width: 98%;
      height: 4px;"></div></h2>

                <div style="margin-top: 3%">
                    <div class="col-sm-6 h2_main_name" style="font-size: 17pt;padding-top: 5%">Онлайн консультация юриста.
                        <div class="row">
                            <a style="float: left;margin:12px;color: rgb(148, 196, 61);border: 1px solid rgb(148, 196, 61);padding: 5px;-webkit-border-radius:7px ;-moz-border-radius:7px ;border-radius:7px ;">Подробнее</a>
                        </div>
                    </div>

                    <div class="col-sm-6"><img style="width: 100%" src="/images/front/jurist1.jpg"/></div>
                </div>
                <br><br>
                <div style="margin-top: 3%">

                    <div class="col-sm-6 col-sm-push-6 h2_main_name" style="font-size: 17pt;padding-top: 5%">Банк готовых документов, образцов договоров. Помощь юриста при заключении договора.</div>

                    <div class="col-sm-6 col-sm-pull-6"><img style="width: 100%" src="/images/front/jurist2.jpg"/></div>


                </div>

            </div>
        </div>
    </div>
    <div class="shadow_block">
        <div class="row" style="margin-top:8%;padding: 2% 8%;width: 110%;margin-left: -5%;background-color: white">

            <div class="col-sm-12" >
                <h2 class="h2_main_name" style="font-weight: bold;text-align:left!important;color:rgb(75, 100, 190)"><img style="min-width:40px;width: 5%;margin-left:1%;margin-right: 1%" src="/images/front/icon_mediation.png"/>МЕДИАЦИЯ
                    <div style="background-image: linear-gradient(270deg, rgb(149, 184, 234), rgb(75, 100, 190) 110%);
    width: 98%;
    height: 4px;"></div></h2>

                <div style="margin-top: 3%">
                    <div class="col-sm-6 h2_main_name" style="font-size:17pt;padding-top: 5%">Урегулирование спора с использованием процедуры медиации - эффективный способ, основанный на переговорах.
                        <div class="row">
                            <a style="float: left;margin:12px;color: rgb(75, 100, 190);border: 1px solid rgb(75, 100, 190);padding: 5px;-webkit-border-radius:7px ;-moz-border-radius:7px ;border-radius:7px ;">Подробнее</a>
                        </div>
                    </div>

                    <div class="col-sm-6"><img style="width: 100%" src="/images/front/mediation123.jpg"/></div>
                </div>


            </div>
        </div>
    </div>
    <div class="shadow_block">
        <div class="row" style="margin-top:8%;padding: 2% 8%;width: 110%;margin-left: -5%;background-color: white">

            <div class="col-sm-12" >
                <h2 class="h2_main_name" style="font-weight: bold;text-align:left!important;color:rgb(148, 196, 61)"><img style="min-width:40px;width: 5%;margin-left: 1%;margin-right: 1%" src="/images/front/icon_sud.png"/>ТРЕТЕЙСКИЙ СУД
                    <div style="background-image: linear-gradient(270deg, rgb(248, 215, 53), rgb(148, 196, 61) 110%);
      width: 98%;
      height: 4px;"></div></h2>
                <div style="margin-top: 3%">
                    <div class="col-sm-6 col-sm-push-6 h2_main_name" style="font-size: 17pt;padding-top: 5%">
                        Подача иска в один клик. Судебное разрешение споров в Третейском суде «ДЕЛОВЕД» квалифицированными арбитрами. Незамедлительное вступление в силу решения суда. Помощь юриста при формировании документов.
                        <div class="row">
                            <a style="float: left;margin:12px;color: rgb(148, 196, 61);border: 1px solid rgb(148, 196, 61);padding: 5px;-webkit-border-radius:7px ;-moz-border-radius:7px ;border-radius:7px ;">Подробнее</a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-sm-pull-6"><img style="width: 100%" src="/images/front/sud123.jpg"/></div>




                </div>
            </div>
        </div>
    </div>
</div>
