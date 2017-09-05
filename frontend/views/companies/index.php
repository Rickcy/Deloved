<?php
/**
 * @var $category \common\models\Category;
 * @var $company \common\models\Account;
 */
use common\models\Account;
use yii\helpers\StringHelper;

$this->title = Yii::t('app', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="show-all">


    <div class="col-md-3 col-lg-3" style="">



        <div class=left_block>
            <div class=head style="text-align: center">Категории партнеров</div>


            <div class="category">
                <ul class="directory" style="overflow-y: scroll;height: 630px">
                    <?php foreach ($categoriesGoods as $category):?>
                        <li><a href="/companies/index?cat=<?=$category->id?>"><?=$category->name?></a></li>
                    <?php endforeach;?>
                    <hr>
                    <?php foreach ($categoriesServices as $category):?>
                        <li><a href="/companies/index?cat=<?=$category->id?>"><?=$category->name?></a></li>
                    <?php endforeach;?>
                </ul>

            </div>



        </div>
    </div>

    <div class="col-md-6 col-lg-6 ndblock" style="min-height: 800px">



        <h1 style="padding-bottom: 15px" class="text-center">
        <?php if ($activeCat):?>
            <?=$activeCat->name?>
            <?php else:?>
            Предприятия
            <?php endif;?>
        </h1>
        <?php if ($companies):?>
            <?php foreach ($companies as $company):?>
        <div class="row minicart">
          <div class="col-md-12 ">
            <div class="row">
                <div class="col-xs-4 col-sm-3  " style=" text-align: center;">
                        <?php if($company->logos):?>

                            <img class="img-thumbnail" style="border: none"
                                 src="<?=$company->logos->file?>"/>
                        <?php else:?>
                            <img class="img-thumbnail img_left" src="/uploads/default/logo_default.png" style="border: none"/>
                        <?php endif;?>



                    </div>

                    <div class="col-sm-4 col-xs-8" >

                        <a href="/goods/item/?id=<?=$company->id?>"><?=$company->brand_name?></a>





                        <div class="description"><?=StringHelper::truncateWords($company->description,10,'...')?></div>






                    </div>

                    <div class="col-xs-12 col-sm-5" >

                        <div class="gray_block">

                            Рейтинг : <span class="rating"><?=Account::getRating($company->rating)?></span>
                            <br>Отзывы: Нет
                            <br><br>




                        </div>
                        <a href="/goods/item?id=<?=$company->id?>" class="podr" style="text-align: center" >
                            Подробнее
                        </a>
                    </div>
                 </div>
              <ul class=cont>
                  <li>
                      <img src="/images/front/local.png"/>	<span class="property-value" aria-labelledby="city-label"><?=$company->city->name?></span>
                  </li>

              </ul>
            </div>
        </div>
            <?php endforeach;?>
        <?php endif;?>
        <?php if ($dataProvider->totalCount > 10):?>
            <?php echo \yii\widgets\LinkPager::widget([
                'pagination' => $dataProvider->pagination
            ]) ?>
        <?php endif;?>
    </div>




    </div>
    <?php if ($company_show_main):?>
        <div class="col-md-3 col-lg-3" style="">
            <div class=left_block style="padding-bottom: 40px">
                <div class="head"  style="text-align: center;">Выгодные предложения</div>
                <?php if (count($company_show_main) > 2):?>
                    <ul class="GoodsMain" style="padding: 0;text-align: center;">
                        <?php foreach ($company_show_main as $item):?>
                            <li class="tablettt" style="width:50%;font-size: 90%;text-align: center;box-shadow: 0 0 10px #c8c8c8; border-radius: 10px;">

                                <a href="/goods/item?id=<?=$item->id?>">
                                    <?php if($item->logos):?>

                                        <img class="img-thumbnail" style="border: none;width: 171px;max-height: 171px"
                                             src="<?=$item->logos->file?>"/>
                                    <?php else:?>
                                        <img class="img-thumbnail img_left" src="/uploads/default/logo_default.png" style="border: none;width: 171px;max-height: 171px"/>
                                    <?php endif;?>
                                    <br>
                                    <span><?=$item->brand_name?><br>


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

                        <?php foreach ($company_show_main as $item):?>
                            <li class="tablet" style="width:60%;font-size: 90%;">

                                <a href="/goods/item?id=<?=$item->id?>">
                                    <?php if($item->logos):?>

                                        <img class="img-thumbnail" style="border: none;width: 171px;max-height: 171px"
                                             src="<?=$item->logos->file?>"/>
                                    <?php else:?>
                                        <img class="img-thumbnail img_left" src="/uploads/default/logo_default.png" style="border: none;width: 171px;max-height: 171px"/>
                                    <?php endif;?>
                                    <br>
                                    <span>
                                        <?=$item->brand_name?><br>

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
