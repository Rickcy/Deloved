<?php
/* @var $this \yii\web\View */
/* @var $content string */

use common\models\User;
use frontend\assets\AdminAsset;
use yii\helpers\Html;
use yii\widgets\Menu;

AdminAsset::register($this);
$user = User::findIdentity(Yii::$app->user->id);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="background-color: #e2e2e9">
<div style="width: 93%;margin:0 auto;padding-top: 15px">
<?php $this->beginBody() ?>

<?=$this->render("//common/admin/activation-warning")?>

<?=$this->render("//common/admin/header")?>

<?=$this->render("//common/flash-message")?>



<div class="row" style="margin: 0">
<div class=" col-lg-3 col-md-4" style="padding: 0 10px 0 0" id="asd">
    <div class="left-block"  >
        <?
        echo Menu::widget([
            'items' => [
                ['label' => 'Главная страница', 'url' => ['/admin/default/index']],

            ],
            'options' => [ 'class'=>'admin_menu'],

            'activeCssClass'=>'active-item',
        ]);
        ?>


        <?if ($user->checkRole(['ROLE_ADMIN'])):?>

            <h1 class="ft">Справочники</h1>

            <div class="ug"></div>


                <?
                echo Menu::widget([
                    'items' => [
                        ['label' => 'Категории', 'url' => ['/admin/category/index']],
                        ['label' => 'Единицы измерения', 'url' => ['/admin/measure/index']],
                        ['label' => 'Контент-блоки', 'url' => ['/#']],
                        ['label' => 'Валюты', 'url' => ['/admin/currency/index']],
                        ['label' => 'Тарифы', 'url' => ['/admin/tariffs/index']],

                    ],
                    'options' => [ 'class'=>'admin_menu'],

                    'activeCssClass'=>'active-item',
                ]);
                ?>



        <?endif;?>
        
        <?if ($user->checkRole(['ROLE_ADMIN','ROLE_SUPPORT'])):?>


            <h1 class="ft">Обратная связь</h1>
            <div class="ug"></div>

                <?
                $menuItemsFeedback = [];
            $menuItemsFeedback[]=['label' => 'Связаться с нами ', 'url' => ['/#']];
                if ($user->checkRole(['ROLE_ADMIN'])){

                    $menuItemsFeedback[]= ['label' => 'Категории связи', 'url' => ['/#']];
                }
            $menuItemsFeedback[]= ['label' => 'Служба поддержки', 'url' => ['/#']];

                echo Menu::widget([
                    'items' =>$menuItemsFeedback ,
                    'options' => [ 'class'=>'admin_menu'],

                    'activeCssClass'=>'active-item',
                ]);
                ?>


        <?endif;?>

        <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>





            <h1 class="ft">Пользователи</h1>

            <div class="ug"></div>

            <?
            echo Menu::widget([
                'items' => [
                    ['label' => 'Учетные записи', 'url' => ['/admin/user/index']],
                    ['label' => 'Профили', 'url' => ['/admin/profile/index']],

                ],
                'options' => [ 'class'=>'admin_menu'],

                'activeCssClass'=>'active-item',
            ]);
            ?>


        <?endif;?>


        <?if ($user->checkRole(['ROLE_ADMIN'])):?>

            <h1 class="ft">Биллинг</h1>

            <div class="ug"></div>
            <?
            echo Menu::widget([
                'items' => [
                    ['label' => 'Счета на оплату', 'url' => ['/#']]

                ],
                'options' => [ 'class'=>'admin_menu'],

                'activeCssClass'=>'active-item',
            ]);
            ?>

        <?endif;?>

        <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])):?>



            <h1 class="ft">Бизнес</h1>

            <div class="ug"></div>



                <?
                $menuItemsBusiness = [];

                if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])){

                    $menuItemsBusiness[]= ['label' => 'Предприятия', 'url' => ['/admin/account/index']];
                }

                if ($user->checkRole(['ROLE_USER'])){

                    $menuItemsBusiness[]= ['label' => 'Мои данные', 'url' => ['/admin/account/show']];
                }

                echo Menu::widget([
                    'items' =>$menuItemsBusiness ,
                    'options' => [ 'class'=>'admin_menu_business'],

                    'activeCssClass'=>'active-item',
                ]);
                ?>
                <?
                $menuItemsBusiness2 = [];
                $link = null;
                if ($user->freeUser()){
                    $link.= '<a href="{url}">{label}<span class="badge badge_green badge_pro">pro</span></a>';
                }else{
                    $link.= '<a href="{url}">{label}</a>';
                }


                if ($user->checkRole(['ROLE_ADMIN','ROLE_USER'])){

                    $menuItemsBusiness2[]= ['label' => 'Сделки', 'url' => ['/#']];

                }

                if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])){

                    $menuItemsBusiness2[]= ['label' => 'Отзывы', 'url' => ['/#']];

                }

                echo Menu::widget([
                    'items' =>$menuItemsBusiness2 ,
                    'options' => [ 'class'=>'admin_menu_business'],
                    'labelTemplate'	=>'{label} Label',
                    'linkTemplate' => $link,
                    'activeCssClass'=>'active-item',
                ]);
                ?>

                <?
                $menuItemsBusiness4 = [];

                if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])){

                    $menuItemsBusiness4[]= ['label' => 'Товары', 'url' => ['/#']];
                    $menuItemsBusiness4[]= ['label' => 'Услуги', 'url' => ['/#']];
                }



                echo Menu::widget([
                    'items' =>$menuItemsBusiness4 ,
                    'options' => [ 'class'=>'admin_menu_business'],

                    'activeCssClass'=>'active-item',
                ]);
                ?>


                <?
                $menuItemsBusiness3 = [];
                $link2 = null;
                if ($user->freeUser()){
                    $link2.= '<a href="{url}">{label}<span class="badge badge_green badge_pro">pro</span></a>';
                }else{
                    $link2.= '<a href="{url}">{label}</a>';
                }


                if ($user->checkRole(['ROLE_ADMIN','ROLE_USER'])){

                    $menuItemsBusiness3[]= ['label' => 'Рекламные материалы', 'url' => ['/#']];

                }


                echo Menu::widget([
                    'items' =>$menuItemsBusiness3 ,
                    'options' => [ 'class'=>'admin_menu'],
                    'labelTemplate'	=>'{label} Label',
                    'linkTemplate' => $link2,
                    'activeCssClass'=>'active-item',
                ]);
                ?>




        <?endif;?>

        <?if ($user->checkRole(['ROLE_ADMIN','ROLE_USER','ROLE_MEDIATOR','ROLE_JURIST','ROLE_JUDGE'])):?>


            <h1 class="ft">Юриспрудеция</h1>
            <div class="ug"></div>
            <ul class="admin_menu">
                <?
                $menuItemsJurist3 = [];
                $link3 = null;
                if ($user->freeUser()){
                    $link3.= '<a href="{url}">{label}<span class="badge badge_green badge_pro">pro</span></a>';
                }else{
                    $link3.= '<a href="{url}">{label}</a>';
                }


                if ($user->checkRole(['ROLE_ADMIN','ROLE_USER','ROLE_MEDIATOR'])){

                    $menuItemsJurist3[]= ['label' => 'Споры', 'url' => ['/#']];

                }

                if ($user->checkRole(['ROLE_ADMIN','ROLE_JUDGE','ROLE_USER'])){

                    $menuItemsJurist3[]= ['label' => 'Иски', 'url' => ['/#']];

                }


                if ($user->checkRole(['ROLE_ADMIN','ROLE_JURIST','ROLE_USER'])){

                    $menuItemsJurist3[]= ['label' => 'Помощь юриста', 'url' => ['/#']];

                }

                echo Menu::widget([
                    'items' =>$menuItemsJurist3 ,
                    'options' => [ 'class'=>'admin_menu_business'],
                    'labelTemplate'	=>'{label} Label',
                    'linkTemplate' => $link3,
                    'activeCssClass'=>'active-item',
                ]);
                ?>


                <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])):?>
                    <?
                    echo Menu::widget([
                        'items' => [
                            ['label' => 'Формы документов', 'url' => ['/#']]

                        ],
                        'options' => [ 'class'=>'admin_menu'],

                        'activeCssClass'=>'active-item',
                    ]);
                    ?>

                <?endif;?>


            </ul>
    <?endif;?>

        <?if ($user->checkRole(['ROLE_MANAGER','ROLE_JUDGE','ROLE_MEDIATOR','ROLE_JURIST','ROLE_USER'])):?>


            <h1 class="ft">Служба поддержки</h1>
            <div class="ug"></div>
            <?
            echo Menu::widget([
                'items' => [
                    ['label' => 'Помощь специалиста', 'url' => ['/#']]

                ],
                'options' => [ 'class'=>'admin_menu'],

                'activeCssClass'=>'active-item',
            ]);
            ?>
        <?endif;?>




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
