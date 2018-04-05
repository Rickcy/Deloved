<?php
/**
 * @var $company \common\models\Account;
 */
/* @var $this yii\web\View */
use common\models\Account;
$this->title = Account::getTrimName($company->full_name);
$this->registerMetaTag(['name' => 'keywords', 'content' => $company->keywords]);
$this->registerMetaTag(['name' => 'description', 'content' => $company->description]);
$this->registerJsFile('https://api-maps.yandex.ru/2.0/?load=package.standard&lang=ru-RU',  ['position' => yii\web\View::POS_BEGIN]);
?>
<div class="item-company">
    <div class="col-xs-12">
    <div class="row big_cart" style="padding-top:20px;box-shadow: 0 0 20px #d8d8d8;border-radius: 20px;margin-top: 10px;margin-bottom: 10px">

        <div class="col-md-3">
            <?php if ($company->logos):?>
            <div class="text-center">
                <img class="img-thumbnail img_left" style="border: none" src="<?=$company->logos->image_name?>">
            </div>
            <?php endif;?>
            <h2 style="text-align: left">

               <?=Account::getTrimName($company->full_name)?>

            </h2>
            <div class="forma" style="text-align: left">
                <?= $company->orgForm->name?>
            </div>
            <hr>
            <p style="font-size: 12pt;width: 90%;text-align: left;font-family: Verdana, Geneva, sans-serif;">
                <b>ИНН:</b>	<?=$company->inn?>
            </p>
            <br>
            <p style="font-size: 12pt;width: 90%;text-align: left;font-family: Verdana, Geneva, sans-serif;">
                <b>ОГРН:</b> <?=$company->ogrn?>
            </p>

            <hr>

            <div class="gray_block" style="margin-top: 10px;">

                <h4>Рейтинг
                    <?php if(Yii::$app->user->isGuest):?>
                    <div class="hint">
                        <span class="hint-badge glyphicon glyphicon-question-sign"></span>
                        <div class="alert alert-info hint-text ">
                            Просмотр рейтинга, отзывов и статистики доступен только для зарегистрированных пользователей
                        </div>
                    </div>
                    <?php endif;?>
                </h4>
                <?php if(!Yii::$app->user->isGuest):?>
                <span class="rating">
                    <?=Account::getRating($company)?></span>
                <br>

                <?php
                $countReview = \common\models\Review::find()->where(['about_id'=>$company->id])->andWhere(['published'=>true])->count();
                if(($countReview) > 0):?>
                <a href="javascript:void(0)" data-target="#Reviews-<?=$company->id?>" data-toggle="modal" class="otz">Отзывы(<?=$countReview?>)</a>
                <?php else:?>
                    <span class="otz" >Отзывы : </span> Отсутствуют
                <?php endif;?>
                <a href="javascript:void(0)" class="stat">Статистика</a>
                <?php endif;?>
            </div>


            <div class="claim_block">

                <?php if(Yii::$app->user->isGuest):?>
                    <a href="javascript:void(0)" onclick="noAuth()" style="margin-top: 15px;padding-left: 10px" class="info_button" ><span style="font-size: 13pt;margin-right: 8px;" class="glyphicon glyphicon-eye-open"></span>Проверить контрагента</a>
                    <a href="javascript:void(0)" onclick="noAuth()" class="deal_button" >Предложить сделку</a>
                    <a  class="review_button" href="javascript:void(0)" onclick="noAuth()">Оставить отзыв</a>
                    <hr>
                    <a class="claim_button" href="javascript:void(0)" onclick="noAuth()">Разрешить спор</a>

                    <a class="jud_button" href="javascript:void(0)" onclick="noAuth()">Подать иск</a>
                <?php else:?>
                <?php if (\common\models\User::checkRole(['ROLE_USER'])):?>
                    <?php if($company->verify_status == true):?>
                        <?php if ($company->isMyAccount()):?>
                            <button class="info_button" style="border: none; background-color: grey; text-align: left" data-toggle="popover"><span style="font-size: 14pt;margin-right: 6px;" class="glyphicon glyphicon-eye-open"></span>Проверить контрагента</button>
                            <button class="deal_button" style="border: none; background-color: grey; text-align: left" data-toggle="popover">Предложить сделку</button>
                            <button class="review_button" style="border: none; background-color: grey; text-align: left" data-toggle="popover">Оставить отзыв</button>
                            <hr>
                            <button class="claim_button" style="border: none; background-color: grey; text-align: left" data-toggle="popover">Разрешить спор</button>
                            <button class="jud_button" style="border: none; background-color: grey; text-align: left" data-toggle="popover">Подать иск</button>
                        <?php else:;?>
                            <a href="/admin/information/index?id=<?=$company->id?>" onclick="noAuth()" style="margin-top: 15px;padding-left: 10px" class="info_button" ><span style="font-size: 14pt;margin-right: 6px;" class="glyphicon glyphicon-eye-open"></span>Проверить контрагента</a>
                            <a href="/admin/deal/create?id=<?=$company->id?>" class="deal_button" >Предложить сделку</a>
                            <a  class="review_button" href="/admin/deal/index#select-for-review" >Оставить отзыв</a>
                            <hr>
                            <a class="claim_button" href="/admin/deal/index#select-for-claim">Разрешить спор</a>

                            <a class="jud_button" href="/admin/deal/index#select-for-dispute">Подать иск</a>
                        <?php endif;?>
                    <?php else:;?>
                            <button class="info_button" style="border: none; background-color: grey; text-align: left"><span style="font-size: 14pt;margin-right: 6px;" class="glyphicon glyphicon-eye-open"></span>Проверить контрагента</button>
                            <button class="deal_button" style="border: none; background-color: grey; text-align: left" >Предложить сделку</button>
                            <button class="review_button" style="border: none; background-color: grey; text-align: left" >Оставить отзыв</button>
                            <hr>
                            <button class="claim_button" style="border: none; background-color: grey; text-align: left" >Разрешить спор</button>
                            <button class="jud_button" style="border: none; background-color: grey; text-align: left" >Подать иск</button>
                    <?php endif;?>
                    <?php else:;?>
                        <button class="info_button" style="border: none; background-color: grey; text-align: left" data-toggle="popover"><span style="font-size: 14pt;margin-right: 6px;" class="glyphicon glyphicon-eye-open"></span>Проверить контрагента</button>
                        <button class="deal_button" style="border: none; background-color: grey; text-align: left" data-toggle="popover">Предложить сделку</button>
                        <button class="review_button" style="border: none; background-color: grey; text-align: left" data-toggle="popover">Оставить отзыв</button>
                        <hr>
                        <button class="claim_button" style="border: none; background-color: grey; text-align: left" data-toggle="popover">Разрешить спор</button>
                        <button class="jud_button" style="border: none; background-color: grey; text-align: left" data-toggle="popover">Подать иск</button>
                    <?php endif;?>
                <?php endif;?>



                <script>
                    var template = ['<div class="timePickerWrapper popover">',
                        '<div class="arrow"></div>',
                        '<div class="popover-content">',
                        '</div>',
                        '</div>'].join('');

                    var content= '';
                    <?php if(!Yii::$app->user->isGuest):?>
                    <?php if (\common\models\User::checkRole(['ROLE_USER'])):?>
                    <?php if ($company->isMyAccount()):?>
                     content = ['<div>Данная возможность доступна только <a href="javascript:void(0)">владельцам расширенной подписки</a></div>'
                     ].join('');
                    <?php endif;?>

                    <?php if ($company->isMyAccount()):?>
                     content = ['<div>Целью этого действия не может является ваше же предприятие.</div>'
                     ].join('');
                    <?php endif;?>
                    <?php else:?>
                     content = ['<div>Данное действие вам недоступно</div>'
                     ].join('');
                    <?php endif;?>

                    <?php else:;?>
                    content = ['<div>Данное действие вам недоступно</div>'
                    ].join('');
                    <?php endif;?>
                    $(document).ready(function(){

                        $('[data-toggle="popover"]').popover({
                            template: template,
                            content: content,
                            html: true
                        });

                        $('[data-toggle="popover"]').on('click', function (e) {
                            $('[data-toggle="popover"]').not(this).popover('hide');
                        });

                    });

                </script>



            </div>


        </div>

        <div class="col-md-7">
        <?php if($company->verify_status != true):?>
            <br>
            <div class="glyphicon glyphicon-ban-circle status" style="color: red;font-size: 12pt;"> Данный пользователь не авторизован!</div>
            <hr>
        <?php endif;?>

            <h2 style="border-bottom: 2px solid #6fb35b;border-left:2px solid #6fb35b;border-radius: 20px;border-right:2px solid #6fb35b;">О компании</h2>

            <?php if ($company->description):?>
            <div class="description" style="text-align: center">

               <?=$company->description?>

            </div>
            <hr>
            <?php endif;?>
            <div class="clearfix"></div>
            <?php if (count($company->goods) > 0):?>
                <div class="searchandgoods">



                    <h2 style="border-bottom: 2px solid #6fb35b;border-right:2px solid #6fb35b;border-left:2px solid #6fb35b;border-radius: 20px">
                        Наши предложения</h2>
                    <ul class="bxsliderServices" style="padding: 0;text-align: center">
                        <?php foreach ($company->goods as $goods):?>

                            <li class="tablet">
                                <a href="/goods/item?id=<?=$goods->id?>">



                                    <img class="img-thumbnail" width="77%" src="/uploads/default/goods.png" style="border: none">


                                    <div><?=$goods->name?></div>
                                    <span><?=$goods->price?></span> <span><?=$goods->currency->name?></span>
                                </a>
                            </li>

                        <?php endforeach;?>
                    </ul>

                </div>
            <?php endif;?>
            <div class="clearfix"></div>
            <?php if (count($company->services) > 0):?>
            <div class="searchandservice">



                <h2 style="border-bottom: 2px solid #6fb35b;border-right:2px solid #6fb35b;border-left:2px solid #6fb35b;border-radius: 20px">
                   Наши услуги</h2>
                <ul class="bxsliderServices" style="padding: 0;text-align: center">
                <?php foreach ($company->services as $service):?>

                    <li class="tablet">
                        <a href="/services/item?id=<?=$service->id?>">



                            <img class="img-thumbnail" width="77%" src="/uploads/default/goods.png" style="border: none">


                            <div><?=$service->name?></div>
                            <span><?=$service->price?></span> <span><?=$service->currency->name?></span>
                        </a>
                    </li>

                <?php endforeach;?>
                </ul>

            </div>
        <?php endif;?>


        </div>

        <div class="col-md-2">

            <img src="/images/front/local.png">
            <span class="property-value" aria-labelledby="city-label"><?=$company->city_id?$company->city->name:''?></span>


            <br>

            <script type="application/javascript">
                var myMap = null;
                var myPlacemark = null;
                function showAddres(city, addr) {
                    //console.log(city + "," + addr);
                    if (city != "") {
                        ymaps.geocode(city + (addr != "" ? (", " + addr) : ""), {results: 1}).then(function (res) {
                            // Выбираем первый результат геокодирования
                            var firstGeoObject = res.geoObjects.get(0);
                            var center = firstGeoObject.geometry.getCoordinates();
                            myMap = new ymaps.Map("map", {
                                center: center,
                                zoom: addr != "" ? 15 : 13
                            });
                            if (addr != "") {
                                if (myPlacemark) {
                                    myMap.geoObjects.remove(myPlacemark);
                                }
                                myPlacemark = new ymaps.Placemark(firstGeoObject.geometry.getCoordinates(), {
                                    hintContent: addr
                                });
                                myMap.geoObjects.add(myPlacemark);
                            }
                            myMap.controls.add(new ymaps.control.ZoomControl());
                            var src = "http://static-maps.yandex.ru/1.x/?l=map&pt=" + center[1] + "," + center[0] + "&z=" + (addr != "" ? "16" : "10") + "&size=230,200";
                            $("#smallmap").append($("<img/>").attr("src", src))
                            $("#map").show();
                        }, function (err) {
                            console.error(err.message);
                        });
                    }
                }
                $(function () {
                    ymaps.ready(function () {
                        showAddres('<?=$company->city_id?$company->city->name:''?>', '<?=$company->legal_address?>');
                    });
                });
            </script>

            <div style="position: relative; width: 100%;max-width: 400px;margin: 0 auto">
                <a id="smallmap" href="#" onclick="return false;" data-toggle="modal" data-target="#myModalMap" style="display: block;position: relative;">
						<span class="map-link">
							<span class="glyphicon glyphicon-fullscreen btn-lg" style="vertical-align: middle;"></span>
							<span style="vertical-align: middle;text-align: left;display: inline-block;">Посмотреть адрес <br> на карте</span>
						</span>
                </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModalMap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="width: 80%;margin: 0 auto">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span></button>
                            <h4 class="modal-title" id="myModalLabel"><?=$company->city_id?$company->city->name:''?>  <?=$company->legal_address?></h4>
                        </div>

                        <div class="modal-body">
                            <div id="map" class="map img-thumbnail" style="width:100%; height:600px; display: none;"></div>

                        </div>
                    </div>
                </div>
            </div>




            <button class="btn-primary btn" style="margin-top: 25px;width: 100%" data-target="#myModalAff" data-toggle="modal">Список филиалов</button>




            <!--g:else-->
            <!-- Button trigger modal -->



            <!-- Modal -->
            <div class="modal fade" id="myModalAff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" style="text-align: center" id="myModalLabel">Список филиалов</h4>
                        </div>

                        <div class="modal-body">
                            <ul style="list-style: none">
                                <?php if (count($aff) >0):?>
                                <?php foreach($aff as $af):?>
                                <li>
                                    <ul style="list-style: none;margin-bottom: 30px;text-align: left">

                                        <li>Адресс : <?=$af->address?></li>


                                        <li>Город : <?=$af->city->name?></li>


                                        <li>Телефон : <?=$af->phone?></li>


                                        <li>E-mail : <?=$af->email?></li>

                                    </ul>

                                </li>

                                <hr>
                                <?php endforeach;?>
                                <?php endif;?>

                            </ul>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--/g:else-->
            <hr>




            <div class="manager">
                <b>Руководитель : </b><br>


                <span class="property-value" aria-labelledby="manager-label"><?=$company->director?></span>


                <hr>

            </div>
        <?php if ($company->work_time):?>
            <div class="worktime">
                <b>Режим работы : </b><br>

                <?=$company->work_time?>
                <hr>

            </div>
        <?php endif;?>


        </div>

    </div>
    </div>
</div>
<?=\frontend\widgets\ReviewsWidget::widget(['account'=>$company])?>
