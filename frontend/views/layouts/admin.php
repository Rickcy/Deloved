<?php
/* @var $this \yii\web\View */
/* @var $content string */

use common\models\User;
use frontend\assets\AdminAsset;
use yii\helpers\Html;

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

        <ul class="admin_menu">

            <li><a class="home" href="#">Главная страница</a></li>

        </ul>

        <?if ($user->checkRole(['ROLE_ADMIN'])):?>

            <h1 class="ft">Справочники</h1>

            <div class="ug"></div>

            <ul class="admin_menu">

                <li><a href="#" >Категории</a></li>
                <li><a href="#" >Единицы измерения</a></li>
                <li><a href="#" >Контент-блоки</a></li>
                <li><a href="#" >Валюты</a></li>
                <li><a href="#" >ОПФ</a></li>
                <li><a href="#">Тарифы</a></li>


            </ul>


        <?endif;?>
        
        <?if ($user->checkRole(['ROLE_ADMIN','ROLE_SUPPORT'])):?>


            <h1 class="ft">Обратная связь</h1>
            <div class="ug"></div>

            <ul class="admin_menu">
                <li><a href="#">Связаться с нами </a></li>

            <?if ($user->checkRole(['ROLE_ADMIN'])):?>
                    <li><a href="#">Категории связи</a></li>
            <?endif;?>


                <li><a href="#" >Служба поддержки</a></li>
            </ul>
        <?endif;?>

        <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>





            <h1 class="ft">Пользователи</h1>

            <div class="ug"></div>

            <ul class="admin_menu">

                <li><a href="#" >Учетные записи</a></li>
                <li><a  href="#" >Профили</a></li>

            </ul>

        <?endif;?>


        <?if ($user->checkRole(['ROLE_ADMIN'])):?>

            <h1 class="ft">Биллинг</h1>

            <div class="ug"></div>

            <ul class="admin_menu">
                <li><a href="#">Счета на оплату</a></li>
            </ul>
        <?endif;?>

        <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])):?>



            <h1 class="ft">Бизнес</h1>

            <div class="ug"></div>

            <ul class="admin_menu">


                <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>

                    <li><a href="#" >Предприятия</a></li>

                <?endif;?>

                <?if ($user->checkRole(['ROLE_USER'])):?>
                    <li><a href="#">Мои данные</a></li>
                <?endif;?>

                <?if ($user->checkRole(['ROLE_ADMIN','ROLE_USER'])):?>
                <!-- Сделки -->

                    <li><a href="#" ">Сделки
                        <?if ($user->freeUser()):?>
                        <span class="badge badge_green badge_pro">pro</span>
                         <?endif;?>
                    </a></li>

                <?endif;?>

                <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])):?>


                    <!-- Отзывы -->
                    <li><a href="#" >Отзывы
                            <?if ($user->freeUser()):?>
                                <span class="badge badge_green badge_pro">pro</span>
                            <?endif;?>
                    </a></li>

                    <!-- Товары -->
                    <li><a href="#">Товары</a></li>

                    <!-- Услуги -->
                    <li><a href="#">Услуги</a></li>

                    <!-- Рекламные материалы -->
                    <li><a href="#">Рекламные материалы

                            <?if ($user->freeUser()):?>
                                <span class="badge badge_green badge_pro">pro</span>
                            <?endif;?>

                        </a></li>
                    <?endif;?>

            </ul>

        <?endif;?>

        <?if ($user->checkRole(['ROLE_ADMIN','ROLE_USER','ROLE_MEDIATOR','ROLE_JURIST','ROLE_JUDGE'])):?>


            <h1 class="ft">Юриспрудеция</h1>
            <div class="ug"></div>
            <ul class="admin_menu">

                <?if ($user->checkRole(['ROLE_ADMIN','ROLE_USER','ROLE_MEDIATOR'])):?>

                    <li><a  href="#" >Споры
                            <?if ($user->freeUser()):?>
                                <span class="badge badge_green badge_pro">pro</span>
                            <?endif;?>
                    </a></li>
                <?endif;?>

                <?if ($user->checkRole(['ROLE_ADMIN','ROLE_JUDGE','ROLE_USER'])):?>

                    <li><a href="#">Иски
                        <?if ($user->freeUser()):?>
                            <span class="badge badge_green badge_pro">pro</span>
                        <?endif;?>
                    </a></li>
                <?endif;?>

                <?if ($user->checkRole(['ROLE_ADMIN','ROLE_JURIST','ROLE_USER'])):?>

                    <li><a href="#" >Помощь юриста

                        <?if ($user->freeUser()):?>
                            <span class="badge badge_green badge_pro">pro</span>
                        <?endif;?>
                    </a></li>
                <?endif;?>

                <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])):?>


                    <li><a href="#">Формы документов</a>
                    </li>
                <?endif;?>


            </ul>
    <?endif;?>

        <?if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JUDGE','ROLE_MEDIATOR','ROLE_JURIST','ROLE_USER'])):?>


            <h1 class="ft">Служба поддержки</h1>
            <div class="ug"></div>
            <ul class="admin_menu">
                <li ><a href="#">Помощь специалиста
                </a></li>
            </ul>
        <?endif;?>

        <?if ($user->checkRole(['ROLE_ADMIN'])):?>
            <h1 class="ft">Администратор</h1>

            <div class="ug"></div>

            <ul class="admin_menu">
                <li><a href="#">Инструменты</a></li>

            </ul>
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
