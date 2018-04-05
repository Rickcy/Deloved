<?php

use common\models\Account;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\jui\AutoComplete;

/**
 * @var $item \common\models\Account;
 */
$this->title = 'Поиск партнера';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reg_form2" style="position: fixed;left:0px;top: 210px;">



    <form action="/companies/search" method="post">

        <div class="lead">Введите ключевое слово, ИНН или другую известную информацию</div>


        <input type="text" required="" name="search" class="search_big" value="<?=$search?>" id="search">

        <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />




        <div class="row">
            <div class="col-md-6" style="width: 70%">

                Выбор региона
                <?php echo AutoComplete::widget([
                    'name' => 'region',
                    'clientOptions' => [
                        'source' => $region_list,
                        'minLength' => 2,
                    ],
                    'options'=>[
                        'class'=>'form-control'
                    ],
                ]);?>
                Выбор города
                <?php echo AutoComplete::widget([
                    'name' => 'city',
                    'clientOptions' => [
                        'source' => $city_list,
                        'minLength' => 2,
                    ],
                    'options'=>[
                        'class'=>'form-control'
                    ],
                ]);?>
           </div>

            <div class="col-md-6" style="width: 70%">

                Выбор категорий


                <?php echo AutoComplete::widget([
                    'name' => 'cat',
                    'clientOptions' => [
                        'source' => $categ_list,
                        'minLength' => 2,
                    ],
                    'options'=>[
                        'class'=>'form-control',
                        'id'=>'cats'
                    ],
                ]);?>

            </div>

        </div>





        <br>


        <div style="text-align: center">
            <button class="btn btn-success btn-lg" style="float: right;width: 50%" type="submit">Поиск</button>


        </div>
    </form>
</div>



<h3 style="text-align: right;margin-right: 120px;">Результаты поиска <span style="margin-left: 10px" class="glyphicon glyphicon-search"></span></h3>
<div class="row">
    <div class="col-md-7 r1 " style="float: right;margin-right: 2%;min-height: 550px">
       <?php if (count($acc) > 0):?>
       <?php foreach ($acc as $item):?>
               <div class="row minicart">
                   <div class="col-md-12 ">
                       <div class="row">
                           <div class="col-xs-4 col-sm-3  " style=" text-align: center;margin-top: 20px;">
                               <a target="_blank" href="/companies/item/?id=<?=$item->id?>">
                                   <?php if($item->logos):?>

                                       <img class="img-thumbnail" style="border: none"
                                            src="<?=$item->logos->file?>"/>
                                   <?php else:?>
                                       <img class="img-thumbnail img_left" src="/uploads/default/logo_default.png" style="border: none"/>
                                   <?php endif;?>
                               </a>


                           </div>

                           <div class="col-sm-4 col-xs-8" style="margin-top: 20px;">

                               <a target="_blank"  href="/companies/item/?id=<?=$item->id?>"><?=$item->brand_name?></a>

                               <div class="description"><?=StringHelper::truncateWords($item->description,10,'...')?></div>

                           </div>

                           <div class="col-xs-12 col-sm-5" >

                               <div class="gray_block">

                                   <span style="color: #94c43d;">Рейтинг : </span><span class="rating"><?=Account::getRating($item)?></span>
                                   <br>

                                   <?php
                                   $countReview = \common\models\Review::find()->where(['about_id'=>$item->id])->andWhere(['published'=>true])->count();
                                   if(($countReview) > 0):?>
                                       <a href="javascript:void(0)" data-target="#Reviews-<?=$item->id?>" data-toggle="modal" class="otz">Отзывы(<?=$countReview?>)</a>
                                   <?php else:?>
                                       <span style="color: #94c43d;" >Отзывы : </span> Отсутствуют
                                   <?php endif;?>
                                   <br><br>

                               </div>
                               <a target="_blank"  href="/companies/item?id=<?=$item->id?>" class="podr" style="text-align: center" >
                                   Подробнее
                               </a>
                           </div>
                       </div>
                       <ul class=cont>
                           <li>
                               <img src="/images/front/local.png"/>	<span class="property-value" aria-labelledby="city-label"><?=$item->city_id?$item->city->name:''?></span>
                           </li>

                       </ul>
                   </div>
               </div>
        <?php endforeach;?>
        <?php else:;?>
        <h4 style="text-align: center;margin-top: 150px;">Ничего не найдено</h4>
        <?php endif;?>
        <a href="#" style="opacity: 0" class="u"><img src="/assets/front/Arrow-7c5de6bad594735cd512c95e9c2da9a1.png" style="width: 20%;min-width: 45px"></a>
    </div>

</div>
