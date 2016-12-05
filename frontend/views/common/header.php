<?
use yii\bootstrap\Nav;
?>
<div class="navbar-wrapper">

    <div class="navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">


                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>


            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
                <?

                $guest = Yii::$app->user->isGuest;
                $menuItems = [];
                if($guest) {
                    $menuItems[]=['label' => '   В Кабинет', 'url' => ['/front/login']];
                    $menuItems[]= ['label' => '    Регистрация', 'url' => ['/front/about']];
                }else{
                    $menuItems[]=['label' => '<span style="margin-right: 3px" class="glyphicon glyphicon-user"  ></span>   В Кабинет', 'url' => ['/front/index']];
                    $menuItems[]= ['label' => '<span style="margin-right: 3px" class="glyphicon glyphicon-off"  >    Выйти', 'url' => ['/front/logout'], 'linkOptions' => ['data-method' => 'post']];

                }
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
                ?>

            </div>
            <!-- #Nav Ends -->

        </div>
    </div>

</div>




    <div class="navbar-brand visible-xs EadnD" style="padding: 0;margin: 0 0 0 2.4%;">
        <div class="navbar-brand E" ><img src="${resource(dir: 'images', file: 'front/Dol.png')}" style="width: 25px"/><span style="font-size: 10pt;font-weight: 600" class="D_money"></span></div>
        <div class="navbar-brand D" ><img src="${resource(dir: 'images', file: 'front/Ev.png')}" style="width: 25px"/><span style="font-size: 10pt;font-weight: 600" class="E_money"></span>
        </div>
    </div>
    <div class="collapse navbar-toggleable-xs" id="navbar" style="clear: both">

        <nav class="nav navbar-nav pull-xs-left">



        <a href="#"  class="nav-item nav-link"<span class="glyphicon glyphicon-briefcase" style="margin-right: 3%;font-size: 14pt" > </span>Партнеры</a>
        <a href="#"	class="nav-item nav-link" ><span class="glyphicon glyphicon-shopping-cart" style="margin-right: 3%;font-size: 14pt" ></span>Товары</a>
        <a href="#"	class="nav-item nav-link"><span class="glyphicon glyphicon-wrench" style="margin-right: 3%;font-size: 14pt" ></span>Услуги</a>
        <a href="#"	class=" nav-item nav-link" ><span class="glyphicon glyphicon-comment" style="margin-right: 3%;font-size: 14pt" ></span>О проекте</a>
        <a href="#" class="nav-item nav-link"><span class="glyphicon" style="margin-right: 5%;font-size: 18pt;padding-top: 0;margin-top: -6px;" >₽</span>Тарифы</a>

        </nav>


    </div>
</nav>




<div class="row menu_search" style="margin-bottom:0px;">
    <div class="col-md-3 col-sm-3 col-xs-9" style="padding-top: 15px;padding-left: 70px;padding-right: 20px"><g:link controller="front"><img class="imga" src="${resource(dir: 'images', file: 'front/logo.gif')}" style="width: 78%;max-width:250px;min-width: 150px;float: right;margin-right: 15px "/></g:link></div>

    <div class="col-md-9 col-sm-9 col-xs-9 " style="float: right;padding: 0">
        <div class="layer" style="margin-top: 0.6%">
                <a class=""><span class="glyphicon glyphicon-briefcase" style="margin-right: 3%;font-size: 14pt" > </span>ПАРТНЕРЫ </a>
                <a	class=""><span class="glyphicon glyphicon-shopping-cart" style="margin-right: 3%;font-size: 14pt" ></span> ТОВАРЫ</a>
                <a	class=""><span class="glyphicon glyphicon-wrench" style="margin-right: 3%;font-size: 14pt" ></span> УСЛУГИ</a>
                <a	class="about" ><span class="glyphicon glyphicon-comment" style="margin-right: 3%;font-size: 14pt" ></span> О ПРОЕКТЕ</a>
                <a	class="about" ><span class="glyphicon" style="margin-right: 3%;font-size: 18pt;padding-top: 0;margin-top: -6px;" >₽</span> ТАРИФЫ</a>
<!-- поисковая форма -->

        <form  method="POST">

            <div class="input-group col-md-11  col-sm-11 col-xs-11">
                <input required="" name="search" class="form-control" style="height: 45px;font-size: 15pt;box-shadow: inset 0 0 15px #e2e2e2" value="" placeholder="Поиск"/>
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit" style="height: 45px;margin-right: 5px;background-color:#94c43d"><span class="glyphicon glyphicon-search" style="padding: 10px;font-size: 15pt;color: white"></span> </button>
					</span>
            </div>
        </form>

        <!--конец формы-->
        <div class="search_block">

            <a  class="search_link">Расширенный поиск</a>

        </div>

    </div>

</div>
