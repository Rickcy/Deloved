<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 30.08.17
 * Time: 23:13
 */
/**
 * @var $tariff \common\models\Tariffs
 */
$session = Yii::$app->session;
if ($session->has('lang')){
    $lang = $session->get('lang');
}else{
    $lang = Yii::$app->language;
}
$this->title = Yii::t('app','Tariffs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shadow_block">
    <div class="row" style="margin-top:3%;padding: 2% 8%;width: 110%;margin-left: -5%;background-color: white">

        <h2 style="font-weight: bold;text-align:center!important;color:rgb(148, 196, 61)"><span style="margin-left: 1%">Тарифные планы и цены на услуги</span>
            <div style="background-image: linear-gradient(270deg, rgb(248, 215, 53), rgb(148, 196, 61) 110%);
        width: 98%;
        height: 4px;"></div></h2>


        <div class="row">
            <div class="col-sm-6">
                <div class=podp_blue>Стартовая подписка</div>
                <ul class=tarifs_list>
                    <li>Создание собственной деловой карточки.</li>
                    <li>Создание списка товаров и услуг.</li>
                    <li>Доступ к банку готовых форм и шаблонов документов.</li>
                </ul>
            </div>
            <div class="col-sm-6">
                <div class=podp_green>Расширенная подписка</div>
                <ul class=tarifs_list>
                    <li>Включены все возможности стартовой подписки.</li>
                    <li>Ведение сделок онлайн при юридическом сопровождении.</li>
                    <li>Формирование собственного делового рейтинга.</li>
                    <li>Просмотр деловой репутации партнеров, оценка рисков.</li>
                    <li>Разрешение конфликтных ситуаций с участием медиатора.</li>
                    <li>Рассмотрение споров в Третейском суде.</li>
                </ul>
            </div>
        </div>

        <hr>

        <div class="row">
            <?php if ($tariffs):?>
                <?php foreach ($tariffs as $tariff):?>
                    <div class="col-sm-3">
                        <div class=price_block>
                            <span class=head><?=$tariff->name?></span>
                            <span class=price><?=Yii::t('app','Payment')?> : <strong><?=($tariff->price - ($tariff->price/100*$tariff->sale))?>&nbsp;<?=$tariff->currency->code?></strong><br> <?=Yii::t('app','Per month')?> : <strong><?=(($tariff->price - $tariff->price/100*$tariff->sale)/$tariff->months)?>&nbsp;<?=$tariff->currency->code?></strong></span>
                            <span class=comment style=<?=$tariff->sale === 0?"background-color:#d00000;":"background-color:#94c43d;"?> >
                                <?=$tariff->sale === 0 ? Yii::t('app','Not sale'):Yii::t('app','Sale').' '.$tariff->sale.'%'?>
                                <br>
                                <?=$tariff->sale === 0?Yii::t('app','No saving'):Yii::t('app','Saving').' '.($tariff->price/100*$tariff->sale).' '.$tariff->currency->code?>
                                <br>
                            </span>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif;?>

        </div>

        <div style="text-align:center; margin-top:30px;margin-bottom: 30px">
            <?php if(!Yii::$app->user->isGuest):?>
                <a href="/admin/billing" class="oplata">Оплатить подписку</a>
            <?php endif;?>
            <?php if(Yii::$app->user->isGuest):?>
                <a href="javascript:void(0)" data-target="#SignUp" data-toggle="modal" class="oplata">Зарегистрироваться</a>
            <?php endif;?>
        </div>

    </div>
</div>
<div class="shadow_block">
    <div class="row" style="margin-top:7%;padding: 2% 8%;width: 110%;margin-left: -5%;background-color: white">
        <h2 style="font-weight: bold;text-align:center!important;color:rgb(148, 196, 61)"><span style="margin-left: 1%">Способы оплаты</span>
            <div style="background-image: linear-gradient(270deg, rgb(248, 215, 53), rgb(148, 196, 61) 110%);
        width: 98%;
        height: 4px;"></div></h2>

        <div class="row info_block">



            <div class="row info_block" style="margin-right: 0!important;">
                <div class="col-xs-12" >
                    <div class="col-xs-12 col-sm-6 block_text_info">
                        <div class="col-xs-12 col-sm-3" style="text-align:center; ">
                            <span class="glyphicon glyphicon-list-alt" style="color: #4B7BBE;font-size: 42pt"></span>
                        </div>

                        <div class="col-xs-12 col-sm-9">
                            <h2 class="text-left">Расчетный счет</h2>
                            <p>
                            <ul class="tarifss_list">
                                <li>Счет на оплату формируется автоматически.
                                    После оплаты передается Акт выполненных работ.
                                    Без дополнительных комиссий.</li>

                            </ul>
                            </p>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 block_text_info">
                        <div class="col-xs-12 col-sm-9">
                            <h2 class="text-right">Оплата через Pay Master</h2>
                            <p>
                            <ul class="tarifss_list1">
                                <li>С лицевого счета пользователя или наличными через терминалы по квитанции.</li>


                            </ul>
                            </p>
                        </div>
                        <div class="col-xs-12 col-sm-3" style="text-align: center">
                            <span class="glyphicon glyphicon-phone" style="color: #4B7BBE;font-size: 42pt"></span>
                        </div>
                    </div>


                </div>



            </div>
        </div>
    </div>
</div>
