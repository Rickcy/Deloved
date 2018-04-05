<?php
/**
 * @var $service \common\models\Services
 * @var $photoService \common\models\PhotoService
 */
use common\models\Account;
$this->title ='Купить '.$service->name.' | '.$service->account->city->name.' '.Account::getTrimName($service->account->full_name);
$this->registerMetaTag(['name' => 'description', 'content' => $service->description]);

?>
<div class="item-service">
    <div class="row" style="min-height: 500px">
        <div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">


            <!-- Начало строки товара -->
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="margin: 0;padding: 0">
                <h3 class="name" id="name" style="margin-left: -15px;text-align: center;border-bottom: 2px solid rgba(140, 192, 98, 0.3);">
                    <?=$service->name?>
                </h3>

                <!-- Начало столбца превью -->
                <div style="padding: 0; margin: 0" class="col-md-5 col-lg-5 col-sm-5" align="center">

                    <div style="padding: 10px; border-radius: 3px; height: 250px">
                        <div class="flex-image">

                            <?php if (count($service->photo) > 0):?>
                                <?php foreach ($service->photo as $photoService):?>
                                    <img class="img-responsive" style="width: 80%" src="<?=$photoService->filePath?>" alt="">
                                <?php endforeach;?>
                            <?php else:;?>
                                <img class="img-responsive" style="width: 80%" src="/uploads/default/goods.png" alt="">
                            <?php endif;?>

                        </div>
                    </div>
                    <div class="row">


                    </div>



                </div>
                <!-- Конец столбца превью -->

                <!-- Начало столбца с описанием товара -->
                <div class="col-md-7 col-lg-7 col-sm-7">

                    <div class="price" style="margin-top: 20px">
                        <?=$service->price?> <?=$service->currency->name?> - 1 <?=$service->measure->full_name?>
                        <br>

                    </div>



                    <br>

                    <hr>


                    <div class="description">




                        <!-- Использовал текстарию, чтобы элемент адекватно отображал базовые символы разметки и делал перенос слов -->
                        <div style="white-space: pre-wrap">
                            <?=$service->description?>
                        </div>

                    </div>


                </div>
                <!-- Конец столбца с описанием товара -->

            </div>
            <!-- Конец строки товара -->



            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="margin: 0;padding: 0">
                <h3 class="name" style="text-align: center;border-bottom: 2px solid rgba(140, 192, 98, 0.3);">Продавец</h3>

                <div style="padding: 0; margin: 0" class="col-md-4 col-lg-4 col-sm-1 col-xs-5">


                </div>

                <div class="col-md-7 col-lg-7 col-sm-10 col-xs-12">



                    <a class="postavshik" style="margin-top: 20px" href="/companies/item?id=<?=$service->account->id?>">

                        <?=Account::getTrimName($service->account->brand_name)?>
                    </a>
                    <div class="forma" style="text-align: left">
                        <?= $service->account->orgForm->name?>
                    </div>
                    <hr>

                    Город: <b><?=$service->account->city->name?> </b><br>
                    <hr>

                    Адрес:  <b><?=$service->account->address?></b><br>
                    <hr>


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
