<?php
/* @var $this \yii\web\View */
/* @var $content string */

use common\models\User;
use frontend\assets\DemoAdminAsset;
use yii\helpers\Html;
use yii\widgets\Menu;

DemoAdminAsset::register($this);
$user = User::findIdentity(Yii::$app->user->id);
$session = Yii::$app->session;
if ($session->has('lang')){
    $lang = $session->get('lang');
}else{
    $lang = Yii::$app->language;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language =$lang ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="button" href="/images/mCSB_buttons.png">
</head>
<body style="background-color: #e2e2e9">
<div style="width: 93%;margin:0 auto;padding-top: 15px">
    <?php $this->beginBody() ?>

    <?=$this->render("//common/flash-message")?>

    <div class="header col-md-12">
        <div class="col-xs-12 col-sm-3">
            <a href="/"><img class="hlogo" src="/images/front/logo2.png"/></a>
        </div>
        <div class="col-xs-12 col-sm-9">


            <a class="hmenu" style="font-family: Georgia, serif;margin-right: 10px" href="/demo-cabinet/information">Проверить контрагента</a>

            <a class="hmenu" style="font-family: Georgia, serif;margin-right: 10px" href="/companies/index"><?=Yii::t('app', 'Companies')?></a>

            <a class="hmenu" style="font-family: Georgia, serif;margin-right: 10px" href="/goods/index"><?=Yii::t('app', 'Goods')?></a>

            <a class="hmenu" style="font-family: Georgia, serif;" href="/services/index"><?=Yii::t('app', 'Services')?></a>








            <div class="hperson">

                <img id="hperson-avatar" src="/images/admin/avatar.jpg"/>

                    <span id="hperson-name">Каприн Василий Иванович</span>

                <div id="info">

                    <a href="/demo-cabinet/profile" class="info-menu" ><?=Yii::t('app', 'My Profile')?></a>


                        <a href="/demo-cabinet/billing" class="info-menu"><?=Yii::t('app', 'Personal Invoice')?></a>

                    <a href="/"  class="info-menu"><?=Yii::t('app', 'Logout')?></a>


                </div>

            </div>

            <script>
                $('#hperson-avatar,#hperson-name').click(function() {
                    var info = $("#info")
                    if (info.is(':visible')) {
                        info.hide()
                        return false
                    }
                    info.show()
                    return false
                })
            </script>





        </div>

    </div>





    <div class="row" style="margin: 0">
        <div class=" col-lg-3 col-md-4" style="padding: 0 10px 0 0" id="asd">
            <div class="left-block"  >
                <?php
                echo Menu::widget([
                    'items' => [
                        ['label' => Yii::t('app', 'Home'), 'url' => ['/demo-cabinet/index']],

                    ],
                    'options' => [ 'class'=>'admin_menu'],

                    'activeCssClass'=>'active-item',
                ]);
                ?>








                    <h1 class="ft"><?=Yii::t('app', 'Business')?></h1>

                    <div class="ug"></div>



                    <?php
                    $menuItemsBusiness = [];




                        $menuItemsBusiness[]= ['label' => Yii::t('app', 'My Account'), 'url' => ['/demo-cabinet/account']];


                    echo Menu::widget([
                        'items' =>$menuItemsBusiness ,
                        'options' => [ 'class'=>'admin_menu_business'],

                        'activeCssClass'=>'active-item',
                    ]);
                    ?>
                    <?php
                    $menuItemsBusiness2 = [];
                    $link = null;

                        $link.= '<a href="{url}">{label}</a>';





                        $menuItemsBusiness2[]= ['label' => Yii::t('app', 'Deals'),'options'=>['id'=>'deals'], 'url' => ['/demo-cabinet/deal']];





                        $menuItemsBusiness2[]= ['label' => Yii::t('app', 'Reviews'),'options'=>['id'=>'reviews'] ,'url' => ['/demo-cabinet/review']];



                    echo Menu::widget([
                        'items' =>$menuItemsBusiness2 ,
                        'options' => [ 'class'=>'admin_menu_business'],
                        'labelTemplate'	=>'{label} Label',
                        'linkTemplate' => $link,
                        'activeCssClass'=>'active-item',
                    ]);
                    ?>

                    <?php
                    $menuItemsBusiness4 = [];



                        $menuItemsBusiness4[]= ['label' => Yii::t('app', 'Goods'),'options'=>['id'=>'goods'], 'url' => ['/demo-cabinet/goods']];
                        $menuItemsBusiness4[]= ['label' => Yii::t('app', 'Services'),'options'=>['id'=>'services'], 'url' => ['/demo-cabinet/services']];




                    echo Menu::widget([
                        'items' =>$menuItemsBusiness4 ,
                        'options' => [ 'class'=>'admin_menu_business'],

                        'activeCssClass'=>'active-item',
                    ]);
                    ?>


                    <?php
                    $menuItemsBusiness3 = [];
                    $link2 = null;

                        $link2= '<a href="{url}">{label}</a>';






                    echo Menu::widget([
                        'items' =>$menuItemsBusiness3 ,
                        'options' => [ 'class'=>'admin_menu'],
                        'labelTemplate'	=>'{label} Label',
                        'linkTemplate' => $link2,
                        'activeCssClass'=>'active-item',
                    ]);
                    ?>









                    <h1 class="ft"><?=Yii::t('app', 'Legal aid')?></h1>
                    <div class="ug"></div>
                    <ul class="admin_menu">
                        <?php
                        $menuItemsJurist3 = [];
                        $link3 = null;

                            $link3.= '<a href="{url}">{label}</a>';




                            $menuItemsJurist3[]= ['label' => Yii::t('app', 'Extended validation'),'options'=>['id'=>'extended-validation'], 'url' => ['/demo-cabinet/information']];





                            $menuItemsJurist3[]= ['label' => Yii::t('app', 'Disputes'), 'options'=>['id'=>'disputes'],'url' => ['/demo-cabinet/dispute']];





                            $menuItemsJurist3[]= ['label' => Yii::t('app', 'Claims'),'options'=>['id'=>'claims'], 'url' => ['/demo-cabinet/claim']];






                            $menuItemsJurist3[]= ['label' => Yii::t('app', 'Legal advice'),'options'=>['id'=>'advice'] ,'url' => ['/demo-cabinet/consult']];



                        echo Menu::widget([
                            'items' =>$menuItemsJurist3 ,
                            'options' => [ 'class'=>'admin_menu_business'],
                            'labelTemplate'	=>'{label} Label',
                            'linkTemplate' => $link3,
                            'activeCssClass'=>'active-item',
                        ]);
                        ?>



                            <?php
                            echo Menu::widget([
                                'items' => [
                                    ['label' => Yii::t('app', 'Forms of documents'), 'url' => ['/demo-cabinet/document']]

                                ],
                                'options' => [ 'class'=>'admin_menu'],

                                'activeCssClass'=>'active-item',
                            ]);
                            ?>




                    </ul>





                    <h1 class="ft"><?=Yii::t('app', 'Support')?></h1>
                    <div class="ug"></div>
                    <?php
                    echo Menu::widget([
                        'items' => [
                            ['label' => Yii::t('app', 'Technical support'),'options'=>['id'=>'technical_support'], 'url' => ['/demo-cabinet/ticket']]

                        ],
                        'options' => [ 'class'=>'admin_menu'],

                        'activeCssClass'=>'active-item',
                    ]);
                    ?>





            </div>

            <div class="shadow"></div>
        </div>
        <div class=" col-lg-9 col-md-8" >
            <div class="block">

                <?= $content ?>
            </div>

            <div class="shadow"></div>
        </div>



    </div>
</div>
<?=$this->render("//common/front/footer") ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
