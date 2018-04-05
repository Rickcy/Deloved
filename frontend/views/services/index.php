<?php
/**
 * @var $category \common\models\Category;
 * @var $good \common\models\Services;
 */
$this->title = Yii::t('app', 'Services');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="show-all">


    <div class="col-md-3 col-lg-3" style="">



        <div class=left_block>
            <div class=head style="text-align: center">Категории услуг</div>


            <div class="category">
                <ul class="directory" >
                    <?php if ($activeCat):?>
                        <li><a class="active" href="/services/index?cat=<?=$activeCat->id?>"><?=$activeCat->name?></a></li>
                    <?php endif;?>
                    <?php foreach ($categories as $category):?>
                        <li><a <?php if ($activeCat){
                                echo $activeCat->id == $category->id ?"class=active":"";
                            }
                            ?> href="/services/index?cat=<?=$category->id?>"><?=$category->name?></a></li>
                    <?php endforeach;?>
                </ul>

            </div>



        </div>
    </div>

    <div class="col-md-6 col-lg-6 ndblock" style="min-height: 800px">


        <?php if ($activeCat):?>
            <h2 style="padding-bottom: 15px" class="text-center">
                <?=$activeCat->name?>
            </h2>
            <ol class="breadcrumb" style="margin-top: 20px">
                <?php if ($activeCat):?>
                    <li><a href="/services/index">Главная</a></li>
                <?php endif;?>
                <?php if ($activeCat->parent_id):?>
                    <?php if ($activeCat->parent_id != 1228 && $activeCat->parent_id != 1343):?>
                        <li><a href="/services/index?cat=<?=$activeCat->parent->id?>"><?= $activeCat->parent->name?></a></li>
                    <?php endif;?>
                <?php endif;?>
                <li><?=$activeCat->name?></li>
            </ol>
        <?php else:?>
            <h2 style="padding-bottom: 15px" class="text-center">
                Услуги
            </h2>
        <?php endif;?>
        <?php if ($services):?>
            <?php foreach ($services as $service):?>
                <div class="row minicart lc">
                    <div class="col-xs-4 col-sm-3" style=" text-align: center;margin-top: 20px;">
                        <?php if(count($service->photo) >0):?>

                            <img class="img-thumbnail" style="border: none"
                                 src="<?=$service->photo[0]->filePath?>"/>
                        <?php else:?>
                            <img class="img-thumbnail img_left" src="/uploads/default/goods.png" style="border: none"/>
                        <?php endif;?>



                    </div>

                    <div class="col-sm-4 col-xs-8" style="margin-top: 20px;" >

                        <a href="/services/item/?id=<?=$service->id?>"><?=$service->name?></a>





                        <div class="description"><?=$service->description?></div>

                        <div class=price><?=$service->price?> Рублей</div>

                        <div class="date_create"><?=$service->date_created?></div>

                        <a href="/services/item?id=<?=$service->id?>" class="podr" style="text-align: center" >
                            Подробнее
                        </a>


                    </div>

                    <div class="col-xs-12 col-sm-5" >

                        <div class="gray_block">


                            Поставщик: <a href="/companies/item?id=<?=$service->account->id?>" ><?=$service->account->brand_name?></a>







                            <br>Город: <?= $service->account->city->name?>


                            <br>Адресс: <?= $service->account->address?>


                            <br><br>

                            <?php if (!Yii::$app->user->isGuest):?>
                                <?php if (!$service->account->verify_status):?>
                                    <button class="deal_button" style="border: none; background-color: grey; text-align: left" data-toggle="popover">Предложить сделку</button>
                                <?php else:?>
                                    <a href="/admin/deal/create?service=<?=$service->id?>" class="deal_button" style="border: none;min-width: 143px; text-align: left" >Предложить сделку</a>
                                <?php endif;?>
                            <?php else:?>
                                <a href="javascript:void(0)" onclick="noAuth()" class="deal_button" >Предложить сделку</a>
                            <?php endif;?>

                        </div>

                    </div>

                </div>
            <?php endforeach;?>
        <?php endif;?>



        <?php if ($dataProvider->count > 20):?>
            <?php echo \yii\widgets\LinkPager::widget([
                'pagination' => $dataProvider->pagination
            ]) ?>
        <?php endif;?>


    </div>
    <?php if ($services_show_main):?>
        <div class="col-md-3 col-lg-3" style="">
            <div class=left_block style="padding-bottom: 40px">
                <div class="head"  style="text-align: center;">Выгодные предложения</div>
                <?php if (count($services_show_main) > 2):?>
                    <ul class="GoodsMain" style="padding: 0;text-align: center;">
                        <?php foreach ($services_show_main as $item):?>
                            <li class="tablettt" style="width:50%;font-size: 90%;text-align: center;box-shadow: 0 0 10px #c8c8c8; border-radius: 10px;">

                                <a href="/services/item?id=<?=$item->id?>">
                                    <?php if(count($item->photo) >0):?>

                                        <img class="img-thumbnail" style="border: none;width: 171px;max-height: 171px"
                                             src="<?=$item->photo[0]->filePath?>"/>
                                    <?php else:?>
                                        <img class="img-thumbnail img_left" src="/uploads/default/goods.png" style="border: none;width: 171px;max-height: 171px"/>
                                    <?php endif;?>
                                    <br>
                                    <span><?=$item->name?><br>
                                        <?=$item->price?>

							</span>
                                </a>



                            </li>
                        <?php endforeach;?>


                    </ul>
                    <script>

                        $('.GoodsMain').bxSlider({
                            mode:'vertical',
                            minSlides: 2,
                            moveSlides:1,
                            maxSlides: 20,
                            slideWidth: 210,
                            slideMargin: 10,
                            auto: true,
                            pause: 0,
                            speed: 4500,

                            autoHover:true
                        });

                    </script>
                <?php else:?>
                    <ul class="GoodsMain" style="padding: 0;text-align: center;">

                        <?php foreach ($services_show_main as $item):?>
                            <li class="tablet" style="width:60%;font-size: 90%;">

                                <a href="/services/item?id=<?=$item->id?>">
                                    <?php if(count($item->photo)>0):?>

                                        <img class="img-thumbnail" style="border: none;width: 171px;max-height: 171px"
                                             src="<?=$item->photo[0]->filePath?>"/>
                                    <?php else:?>
                                        <img class="img-thumbnail img_left" src="/uploads/default/goods.png" style="border: none;width: 171px;max-height: 171px"/>
                                    <?php endif;?>
                                    <br>
                                    <span>
                                        <?=$item->name?><br>
                                        <?=$item->price?>
										</span>
                                </a>


                            </li>
                        <?php endforeach;?>

                    </ul>
                <?php endif;?>


            </div>
        </div>
    <?php endif;?>
</div>
<script>
    $(document).ready(function(){
        var template = ['<div class="timePickerWrapper popover">',
            '<div class="arrow"></div>',
            '<div class="popover-content">',
            '</div>',
            '</div>'].join('');
        var  content = ['<div>Данный пользователь не авторизован</div>'
        ].join('');
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