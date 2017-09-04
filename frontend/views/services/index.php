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
            <div class=head style="text-align: center">Категории товаров</div>


            <div class="category">
                <ul class="directory" style="overflow-y: scroll;height: 630px">
                    <?php foreach ($categories as $category):?>
                        <li><?=$category->name?></li>
                    <?php endforeach;?>
                </ul>

            </div>



        </div>
    </div>

    <div class="col-md-6 col-lg-6 ndblock" style="min-height: 800px">



        <h1 style="padding-bottom: 15px" class="text-center">Услуги</h1>
        <?php if ($services):?>
            <?php foreach ($services as $service):?>
                <div class="row minicart lc">
                    <div class="col-xs-4 col-sm-3" style=" text-align: center;">
                        <?php if(count($service->photo) >0):?>

                            <img class="img-thumbnail" style="border: none"
                                 src="<?=$service->photo[0]->filePath?>"/>
                        <?php else:?>
                            <img class="img-thumbnail img_left" src="/uploads/default/goods.png" style="border: none"/>
                        <?php endif;?>



                    </div>

                    <div class="col-sm-4 col-xs-8" >

                        <a href="/goods/item/?id=<?=$service->id?>"><?=$service->name?></a>





                        <div class="description"><?=$service->description?></div>

                        <div class=price><?=$service->price?> Рублей</div>

                        <div class="date_create"><?=$service->date_created?></div>

                        <a href="/goods/item?id=<?=$service->id?>" class="podr" style="text-align: center" >
                            Подробнее
                        </a>


                    </div>

                    <div class="col-xs-12 col-sm-5" >

                        <div class="gray_block">


                            Поставщик: <a href="/companies/item?id=<?=$service->account->id?>" ><?=$service->account->brand_name?></a>







                            <br>Город: <?= $service->account->city->name?>


                            <br>Адресс: <?= $service->account->address?>


                            <br><br>

                            <button class="deal_button" style="border: none;min-width: 143px;background-color: grey; text-align: left" >Предложить сделку</button>


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

                                <a href="/goods/item?id=<?=$item->id?>">
                                    <?php if(count($item->photo) >0):?>

                                        <img class="img-thumbnail" style="border: none"
                                             src="<?=$item->photo[0]->filePath?>"/>
                                    <?php else:?>
                                        <img class="img-thumbnail img_left" src="/uploads/default/goods.png" style="border: none"/>
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

                                <a href="/goods/item?id=<?=$item->id?>">
                                    <?php if(count($item->photo)>0):?>

                                        <img class="img-thumbnail" style="border: none"
                                             src="<?=$item->photo[0]->filePath?>"/>
                                    <?php else:?>
                                        <img class="img-thumbnail img_left" src="/uploads/default/goods.png" style="border: none"/>
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
