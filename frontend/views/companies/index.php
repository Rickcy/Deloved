<?php
/**
 * @var $category \common\models\Category;
 * @var $activeCat \common\models\Category;
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
                <ul class="directory" >
                    <h3>Категория Товаров</h3>
                    <?php foreach ($categoriesGoods as $category):?>
                        <li >
                            <a <?php if ($activeCat){
                                echo $activeCat->id == $category->id ?"class=active":"";
                            }
                            ?> href="/companies/index?cat=<?=$category->id?>"><?=$category->name?></a></li>
                    <?php endforeach;?>
                    <hr>
                    <h3>Категория Услуг</h3>
                    <?php foreach ($categoriesServices as $category):?>
                        <li ><a <?php if ($activeCat){
                                echo $activeCat->id == $category->id ?"class=active":"";
                            }
                            ?> href="/companies/index?cat=<?=$category->id?>"><?=$category->name?></a></li>
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
                <?php if ($activeCat->parent_id == 1228 || $activeCat->parent_id == 1343):?>
                    <li><a href="/companies/index">Главная</a></li>
                <?php endif;?>
                <?php if ($activeCat->parent_id):?>
                    <?php if ($activeCat->parent_id != 1228 && $activeCat->parent_id != 1343):?>
                       <li><?= $activeCat->parent->name?></li>
                    <?php endif;?>
                <?php endif;?>
                <li><?=$activeCat->name?></li>
            </ol>
            <?php else:?>
        <h2 style="padding-bottom: 15px" class="text-center">
            Предприятия
        </h2>
            <?php endif;?>

        <?php if ($companies):?>
            <?php foreach ($companies as $company):?>
                <?=\frontend\widgets\ReviewsWidget::widget(['account'=>$company])?>
        <div class="row minicart">
          <div class="col-md-12 ">
            <div class="row">
                <div class="col-xs-4 col-sm-3  " style=" text-align: center;margin-top: 20px;">
                    <a href="/companies/item/?id=<?=$company->id?>">
                        <?php if($company->logos):?>

                            <img class="img-thumbnail" style="border: none"
                                 src="<?=$company->logos->file?>"/>
                        <?php else:?>
                            <img class="img-thumbnail img_left" src="/uploads/default/logo_default.png" style="border: none"/>
                        <?php endif;?>
                    </a>


                    </div>

                    <div class="col-sm-4 col-xs-8" style="margin-top: 20px;">

                        <a href="/companies/item/?id=<?=$company->id?>"><?=$company->brand_name?></a>

                        <div class="description"><?=StringHelper::truncateWords($company->description,10,'...')?></div>

                    </div>

                    <div class="col-xs-12 col-sm-5" >

                        <div class="gray_block">

                            <span style="color: #94c43d;">Рейтинг : </span><span class="rating"><?=Account::getRating($company)?></span>
                            <br>

                            <?php
                            $countReview = \common\models\Review::find()->where(['about_id'=>$company->id])->andWhere(['published'=>true])->count();
                            if(($countReview) > 0):?>
                                <a href="javascript:void(0)" data-target="#Reviews-<?=$company->id?>" data-toggle="modal" class="otz">Отзывы(<?=$countReview?>)</a>
                            <?php else:?>
                                <span style="color: #94c43d;" >Отзывы : </span> Отсутствуют
                            <?php endif;?>
                            <br><br>

                        </div>
                        <a href="/companies/item?id=<?=$company->id?>" class="podr" style="text-align: center" >
                            Подробнее
                        </a>
                    </div>
                 </div>
              <ul class=cont>
                  <li>
                      <img src="/images/front/local.png"/>	<span class="property-value" aria-labelledby="city-label"><?=$company->city_id?$company->city->name:''?></span>
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

                                <a href="/companies/item?id=<?=$item->id?>">
                                    <?php if($item->logos):?>

                                        <img class="img-thumbnail" style="border: none;width: 171px;max-height: 171px"
                                             src="<?=$item->logos->file?>"/>
                                    <?php else:?>
                                        <img class="img-thumbnail img_left" src="/uploads/default/logo_default.png" style="border: none;width: 171px;max-height: 171px"/>
                                    <?php endif;?>
                                    <br>
                                    <div><?=$item->brand_name?><br>


							</div>
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

                                <a href="/companies/item?id=<?=$item->id?>">
                                    <?php if($item->logos):?>

                                        <img class="img-thumbnail" style="border: none;width: 171px;max-height: 171px"
                                             src="<?=$item->logos->file?>"/>
                                    <?php else:?>
                                        <img class="img-thumbnail img_left" src="/uploads/default/logo_default.png" style="border: none;width: 171px;max-height: 171px"/>
                                    <?php endif;?>
                                    <br>
                                    <div>
                                        <?=$item->brand_name?><br>

										</div>
                                </a>


                            </li>
                        <?php endforeach;?>

                    </ul>
                <?php endif;?>


            </div>
        </div>
    <?php endif;?>
</div>
