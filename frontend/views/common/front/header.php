<?php
use yii\bootstrap\Nav;
?>

    <div class="navbar-wrapper">

    <nav class="navbar navbar-dark navbar-top bg-inverse menu-top" style="width: 102%;" role="navigation">
        <div class="container">
            <div class="navbar-header">


                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>


            <div class="navbar-collapse  collapse">
                <?php $guest = Yii::$app->user->isGuest;
                $menuItems = [];
                if($guest) {
                    $menuItems[]=['label' => Yii::t('app', 'Sign Up'), 'url' => 'javascript:void(0)', 'linkOptions' => ['data-target' => '#SignUp', 'data-toggle' => 'modal']];
                    $menuItems[]= ['label' => Yii::t('app', 'Login'), 'url' => 'javascript:void(0)', 'linkOptions' => ['data-target' => '#Login', 'data-toggle' => 'modal']];
                }else{
                    $menuItems[]=['label' => Yii::t('app', 'Cabinet'), 'url' => ['/admin/']];
                    $menuItems[]= ['label' => Yii::t('app', 'Logout'), 'url' => ['/front/logout'], 'linkOptions' => ['data-method' => 'post']];

                }
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right menu-item'],
                    'items' => $menuItems,
                ]);
                ?>

            </div>


        </div>
    </nav>

</div>

<div class="container">
    <div class="row" >


             <div class="col-md-3 col-sm-3 col-xs-9">
                 <a href="/">
                     <img class="img-responsive" src="/images/front/logo.gif" />
                 </a>
             </div>

    <div class="col-md-9 col-sm-9 col-xs-9 " >
<div class="row">

                 <div class=layer>
                     <a href="/companies/index" class=""><span class="glyphicon glyphicon-briefcase" style="margin-right: 3%;font-size: 14pt" > </span><?=Yii::t('app', 'Companies')?> </a>
                     <a href="/goods/index" class="" ><span class="glyphicon glyphicon-shopping-cart" style="margin-right: 3%;font-size: 14pt" ></span> <?=Yii::t('app', 'Goods')?></a>
                     <a href="/services/index"	class="" ><span class="glyphicon glyphicon-wrench" style="margin-right: 3%;font-size: 14pt" ></span> <?=Yii::t('app', 'Services')?></a>
                     <a href="/front/about"	class="about" ><span class="glyphicon glyphicon-comment" style="margin-right: 3%;font-size: 14pt" ></span> <?=Yii::t('app', 'About Us')?></a>
                     <a href="/front/tariffs"	class="about" ><span class="glyphicon glyphicon-comment" style="margin-right: 3%;font-size: 14pt" ></span> <?=Yii::t('app', 'Tariffs')?></a>

                 </div>


        <!-- поисковая форма -->

        <form  method="POST">

            <div class="input-group col-md-11  col-sm-11 col-xs-11">
                <input required="" name="search" class="form-control" style="height: 45px;font-size: 15pt;box-shadow: inset 0 0 15px #e2e2e2" value="" placeholder="<?=Yii::t('app', 'Search')?>"/>
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit" style="height: 45px;margin-right: 5px;background-color:#94c43d"><span class="glyphicon glyphicon-search" style="padding: 10px;font-size: 15pt;color: white"></span> </button>
					</span>
            </div>
        </form>

        <!--конец формы-->
        <div class="search_block">

            <a class="search_link"><?=Yii::t('app', 'Advanced search')?></a>

        </div>

    </div>
        </div>
</div>
</div>
