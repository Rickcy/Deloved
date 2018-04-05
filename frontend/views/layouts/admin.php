<?php
/* @var $this \yii\web\View */
/* @var $content string */

use common\models\User;
use frontend\assets\AdminAsset;
use yii\helpers\Html;
use yii\widgets\Menu;

AdminAsset::register($this);
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

<?=$this->render("//common/admin/activation-warning")?>

<?=$this->render("//common/admin/header")?>

<?=$this->render("//common/flash-message")?>



<div class="row" style="margin: 0">
<div class=" col-lg-3 col-md-4" style="padding: 0 10px 0 0" id="asd">
    <div class="left-block"  >
        <?php
        echo Menu::widget([
            'items' => [
                ['label' => Yii::t('app', 'Home'), 'url' => ['/admin/default/index']],

            ],
            'options' => [ 'class'=>'admin_menu'],

            'activeCssClass'=>'active-item',
        ]);
        ?>


        <?php if ($user->checkRole(['ROLE_ADMIN'])):?>

            <h1 class="ft"><?=Yii::t('app', 'Information')?></h1>

            <div class="ug"></div>


                <?php
            echo Menu::widget([
                    'items' => [
                        ['label' => Yii::t('app', 'Categories'), 'url' => ['/admin/category/index']],
                        ['label' => Yii::t('app', 'Measure'), 'url' => ['/admin/measure/index']],
                        ['label' => Yii::t('app', 'Content-blocks'), 'url' => ['/admin/content/index']],
                        ['label' => Yii::t('app', 'Currency'), 'url' => ['/admin/currency/index']],
                        ['label' => Yii::t('app', 'Tariffs'), 'url' => ['/admin/tariffs/index']],
                        ['label' => Yii::t('app', 'Additional'), 'url' => ['/admin/additional/index']],
                        ['label' => Yii::t('app', 'Mail'), 'url' => ['/admin/mail/index']],

                    ],
                    'options' => [ 'class'=>'admin_menu'],

                    'activeCssClass'=>'active-item',
                ]);
                ?>

        <?php endif;?>

        <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_SUPPORT'])):?>

            <h1 class="ft"><?=Yii::t('app', 'Feedback')?></h1>
            <div class="ug"></div>

                <?php
            $menuItemsFeedback = [];
            $menuItemsFeedback[]=['label' => Yii::t('app', 'Contact us'),'options'=>['id'=>'suggestions'] , 'url' => ['/admin/suggestion/show']];
                if ($user->checkRole(['ROLE_ADMIN'])){

                    $menuItemsFeedback[]= ['label' => Yii::t('app', 'Category communication'), 'url' => ['/admin/suggestion/index']];
                }
            $menuItemsFeedback[]= ['label' => Yii::t('app', 'Support'),'options'=>['id'=>'support'],  'url' => ['/admin/ticket/show-all']];

                echo Menu::widget([
                    'items' =>$menuItemsFeedback ,
                    'options' => [ 'class'=>'admin_menu'],

                    'activeCssClass'=>'active-item',
                ]);
                ?>

        <?php endif;?>

        <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])):?>

            <h1 class="ft"><?=Yii::t('app', 'Users')?></h1>

            <div class="ug"></div>

            <?php
            echo Menu::widget([
                'items' => [
                    ['label' => Yii::t('app', 'Users list'), 'url' => ['/admin/user/index']],
                    ['label' => Yii::t('app', 'Profiles'), 'url' => ['/admin/profile/index']],

                ],
                'options' => [ 'class'=>'admin_menu'],

                'activeCssClass'=>'active-item',
            ]);
            ?>


        <?php endif;?>


        <?php if ($user->checkRole(['ROLE_ADMIN'])):?>

            <h1 class="ft"><?=Yii::t('app', 'Billing')?></h1>

            <div class="ug"></div>
            <?php
            echo Menu::widget([
                'items' => [
                    ['label' => Yii::t('app', 'Invoices for payment'),'options'=>['id'=>'payments'],  'url' => ['/admin/billing/all']]
                ],
                'options' => [ 'class'=>'admin_menu'],

                'activeCssClass'=>'active-item',
            ]);
            ?>

        <?php endif;?>





        <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])):?>



            <h1 class="ft"><?=Yii::t('app', 'Business')?></h1>

            <div class="ug"></div>



                <?php
            $menuItemsBusiness = [];

                if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER'])){

                    $menuItemsBusiness[]= ['label' => Yii::t('app', 'Accounts'),'options'=>['id'=>'account'] ,'url' => ['/admin/account/index']];
                }

                if ($user->checkRole(['ROLE_USER']) && !$user->profile->isManager()){

                    $menuItemsBusiness[]= ['label' => Yii::t('app', 'My Account'), 'url' => ['/admin/account/show']];
                }

                echo Menu::widget([
                    'items' =>$menuItemsBusiness ,
                    'options' => [ 'class'=>'admin_menu_business'],

                    'activeCssClass'=>'active-item',
                ]);
                ?>
                <?php
            $menuItemsBusiness2 = [];
                $link = null;
                if ($user->freeUser()){
                    $link.= '<a href="{url}">{label}<span class="badge badge_green badge_pro">pro</span></a>';
                }else{
                    $link.= '<a href="{url}">{label}</a>';
                }


                if ($user->checkRole(['ROLE_ADMIN','ROLE_USER']) ){

                    $menuItemsBusiness2[]= ['label' => Yii::t('app', 'Deals'),'options'=>['id'=>'deals'], 'url' => ['/admin/deal/index']];

                }

                if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER']) && !$user->profile->isManager()){

                    $menuItemsBusiness2[]= ['label' => Yii::t('app', 'Reviews'),'options'=>['id'=>'reviews'] ,'url' => ['/admin/review/index']];

                }

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

                if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])){

                    $menuItemsBusiness4[]= ['label' => Yii::t('app', 'Goods'),'options'=>['id'=>'goods'], 'url' => ['/admin/goods/index']];
                    $menuItemsBusiness4[]= ['label' => Yii::t('app', 'Services'),'options'=>['id'=>'services'], 'url' => ['/admin/services/index']];
                }



                echo Menu::widget([
                    'items' =>$menuItemsBusiness4 ,
                    'options' => [ 'class'=>'admin_menu_business'],

                    'activeCssClass'=>'active-item',
                ]);
                ?>


                <?php
            $menuItemsBusiness3 = [];
                $link2 = null;
                if ($user->freeUser()){
                    $link2= '<a href="{url}">{label}<span class="badge badge_green badge_pro">pro</span></a>';
                }else{
                    $link2= '<a href="{url}">{label}</a>';
                }


                if ($user->checkRole(['ROLE_ADMIN','ROLE_USER'])){

                    $menuItemsBusiness3[]= ['label' => Yii::t('app', 'Advertising material'),'options'=>['id'=>'advertising'], 'url' => ['/#']];

                }


                echo Menu::widget([
                    'items' =>$menuItemsBusiness3 ,
                    'options' => [ 'class'=>'admin_menu'],
                    'labelTemplate'	=>'{label} Label',
                    'linkTemplate' => $link2,
                    'activeCssClass'=>'active-item',
                ]);
                ?>




        <?php endif;?>



        <?php if(false):?>
        <?php if ($user->checkRole(['ROLE_USER'])):?>

            <h1 class="ft"><?=Yii::t('app', 'CRM System')?></h1>

            <div class="ug"></div>
            <?php
            $menuItemsCrm = [];
            if ($user->checkRole(['ROLE_USER']) && !$user->profile->isManager()){

                $menuItemsCrm[]= ['label' => Yii::t('app', 'Managers'),'options'=>['id'=>'crm'],  'url' => ['/admin/crm/managers']];

            }
            $menuItemsCrm[]=  ['label' => Yii::t('app', 'Tasks'),'options'=>['id'=>'tasks'],  'url' => ['/admin/crm/tasks']];
            echo Menu::widget([
                'items' =>$menuItemsCrm ,
                'options' => [ 'class'=>'admin_menu'],

                'activeCssClass'=>'active-item',
            ]);
            ?>

        <?php endif;?>
        <?php endif;?>



        <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_USER','ROLE_MEDIATOR','ROLE_JURIST','ROLE_JUDGE'])):?>


            <h1 class="ft"><?=Yii::t('app', 'Legal aid')?></h1>
            <div class="ug"></div>
            <ul class="admin_menu">
                <?php
                $menuItemsJurist3 = [];
                $link3 = null;
                if ($user->freeUser()){
                    $link3.= '<a href="{url}">{label}<span class="badge badge_green badge_pro">pro</span></a>';
                }else{
                    $link3.= '<a href="{url}">{label}</a>';
                }

                if ($user->checkRole(['ROLE_ADMIN','ROLE_JUDGE','ROLE_USER','ROLE_MEDIATOR','ROLE_JURIST'])){

                    $menuItemsJurist3[]= ['label' => Yii::t('app', 'Extended validation'),'options'=>['id'=>'extended-validation'], 'url' => ['/admin/information/index']];

                }

                if ($user->checkRole(['ROLE_ADMIN','ROLE_USER','ROLE_MEDIATOR'])){

                    $menuItemsJurist3[]= ['label' => Yii::t('app', 'Disputes'), 'options'=>['id'=>'disputes'],'url' => ['/admin/dispute/index']];

                }

                if ($user->checkRole(['ROLE_ADMIN','ROLE_JUDGE','ROLE_USER'])){

                    $menuItemsJurist3[]= ['label' => Yii::t('app', 'Claims'),'options'=>['id'=>'claims'], 'url' => ['/admin/claim/index']];

                }


                if ($user->checkRole(['ROLE_ADMIN','ROLE_JURIST','ROLE_USER'])){

                    $menuItemsJurist3[]= ['label' => Yii::t('app', 'Legal advice'),'options'=>['id'=>'advice'] ,'url' => ['/admin/consult/index']];

                }

                echo Menu::widget([
                    'items' =>$menuItemsJurist3 ,
                    'options' => [ 'class'=>'admin_menu_business'],
                    'labelTemplate'	=>'{label} Label',
                    'linkTemplate' => $link3,
                    'activeCssClass'=>'active-item',
                ]);
                ?>


                <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_USER'])):?>
                    <?php
                    echo Menu::widget([
                        'items' => [
                            ['label' => Yii::t('app', 'Forms of documents'), 'url' => ['/admin/document/index']]

                        ],
                        'options' => [ 'class'=>'admin_menu'],

                        'activeCssClass'=>'active-item',
                    ]);
                    ?>

                <?php endif;?>


            </ul>
    <?php endif?>

        <?php if ($user->checkRole(['ROLE_ADMIN','ROLE_MANAGER','ROLE_JUDGE','ROLE_MEDIATOR','ROLE_JURIST','ROLE_USER','ROLE_NONE'])):?>


            <h1 class="ft"><?=Yii::t('app', 'Support')?></h1>
            <div class="ug"></div>
            <?php
            echo Menu::widget([
                'items' => [
                    ['label' => Yii::t('app', 'Technical support'),'options'=>['id'=>'technical_support'], 'url' => ['/admin/ticket/index']]

                ],
                'options' => [ 'class'=>'admin_menu'],

                'activeCssClass'=>'active-item',
            ]);
            ?>
        <?php endif;?>




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
