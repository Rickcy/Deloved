<?php

use common\models\Account;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\jui\AutoComplete;

/**
 * @var $item \common\models\Goods;
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


                Выбор региона и города
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

                <select class="form-control" name="cat" id="cats">
                    <option value=""></option>
                    <?php foreach ($cats as $item):?>
                        <option value="<?=$item['id']?>"><?=$item['name']?></option>
                    <?php endforeach;?>
                </select>


            </div>

        </div>


        <div class="row">
            <div class="col-md-3" style="width: 30%;margin-top: 10px">
                <input type="text" placeholder="Цена от" class="form-control" name="priceMin" value="" id="priceMin">
            </div>

            <div class="col-md-3" style="width: 30%;margin-top: 10px">
                <input type="text" placeholder="Цена до" class="form-control" name="priceMax" value="" id="priceMax">
            </div>


            <div class="col-md-3">

            </div>


            <div class="col-md-3">

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
                <div class="row minicart lc">
                    <div class="col-xs-4 col-sm-3" style=" text-align: center;margin-top: 20px;">
                        <?php if(count($item->photo) >0 ):?>

                            <img class="img-thumbnail" style="border: none"
                                 src="<?=$item->photo[0]->filePath?>"/>
                        <?php else:?>
                            <img class="img-thumbnail img_left" src="/uploads/default/goods.png" style="border: none"/>
                        <?php endif;?>

                        <?php if ($item->availability == 1):?>
                            <div class="availability">В наличии</div>
                        <?php else:;?>
                            <div class="availability">Под заказ</div>
                        <?php endif;?>

                    </div>

                    <div class="col-sm-4 col-xs-8" style="margin-top: 20px;">

                        <a target="_blank" href="/goods/item/?id=<?=$item->id?>"><?=$item->name?></a>


                        <div class="description"><?=StringHelper::truncateWords($item->description,10,'...')?></div>

                        <div class=price><?=$item->price?> Рублей</div>

                        <div class="date_create"><?=$item->date_created?></div>

                        <a target="_blank" href="/goods/item?id=<?=$item->id?>" class="podr" style="text-align: center" >
                            Подробнее
                        </a>


                    </div>

                    <div class="col-xs-12 col-sm-5" >

                        <div class="gray_block">


                            Поставщик: <a target="_blank" href="/companies/item?id=<?=$item->account->id?>" ><?=$item->account->brand_name?></a>



                            <br>Город: <?= $item->account->city->name?>


                            <br>Адресс: <?= $item->account->address?>


                            <br><br>
                            <?php if (!Yii::$app->user->isGuest):?>
                                <?php if (!$item->account->verify_status):?>
                                    <button class="deal_button" style="border: none; background-color: grey; text-align: left" data-toggle="popover">Предложить сделку</button>
                                <?php else:?>
                                    <a target="_blank" href="/admin/deal/create?good=<?=$item->id?>" class="deal_button" style="border: none;min-width: 143px; text-align: left" >Предложить сделку</a>
                                <?php endif;?>
                            <?php else:?>
                                <a href="javascript:void(0)" onclick="noAuth()" class="deal_button" >Предложить сделку</a>
                            <?php endif;?>


                        </div>

                    </div>

                </div>
            <?php endforeach;?>
        <?php else:;?>
            <h4 style="text-align: center;margin-top: 150px;">Ничего не найдено</h4>
        <?php endif;?>
        <a href="#" style="opacity: 0" class="u"><img src="/assets/front/Arrow-7c5de6bad594735cd512c95e9c2da9a1.png" style="width: 20%;min-width: 45px"></a>
    </div>

</div>
