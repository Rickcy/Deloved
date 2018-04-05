<?php
use yii\bootstrap\Nav;
/**
 * @var $this \yii\web\View
 */
$group ='companies';
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
                     <img style="width: 75%" src="/images/main/7cd568bf1a88f3d6cca37207d74301ec.gif" />
                 </a>
             </div>

    <div class="col-md-9 col-sm-9 col-xs-9 " >
<div class="row">

                 <div class="layer">
                     <a href="javascript:void(0)" data-target="#checkAgentModal" data-toggle="modal"	class="" style="width: 32%!important;" ><span class="glyphicon glyphicon-eye-open" style="margin-right: 3%;font-size: 14pt;" ></span>Проверка контрагента</a>

                     <a href="/companies/index" class=""><span class="glyphicon glyphicon-briefcase" style="margin-right: 3%;font-size: 14pt" > </span><?=Yii::t('app', 'Companies')?> </a>


                     <a href="/front/about"	class="about" ><span class="glyphicon glyphicon-comment" style="margin-right: 3%;font-size: 14pt" ></span> <?=Yii::t('app', 'About Us')?></a>
                     <a href="/front/tariffs"	class="about" ><span class="glyphicon glyphicon-comment" style="margin-right: 3%;font-size: 14pt" ></span> <?=Yii::t('app', 'Tariffs')?></a>

                 </div>


        <!-- поисковая форма -->

        <form action="/<?=Yii::$app->controller->id == 'front'?'companies':Yii::$app->controller->id?>/search"  method="POST">

            <div class="input-group col-md-11  col-sm-11 col-xs-11">
                <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
                <input required="" name="search" class="form-control" style="height: 45px;font-size: 15pt;box-shadow: inset 0 0 15px #e2e2e2" value="" placeholder="<?=Yii::t('app', 'Search')?>"/>
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit" style="height: 45px;margin-right: 5px;background-color:#94c43d"><span class="glyphicon glyphicon-search" style="padding: 10px;font-size: 15pt;color: white"></span> </button>
					</span>
            </div>
        </form>

        <!--конец формы-->
        <div class="search_block">

            <a href="/<?=Yii::$app->controller->id == 'front'?'companies':Yii::$app->controller->id?>/search" data-method="post" class="search_link"><?=Yii::t('app', 'Advanced search')?></a>

        </div>

    </div>
        </div>
</div>
</div>
<div id="checkAgentModal"  class="modal fade" >
    <div class="modal-dialog text-center">

        <div class="modal-content" style="width:180%;float: left;position: absolute;left: -40%">



            <h2 style="font-size: 3.5rem;letter-spacing: .1rem;color: #0086c4;font-family: 'Verdana', Verdana;
            font-weight: 600;">Получить подробную информацию о контрагенте</h2>
            <div class="col-sm-12" style="font-family: verdana,geneva,sans-serif;margin:10px;line-height: 200%;font-size: 1.2em;text-align: left!important;">
                Вы в один клик можете просмотреть <b>Финансовую отчетность</b> , <b>Судебную практику</b> и т.д , а также вам будет доступна информация по <b>Аффилированности контрагента</b> .
            </div>
            <div class="col-sm-12" style="border-radius:10px;margin:10px;line-height: 200%;">

                <div class="blk_video_data_wrap no_sel c_text">
                    <div class="video_container" style="width: 100%">

                        <div class="video" title="https://www.youtube.com/embed/1Lr8RoMxR58">
                            <iframe width="100%" height="415" data-default_params="autoplay=0&amp;rel=0&amp;controls=1&amp;showinfo=1&amp;iv_load_policy=3" src="https://www.youtube.com/embed/Fnb9mGIgiao" data-thumb_src="https://img.youtube.com/vi/Fnb9mGIgiao/hqdefault.jpg" data-link="https://www.youtube.com/embed/Fnb9mGIgiao" data-width="810" data-video_id="Fnb9mGIgiao" style="width: 90%; height: 556px; "></iframe>
                        </div>
                    </div>
                    <div class="video_empty"></div>
                </div>
            </div>

            <br>
            <div class="text-center" style="margin: 40px;">
                <?php if(Yii::$app->user->isGuest):?>
                    <div style="float: left;width: 100%;text-align: -webkit-center;margin-bottom: 20px">
                        <div style="width: 40%;margin: 20px 0;">
                            <a style="color: green;font-family: 'Verdana', Verdana;font-weight: 600;font-size: 1.5rem" href="javascript:void(0)" data-target="#Login" onclick="yaCounter42521619.reachGoal('provkont'); return true;"   data-dismiss="modal" data-toggle="modal" >Авторизоваться</a> | <a style="color: green;font-family: 'Verdana', Verdana;font-weight: 600;font-size: 1.5rem" href="javascript:void(0)" data-target="#SignUp" onclick="yaCounter42521619.reachGoal('provkont'); return true;"   data-dismiss="modal" data-toggle="modal" >Зарегистрироваться</a>
                        </div>
                        <div style="width: 40%;border: 2px dashed grey;border-radius: 30px;padding: 20px 30px;">Введите ИНН</div>
                    </div>
                    <button type="button" style="padding: 10px 15px;border-radius: 15px;background-color: grey"  class="btn btn-large btn-success disabled">Проверить контрагента</button>

                <?php else:;?>
                    <div style="float: left;width: 100%;text-align: -webkit-center;margin-bottom: 20px">
                        <div style="width: 40%;border: 2px dashed green;border-radius: 30px;padding: 20px 30px;"><a style="text-decoration: none" href="/admin/information/index" onclick="yaCounter42521619.reachGoal('provkont'); return true;" >Введите ИНН</a></div>
                    </div>
                    <a href="/admin/information/index" onclick="yaCounter42521619.reachGoal('provkont'); return true;" style="padding: 10px 15px;border-radius: 15px"  class="btn btn-large btn-success ">Проверить контрагента</a>
                <?php endif;?>
            </div>






        </div>
    </div>
</div>
