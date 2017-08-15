<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 13.08.17
 * Time: 21:22
 */
use frontend\widgets\Contact;
use frontend\widgets\PasswordReset;
use frontend\widgets\SignUp;
use frontend\widgets\Suggestion;
use frontend\widgets\Login;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Business-portal Deloved');
?>
<div id="site_wrapper1">
    <div id="sections_list"><div class="blk_section bg_type_image sprint4 " data-par-speed="" id="9b98b54f55374ddd90eb2516d7a29ef0" data-id="s-9b98b54f55374ddd90eb2516d7a29ef0" bg_type="image" pos="2" style="padding-bottom: 15px;padding-top: 20px;">

            <div id="section_image_9b98b54f55374ddd90eb2516d7a29ef0" class="section-image " style="background-position: 50% 50%;background-repeat: no-repeat;"></div>

            <div class="mha clearfix blk_section_inner" style="width:1170px; background-position: 0% 0%;background-repeat: no-repeat;">

                <div class="tpl_cell tpl_section_cell sortable_cell l_float  " id="6d2ff3cb85b24080acc4db0718385983" style="width: 100%;">
                    <div class="blk_container v3 cnt-cells-3 orange_cell_resize " id="a4f6701f0edd4136a3ac314e102ce81a" type_id="" pos="2">


                        <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                            <div class="blk_container_cells cells-3">
                                <div class="td_container_cell" cell_id="1960fe011ebb48c4a7febfdef0e37588" style="width:17.069%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell first_cell" id="1960fe011ebb48c4a7febfdef0e37588" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_image_ext " id="f13541ebb42d44de9f42a69282aae683" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-f13541ebb42d44de9f42a69282aae683" style="opacity: 1;">

                                            <div class="blk-data ie_css3 clearfix">
                                                <div class="blk_image_data_wrap no_sel r_text">
                                                    <div class="img_container">
                                                        <a  href="/"><img style="width: 186px; border-radius: 0px" src="/images/main/7cd568bf1a88f3d6cca37207d74301ec.gif" ></a>


                                                    </div>

                                                </div></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="11a9dc2c476b48e393113f10cf566365" style="width:60.142%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="11a9dc2c476b48e393113f10cf566365" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="2ae4bbb137774ef680028bbcc6ec17f5" blk_class="blk_text" type_id="1" pos="2" data-id="b-2ae4bbb137774ef680028bbcc6ec17f5" style="opacity: 1;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:1px 0px 0px 0px;"><div style="text-align: center;"><strong><span style="font-size:50px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="color:#336699;"><span style="line-height:1;"><span style="font-style: normal; font-weight: 300;">БЕЗОПАСНАЯ СДЕЛКА</span></span></span></span></span></strong></div></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="3f31041f443e466e8f09dc286d229883" style="width:22.788%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="3f31041f443e466e8f09dc286d229883" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_box " id="56ab985446b04c498936acd8a91eb5bd" blk_class="blk_box" type_id="28" pos="1" data-id="b-56ab985446b04c498936acd8a91eb5bd" style="opacity: 1;">

                                            <div class="blk-data ie_css3 clearfix"><div class="blk_box_self clearfix" bg="#ffffff" data-is_border_allow="0" style="padding:8px 20px;border-radius:5px;background:#ffffff;">
                                                    <div class="cell tpl_cell tpl_box_cell sortable_cell l_float  " id="4fd8cc633455454bae3424d5e538d7d0" style="width: 100%;">
                                                        <div class="blk    blk_button " id="0542c9465b82469c9343c1acc8ca95e7" blk_class="blk_button" type_id="5" pos="1" data-id="b-0542c9465b82469c9343c1acc8ca95e7" style="opacity: 1;">

                                                            <div class="blk-data ie_css3 clearfix"><div class="blk_button_data_wrap c_text ">
                                                                    <?php if(!Yii::$app->user->isGuest):?>
                                                                        <a href="<?=Url::to(['/admin']) ?>" class="btn-new ie_css3" ><span style="margin-right: 3px" class="glyphicon glyphicon-user"  ></span>В Кабинет<span class="badge badge_red newIt" ></span></a>

                                                                        <a class="btn-new ie_css3" href="<?=Url::to(['/front/logout']) ?>" data-method="post">Выйти</a>
                                                                    <?php endif?>
                                                                    <?php if(Yii::$app->user->isGuest):?>
                                                                        <a href="#" class="btn-new ie_css3" data-target="#Login" data-toggle="modal"><span style="margin-right: 3px" class="glyphicon glyphicon-user"  ></span>Личный Кабинет</a>

                                                                    <?php endif?>


                                                                </div></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="mask blk-box__mask"></div></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>





        </div>
        <div class="blk_section bg_type_image sprint4  is_cover" data-par-speed="" id="0adef228066a481dba72d15dd38f92f8" data-id="s-0adef228066a481dba72d15dd38f92f8" bg_type="image" pos="4" style="padding-bottom: 86px;padding-top: 40px;">

            <div id="section_image_0adef228066a481dba72d15dd38f92f8" class="section-image " style="background-image: url(&#39;https://s.lpmtr.ru/files/9/c/9/9c936d404e11982c3fe9cc9676b6e986.jpg&#39;);background-position: 50% 0%;background-repeat: no-repeat;"></div>
            <div class="section-blackout" style="-ms-filter:&#39;progid:DXImageTransform.Microsoft.Alpha(Opacity=1.00)&#39;; filter:alpha(opacity=1.00); -moz-opacity:1.00; -khtml-opacity:1.00; opacity:1.00;background: #FCFCFC;filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=&#39;#FCFCFC&#39;, endColorstr=&#39;#FFFFFF&#39;);background: -o-linear-gradient(180deg, #FCFCFC, rgba(0,0,0,0));background: -ms-linear-gradient(180deg, #FCFCFC, rgba(0,0,0,0));background: -moz-linear-gradient(180deg, #FCFCFC, rgba(0,0,0,0));background: -webkit-linear-gradient(180deg, #FCFCFC, rgba(0,0,0,0));background: linear-gradient(180deg, #FCFCFC, rgba(0,0,0,0));"></div>

            <div class="mha clearfix blk_section_inner" style="width:1170px; background-position: 0% 0%;background-repeat: no-repeat;">

                <div class="tpl_cell tpl_section_cell sortable_cell l_float  " id="05056ca347d14f3a869cdbbafd146820" style="width: 100%;">
                    <div class="blk_container v3 cnt-cells-2 orange_cell_resize " id="2ee2afed18df4b5dbf3c2ad4a19bcee9" type_id="" pos="1">


                        <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                            <div class="blk_container_cells cells-2">
                                <div class="td_container_cell" cell_id="4629359527314319b5482e84bfffac24" style="width:89.589%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell first_cell" id="4629359527314319b5482e84bfffac24" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="d83c65cd977144c28757ef4eed5ff628" blk_class="blk_text" type_id="1" pos="1" data-id="b-d83c65cd977144c28757ef4eed5ff628" style="opacity: 1;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:40px 0px 0px 0px;"><p style="text-align: right;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="color:#000033;"><font face="roboto"><span style="font-size:16px;">Вас интересует</span><br><span style="font-size:22px;">возможность быстрого</span><span style="font-size: 42px;"><span style="font-size:22px;">,</span></span><br><span style="font-size:36px;">грамотного, а главное</span><br><span style="font-size:56px;">БЕЗОПАСНОГО ЗАКЛЮЧЕНИЯ СДЕЛКИ?</span></font></span></span></p></div>
                                        </div>
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="34b3c64c928f41928acaae41032f85f1" blk_class="blk_text" type_id="1" pos="2" data-id="b-34b3c64c928f41928acaae41032f85f1">

                                            <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 10px 0px;"><p style="text-align: right;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><font color="#252830" face="roboto"><span style="font-size: 20px;">Получите исчерпывающую информацию о Вашем будущем деловом партнере!</span></font></span></p></div>
                                        </div>
                                        <div class="blk    blk_form  blk-no-bg blk-no-border" id="74db5d09fab04093b77e3766750a23b7" blk_class="blk_form" type_id="6" pos="3" data-id="b-74db5d09fab04093b77e3766750a23b7">

                                            <div class="blk-data ie_css3 clearfix"><div class="blk_form_wrap r_text is_popover ">
                                                    <a href="#" class="btn-new ie_css3 btn-form-popover" data-target="#SignUp" data-toggle="modal">ЗАРЕГИСТРИРОВАТЬСЯ</a>


                                                </div></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="5eeac45e4d6b4d77bd7bc3b696468a56" style="width:10.411%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="5eeac45e4d6b4d77bd7bc3b696468a56" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="f335cfc93db849668313d08eabe84930" blk_class="blk_text" type_id="1" pos="1" data-id="b-f335cfc93db849668313d08eabe84930" style="opacity: 1;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:0px;"><p><br><br><br><br><br><br>&nbsp;</p></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>





        </div>
        <div class="blk_section bg_type_image sprint4  is_parallax is_cover" data-par-speed="100" id="10754c91051a4f569608f778a3b829e2" data-id="s-10754c91051a4f569608f778a3b829e2" bg_type="image" pos="6" style="padding-bottom: 59px;padding-top: 59px;">

            <div id="section_image_10754c91051a4f569608f778a3b829e2" class="section-image is_p" style="background-position: 50% 0%;background-repeat: no-repeat;"></div>

            <div class="mha clearfix blk_section_inner" style="width:1170px; background-position: 50% 0%;background-repeat: no-repeat;">

                <div class="tpl_cell tpl_section_cell sortable_cell l_float  " id="82528a0db2f043449a5a3990a76f695f" style="width: 100%;">
                    <div class="blk    blk_video " id="4be7f5085ae04ea7b2d4abd4bb948110" blk_class="blk_video" type_id="14" pos="1" data-id="b-4be7f5085ae04ea7b2d4abd4bb948110">

                        <div class="blk-data ie_css3 clearfix">            <div class="blk_video_data_wrap no_sel c_text">
                                <div class="video_container">

                                    <div class="video" title="https://www.youtube.com/embed/1Lr8RoMxR58">
                                        <iframe width="560" height="315" data-default_params="autoplay=0&amp;rel=0&amp;controls=1&amp;showinfo=1&amp;iv_load_policy=3" src="https://www.youtube.com/embed/GXUyATGt4c8" data-thumb_src="https://img.youtube.com/vi/GXUyATGt4c8/sddefault.jpg"  data-link="https://www.youtube.com/embed/GXUyATGt4c8"  data-width="810" data-video_id="GXUyATGt4c8" style="width: 810px; height: 456px; " ></iframe>
                                    </div>
                                </div>
                                <div class="video_empty"></div>
                            </div></div>
                    </div>

                </div>
            </div>





        </div>
        <div class="blk_section bg_type_image sprint4  is_parallax is_cover" data-par-speed="100" id="a98207b5d0dc4c5abf3f0ea97bab01bd" data-id="s-a98207b5d0dc4c5abf3f0ea97bab01bd" bg_type="image" pos="7" style="padding-bottom: 42px;padding-top: 59px;">

            <div id="section_image_a98207b5d0dc4c5abf3f0ea97bab01bd" class="section-image is_p" style="background-image: url(&#39;https://s.lpmtr.ru/files/f/e/f/fefe6005534946265e3a5906dac86b13.jpg&#39;);background-position: 50% 50%;background-repeat: no-repeat;"></div>
            <div class="section-blackout" style="-ms-filter:&#39;progid:DXImageTransform.Microsoft.Alpha(Opacity=0.83)&#39;; filter:alpha(opacity=0.83); -moz-opacity:0.83; -khtml-opacity:0.83; opacity:0.83;background-color: #8A8A8A;"></div>

            <div class="mha clearfix blk_section_inner" style="width:1170px; background-position: 50% 0%;background-repeat: no-repeat;">

                <div class="tpl_cell tpl_section_cell sortable_cell l_float  " id="d8affb291a1c49eb98d127d197d58993" style="width: 100%;">
                    <div class="blk    blk_text blk-no-bg-lpm-449" id="d7e83beeeac84562aa0d9d2aaedd8250" blk_class="blk_text" type_id="1" pos="1" data-id="b-d7e83beeeac84562aa0d9d2aaedd8250" style="opacity: 0;">

                        <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 43px 0px;"><p style="text-align: center;"><span style="font-size:56px;"><span style="color:#FFFFFF;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;">КАК ЭТО РАБОТАЕТ</span></span></span></p></div>
                    </div>
                    <div class="blk_container v3 cnt-cells-6 orange_cell_resize " id="ff387bd1729a45f0b3ef67c8cb0b2f13" type_id="" pos="3">


                        <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                            <div class="blk_container_cells cells-6">
                                <div class="td_container_cell" cell_id="201c689dd3d04b5d862c8bcde4ce9c39" style="width:15.327%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell first_cell" id="201c689dd3d04b5d862c8bcde4ce9c39" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_image_ext " id="2e97374355ea463c8beb263c000ac609" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-2e97374355ea463c8beb263c000ac609" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix">
                                                <div class="blk_image_data_wrap no_sel c_text">
                                                    <div class="img_container">
                                                        <img style="width: 133px; border-radius: 0px" src="/images/main/file.png" >


                                                    </div>

                                                </div></div>
                                        </div>
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="fbda7e1e9760499086526e35b75d2835" blk_class="blk_text" type_id="1" pos="2" data-id="b-fbda7e1e9760499086526e35b75d2835" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 14px 0px;"><div style="text-align: center;"><br><br><span style="font-size:16px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="color:#FFFFFF;">Проверка</span><br><span style="color:#00FF00;">надежности</span><br><span style="color:#FFFFFF;">контрагнета</span></span></span></div></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="b934ec95aa7448ac9bb04c279a86e760" style="width:10.000%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="b934ec95aa7448ac9bb04c279a86e760" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="fae6add9457141fab435b65c65b3be22" blk_class="blk_text" type_id="1" pos="1" data-id="b-fae6add9457141fab435b65c65b3be22" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 34px 0px;"></div>
                                        </div>
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="a3dd907481594f7992011ed4b96ea5bc" blk_class="blk_text" type_id="1" pos="3" data-id="b-a3dd907481594f7992011ed4b96ea5bc" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:13px 0px 0px 0px;"><p style="text-align: center;"><span style="font-size:90px;"><span style="color:#FFFFFF;">+</span></span></p></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="312ebc38b0ec43f29d12f98e660a6016" style="width:23.602%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="312ebc38b0ec43f29d12f98e660a6016" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_image_ext " id="696f7aad83d440248653b5e50ceec200" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-696f7aad83d440248653b5e50ceec200" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix">
                                                <div class="blk_image_data_wrap no_sel c_text">
                                                    <div class="img_container">
                                                        <img style="width: 135px; border-radius: 0px" src="/images/main/file(1).png">


                                                    </div>

                                                </div></div>
                                        </div>
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="862e05b5712d4902a009954c975dd489" blk_class="blk_text" type_id="1" pos="2" data-id="b-862e05b5712d4902a009954c975dd489" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:13px 0px 4px 0px;"><div style="text-align: center;"><br><span style="font-size:16px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="color:#FFFFFF;">Предложение контрагенту</span><br><span style="color:#00FF00;">заключить сделку</span><br><span style="color:#FFFFFF;">на бизнес-прощадке портала</span></span></span></div></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="f93d700a2f364ff397ef9a04e98bad2c" style="width:10.000%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="f93d700a2f364ff397ef9a04e98bad2c" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="540c7f99288743319ab48eb635f47930" blk_class="blk_text" type_id="1" pos="1" data-id="b-540c7f99288743319ab48eb635f47930" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 34px 0px;"><p><br></p></div>
                                        </div>
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="45f84059f262488ea32ab9a9cdade53d" blk_class="blk_text" type_id="1" pos="2" data-id="b-45f84059f262488ea32ab9a9cdade53d" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:0px;"><p style="text-align: center;"><span style="font-size:90px;"><span style="color:#FFFFFF;">+</span></span></p></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="95c8d9f01c6a428696a81b027737fc48" style="width:16.810%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="95c8d9f01c6a428696a81b027737fc48" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_image_ext " id="47d5586109804b8db423ab7a7b500151" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-47d5586109804b8db423ab7a7b500151" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix">
                                                <div class="blk_image_data_wrap no_sel c_text">
                                                    <div class="img_container">
                                                        <img style="width: 123px; border-radius: 0px" src="/images/main/file(2).png" >


                                                    </div>

                                                </div></div>
                                        </div>
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="7a6e301db38c40e0a9ea16b7d3ff8703" blk_class="blk_text" type_id="1" pos="2" data-id="b-7a6e301db38c40e0a9ea16b7d3ff8703" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:26px 0px 14px 0px;"><div style="text-align: center;"><br><span style="font-size:16px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="color:#FFFFFF;">Полное</span><br><span style="color:#00FF00;">юридическое online</span><br><span style="color:#FFFFFF;">ведение сделки</span></span></span></div></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="6b5462aab8044720bf84a5b2904d8f6e" style="width:24.263%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="6b5462aab8044720bf84a5b2904d8f6e" style="border-radius:0px;padding:0px">
                                        <div class="blk_container v3 cnt-cells-2 orange_cell_resize " id="305d3b751de64154a77e5bcde50ea82d" type_id="" pos="1">


                                            <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                                                <div class="blk_container_cells cells-2">
                                                    <div class="td_container_cell" cell_id="6db534e7cca044478e02c5dff10465af" style="width:40.406%;padding:0 10px;">
                                                        <!--cell-->
                                                        <div class="cell v3 container_cell sortable_cell first_cell" id="6db534e7cca044478e02c5dff10465af" style="border-radius:0px;padding:0px">
                                                            <div class="blk    blk_text blk-no-bg-lpm-449" id="305162512cf94bd795dff3305873b0e8" blk_class="blk_text" type_id="1" pos="3" data-id="b-305162512cf94bd795dff3305873b0e8" style="opacity: 0;">

                                                                <div class="blk-data ie_css3 clearfix" style="padding:54px 0px 0px 0px;"><p style="text-align: center;"><span style="font-size:90px;"><span style="color:#FFFFFF;">=</span></span></p></div>
                                                            </div>

                                                            <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                                        </div>
                                                        <!--end-cell-->
                                                    </div>
                                                    <div class="td_container_cell" cell_id="4f386ebadfc94644b9a6b3d38c2705e9" style="width:59.594%;padding:0 10px;">
                                                        <!--cell-->
                                                        <div class="cell v3 container_cell sortable_cell" id="4f386ebadfc94644b9a6b3d38c2705e9" style="border-radius:0px;padding:0px">
                                                            <div class="blk    blk_image_ext " id="5d5cb08836194e3ab46fa4a270684859" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-5d5cb08836194e3ab46fa4a270684859" style="opacity: 0;">

                                                                <div class="blk-data ie_css3 clearfix">
                                                                    <div class="blk_image_data_wrap no_sel c_text">
                                                                        <div class="img_container">
                                                                            <img style="width: 133px; border-radius: 0px" src="/images/main/file(3).png" >


                                                                        </div>

                                                                    </div></div>
                                                            </div>
                                                            <div class="blk    blk_text blk-no-bg-lpm-449" id="1fb7a2142e5a483a80d2d188e46d2783" blk_class="blk_text" type_id="1" pos="2" data-id="b-1fb7a2142e5a483a80d2d188e46d2783" style="opacity: 0;">

                                                                <div class="blk-data ie_css3 clearfix" style="padding:3px 0px 0px 0px;"><div style="text-align: center;"><br><br><span style="font-size:16px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="color:#FFFFFF;">Безопасная</span><br><span style="color:#00FF00;">сделка</span></span></span><br>&nbsp;</div></div>
                                                            </div>

                                                            <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                                        </div>
                                                        <!--end-cell-->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>





        </div>
        <div class="blk_section bg_type_image sprint4  is_parallax is_cover" data-par-speed="100" id="3d293459f9a04288948cbceaa5d99959" data-id="s-3d293459f9a04288948cbceaa5d99959" bg_type="image" pos="9" style="padding-bottom: 49px;padding-top: 56px;background-color: #ebf9fa;">

            <div id="section_image_3d293459f9a04288948cbceaa5d99959" class="section-image is_p" style="background-image: url(&#39;https://s.lpmtr.ru/files/b/6/0/b601f021997b2b6d4031c2b5009d52ec.jpg&#39;);background-position: 50% 50%;background-repeat: repeat-x;"></div>
            <div class="section-blackout" style="-ms-filter:&#39;progid:DXImageTransform.Microsoft.Alpha(Opacity=0.93)&#39;; filter:alpha(opacity=0.93); -moz-opacity:0.93; -khtml-opacity:0.93; opacity:0.93;background-color: #EBF9FA;"></div>

            <div class="mha clearfix blk_section_inner" style="width:1170px; background-position: 50% 0%;background-repeat: no-repeat;">

                <div class="tpl_cell tpl_section_cell sortable_cell l_float  " id="1264d2b7bb314336a7786c744f02d030" style="width: 100%;">
                    <div class="blk    blk_text blk-no-bg-lpm-449" id="6ea3fae52573410397cfb368e9bd44c6" blk_class="blk_text" type_id="1" pos="1" data-id="b-6ea3fae52573410397cfb368e9bd44c6" style="opacity: 0;">

                        <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 15px 0px;"><p style="text-align: center;"><span style="color:#82aa34;"><span style="font-size:52px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-style: normal; font-weight: 400;">Развивайте свой бизнес с on-line сервисами портала "Деловед"!</span></span></span></span></p></div>
                    </div>
                    <div class="blk_container v3 cnt-cells-2 orange_cell_resize " id="ff421165ba2e40f08c0d81e7560ec80c" type_id="" pos="2">


                        <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                            <div class="blk_container_cells cells-2">
                                <div class="td_container_cell" cell_id="9701c75da9cb4204831e179b4a98a576" style="width:53.128%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell first_cell" id="9701c75da9cb4204831e179b4a98a576" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_image_ext " id="a8d468051e87480bb834cfe3e542a03e" blk_class="blk_image_ext" type_id="21" pos="2" data-id="b-a8d468051e87480bb834cfe3e542a03e" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix">
                                                <div class="blk_image_data_wrap no_sel c_text">
                                                    <div class="img_container">
                                                        <img id="checkAgent" style="width: 575px; border-radius: 0px" src="/images/main/file(4).png" >
                                                        <div id="checkAgentModal" class="btn_check_agent_modal">Проверить <br> контрагента</div>
                                                        <div  class="modal fade" style="z-index: 11">

                                                            <div class="modal-dialog text-center">

                                                                <div class="modal-content" style="width: 90%;float: left;">



                                                                    <div class="modal-body">
                                                                        <form class="">
                                                                            <input type="text" required="required" placeholder="Введите ИНН контрагента которого хотите проверить" name="search_for_inn" class="form-control" id="search_for_inn">

                                                                                <a href=""  style="margin-top: 20px" class="btn btn-primary"  action="search">
                                                                                    Проверить
                                                                                </a>

                                                                        </form>
                                                                    </div>



                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="57f2f1de61f44c88b4994a8012e14388" style="width:46.872%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="57f2f1de61f44c88b4994a8012e14388" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_text " id="b815abb7ef8b4870b05bff0b004a4fa3" blk_class="blk_text" type_id="1" pos="1" data-id="b-b815abb7ef8b4870b05bff0b004a4fa3" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:9px 0px 7px 0px;background-color:rgba(255,255,255,1);border-radius:31px;"><p style="text-align: center;"><span style="color:#82aa34;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-size:20px;">В Вашем распоряжении только</span><br><span style="font-size:28px;">проверенные и актуальные<br>базы данных:</span></span></span></p></div>
                                        </div>
                                        <div class="blk    blk_box " id="d13be42b519d4069bf867055c0912663" blk_class="blk_box" type_id="28" pos="2" data-id="b-d13be42b519d4069bf867055c0912663" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix"><div class="blk_box_self clearfix" bg="" data-is_border_allow="0" style="padding:20px 20px;border-radius:5px;background:;">
                                                    <div class="cell tpl_cell tpl_box_cell sortable_cell l_float  " id="f4989f64f5d341c08ca94313c4acc28e" style="width: 100%;">
                                                        <div class="blk_container v3 cnt-cells-2 orange_cell_resize " id="3a44366ca2ed41af9324090e8f9881f0" type_id="" pos="1">


                                                            <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                                                                <div class="blk_container_cells cells-2">
                                                                    <div class="td_container_cell" cell_id="99755cd6bccb443cb33b9a0519b6e987" style="width:50.000%;padding:0 10px;">
                                                                        <!--cell-->
                                                                        <div class="cell v3 container_cell sortable_cell first_cell" id="99755cd6bccb443cb33b9a0519b6e987" style="border-radius:0px;padding:0px">
                                                                            <div class="blk    blk_text blk-no-bg-lpm-449" id="a9485f5f6867412593ee01cb7874e0c3" blk_class="blk_text" type_id="1" pos="3" data-id="b-a9485f5f6867412593ee01cb7874e0c3" style="opacity: 0;">

                                                                                <div class="blk-data ie_css3 clearfix" style="padding:0px;"><p style="text-align: center;"><span><strong><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-size:14px;"><span style="color:#A9A9A9;">Более</span></span><br><span style="font-size:24px;"><span style="color:#82aa34;">8 000 000</span></span><br><span style="font-size:18px;"><span style="color:#333333;">юридических лиц</span></span></span></strong></span><br>&nbsp;</p></div>
                                                                            </div>

                                                                            <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                                                        </div>
                                                                        <!--end-cell-->
                                                                    </div>
                                                                    <div class="td_container_cell" cell_id="29a523c11c7344b2bfc8f10c4a46b618" style="width:50.000%;padding:0 10px;">
                                                                        <!--cell-->
                                                                        <div class="cell v3 container_cell sortable_cell" id="29a523c11c7344b2bfc8f10c4a46b618" style="border-radius:0px;padding:0px">
                                                                            <div class="blk    blk_text blk-no-bg-lpm-449" id="b9cab8af414844cc8c7672f775f28cc9" blk_class="blk_text" type_id="1" pos="1" data-id="b-b9cab8af414844cc8c7672f775f28cc9" style="opacity: 0;">

                                                                                <div class="blk-data ie_css3 clearfix" style="padding:0px;"><p style="text-align: center;"><strong><span><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-size:14px;"><span style="color:#A9A9A9;">Более</span></span><br><span style="font-size:24px;"><span style="color:#82aa34;">12 000 000</span></span><br><span style="font-size:18px;"><span style="color:#333333;">контактных данных</span></span></span></span></strong><br>&nbsp;</p></div>
                                                                            </div>

                                                                            <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                                                        </div>
                                                                        <!--end-cell-->
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div><div class="blk    blk_text blk-no-bg-lpm-449" id="994a5b02bbc64c5aa659938730e2d0cb" blk_class="blk_text" type_id="1" pos="2" data-id="b-994a5b02bbc64c5aa659938730e2d0cb" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix" style="padding:0px;"><p style="text-align: center;"><strong><span><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-size:14px;"><span style="color:#A9A9A9;">Более</span></span><br><span style="font-size:24px;"><span style="color:#82aa34;">8 500 000</span></span><br><span style="font-size:18px;"><span style="color:#333333;">индивидуальных предпринимателей</span></span></span></span></strong><br>&nbsp;</p></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="mask blk-box__mask"></div></div>
                                        </div>
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="4b2ab5025ebd4bc482c225804bab6e4f" blk_class="blk_text" type_id="1" pos="3" data-id="b-4b2ab5025ebd4bc482c225804bab6e4f" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:0px;"></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                            </div>
                        </div>

                    </div><div class="blk_container v3 cnt-cells-3 orange_cell_resize " id="6e3701277df34ce78a9ee06cad1d5bf3" type_id="" pos="3">


                        <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                            <div class="blk_container_cells cells-3">
                                <div class="td_container_cell" cell_id="e13f4375266f4f6bb816536f32893dd1" style="width:38.247%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell first_cell" id="e13f4375266f4f6bb816536f32893dd1" style="border-radius:0px;padding:0px">
                                        <div class="blk_container v3 cnt-cells-2 orange_cell_resize " id="89525665a1654957aeb67d2c4f38a7e6" type_id="" pos="1">


                                            <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                                                <div class="blk_container_cells cells-2">
                                                    <div class="td_container_cell" cell_id="99eae9da09b64770a6d848c866e0d790" style="width:38.218%;padding:0 10px;">
                                                        <!--cell-->
                                                        <div class="cell v3 container_cell sortable_cell first_cell" id="99eae9da09b64770a6d848c866e0d790" style="border-radius:0px;padding:0px">
                                                            <div class="blk    blk_image_ext " id="ada207e706ec4a8ca97a372334ed0278" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-ada207e706ec4a8ca97a372334ed0278" style="opacity: 0;">

                                                                <div class="blk-data ie_css3 clearfix">
                                                                    <div class="blk_image_data_wrap no_sel r_text">
                                                                        <div class="img_container">
                                                                            <a href=""><img style="width: 101px; border-radius: 0px" src="/images/main/file(5).png" ></a>



                                                                        </div>

                                                                    </div></div>
                                                            </div>

                                                            <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                                        </div>
                                                        <!--end-cell-->
                                                    </div>
                                                    <div class="td_container_cell" cell_id="0d1b2b7f4e574fecbfb4dc9012816065" style="width:61.782%;padding:0 10px;">
                                                        <!--cell-->
                                                        <div class="cell v3 container_cell sortable_cell" id="0d1b2b7f4e574fecbfb4dc9012816065" style="border-radius:0px;padding:0px">
                                                            <div class="blk    blk_text blk-no-bg-lpm-449" id="c7f69bb66d9147bb8df8a5f2919ca852" blk_class="blk_text" type_id="1" pos="1" data-id="b-c7f69bb66d9147bb8df8a5f2919ca852" style="opacity: 0;">

                                                                <div class="blk-data ie_css3 clearfix" style="padding:38px 0px 13px 0px;"><p><span style="font-size:18px;"><strong><span style="color:#669933;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><g:link style="color:#669933" controller="article" action="deal_online">Сделки online</g:link></span></span></strong></span></p></div>
                                                            </div>

                                                            <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                                        </div>
                                                        <!--end-cell-->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="7a39376d2d324f0e9a6e84f068c35a2e" style="width:35.836%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="7a39376d2d324f0e9a6e84f068c35a2e" style="border-radius:0px;padding:0px">
                                        <div class="blk_container v3 cnt-cells-2 orange_cell_resize " id="2a277da4872a401fb62312f715e08406" type_id="" pos="1">


                                            <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                                                <div class="blk_container_cells cells-2">
                                                    <div class="td_container_cell" cell_id="3e39eccbf1f746cab5e057dcd90e9cd2" style="width:28.283%;padding:0 10px;">
                                                        <!--cell-->
                                                        <div class="cell v3 container_cell sortable_cell first_cell" id="3e39eccbf1f746cab5e057dcd90e9cd2" style="border-radius:0px;padding:0px">
                                                            <div class="blk    blk_image_ext " id="7133d49bcf1a473c83527aae388085c8" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-7133d49bcf1a473c83527aae388085c8" style="opacity: 0;">

                                                                <div class="blk-data ie_css3 clearfix">
                                                                    <div class="blk_image_data_wrap no_sel r_text">
                                                                        <div class="img_container">
                                                                            <a  href=""><img style="width: 101px; border-radius: 0px" src="/images/main/file(6).png" ></a>



                                                                        </div>

                                                                    </div></div>
                                                            </div>

                                                            <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                                        </div>
                                                        <!--end-cell-->
                                                    </div>
                                                    <div class="td_container_cell" cell_id="c71b4f36afbb4efbaea4fc8dc65875ab" style="width:71.717%;padding:0 10px;">
                                                        <!--cell-->
                                                        <div class="cell v3 container_cell sortable_cell" id="c71b4f36afbb4efbaea4fc8dc65875ab" style="border-radius:0px;padding:0px">
                                                            <div class="blk    blk_text blk-no-bg-lpm-449" id="b0bf90a90efd4c478e6a52c7e51c06c2" blk_class="blk_text" type_id="1" pos="1" data-id="b-b0bf90a90efd4c478e6a52c7e51c06c2" style="opacity: 0;">

                                                                <div class="blk-data ie_css3 clearfix" style="padding:38px 0px 8px 0px;"><p><span style="font-size:18px;"><strong><span style="color:#669933;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><g:link style="color:#669933" controller="article" action="jurist_service">Помощь юриста</g:link></span></span></strong></span></p></div>
                                                            </div>

                                                            <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                                        </div>
                                                        <!--end-cell-->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="d7f998de3e2f4cda965db56477a81474" style="width:25.916%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="d7f998de3e2f4cda965db56477a81474" style="border-radius:0px;padding:0px">
                                        <div class="blk_container v3 cnt-cells-2 orange_cell_resize " id="a4fcd6c9247246929424de6effcddb5e" type_id="" pos="1">


                                            <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                                                <div class="blk_container_cells cells-2">
                                                    <div class="td_container_cell" cell_id="a135a14d9dc34b8dbefa6114c3bb78c0" style="width:39.876%;padding:0 10px;">
                                                        <!--cell-->
                                                        <div class="cell v3 container_cell sortable_cell first_cell" id="a135a14d9dc34b8dbefa6114c3bb78c0" style="border-radius:0px;padding:0px">
                                                            <div class="blk    blk_image_ext " id="7fc52347d71142fab1ebcdac747a19a1" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-7fc52347d71142fab1ebcdac747a19a1" style="opacity: 0;">

                                                                <div class="blk-data ie_css3 clearfix">
                                                                    <div class="blk_image_data_wrap no_sel r_text">
                                                                        <div class="img_container">
                                                                            <a href="" style="color:#669933" ><img style="width: 101px; border-radius: 0px" src="/images/main/file(7).png"  ></a>



                                                                        </div>

                                                                    </div></div>
                                                            </div>

                                                            <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                                        </div>
                                                        <!--end-cell-->
                                                    </div>
                                                    <div class="td_container_cell" cell_id="b40ff04201ba4a628fe1c8121a774aa9" style="width:60.124%;padding:0 10px;">
                                                        <!--cell-->
                                                        <div class="cell v3 container_cell sortable_cell" id="b40ff04201ba4a628fe1c8121a774aa9" style="border-radius:0px;padding:0px">
                                                            <div class="blk    blk_text blk-no-bg-lpm-449" id="547d30e02938426a9c8318c3467da319" blk_class="blk_text" type_id="1" pos="1" data-id="b-547d30e02938426a9c8318c3467da319" style="opacity: 0;">

                                                                <div class="blk-data ie_css3 clearfix" style="padding:38px 0px 8px 0px;"><p><span style="font-size:18px;"><font color="#669933" face="verdana, geneva, sans-serif"><b><g:link style="color:#669933" controller="article" action="rating_system">Рейтинг</g:link></b></font></span></p></div>
                                                            </div>

                                                            <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                                        </div>
                                                        <!--end-cell-->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>





        </div>
        <div class="blk_section bg_type_image sprint4 " data-par-speed="" id="d30e3120d0274a26a68a6cafc81dab42" data-id="s-d30e3120d0274a26a68a6cafc81dab42" bg_type="image" pos="13" style="padding-bottom: 41px;padding-top: 68px;background-color: #f7f7f7;">

            <div id="section_image_d30e3120d0274a26a68a6cafc81dab42" class="section-image " style="background-position: 50% 0%;background-repeat: no-repeat;"></div>

            <div class="mha clearfix blk_section_inner" style="z-index: 0;width:1170px; background-position: 50% 0%;background-repeat: no-repeat;">

                <div class="tpl_cell tpl_section_cell sortable_cell l_float  " id="f1f4ef2b237e46eca94ef74def1e65a1" style="width: 100%;">
                    <div class="blk    blk_text blk-no-bg-lpm-449" id="8177a415d0cb4c3eaf5294739848d4a2" blk_class="blk_text" type_id="1" pos="2" data-id="b-8177a415d0cb4c3eaf5294739848d4a2" style="opacity: 0;">

                        <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 33px 0px;"><p style="text-align: center;"><span style="font-size:56px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="line-height:1;"><span style="font-style: normal; font-weight: 500;">ОТЗЫВЫ НАШИХ КЛИЕНТОВ</span></span></span></span></p></div>
                    </div>
                    <div class="blk_container v3 cnt-cells-4 orange_cell_resize " id="7724d27945aa420f9e36f87154c03e86" type_id="" pos="5">


                        <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                            <div class="blk_container_cells cells-4">
                                <div class="td_container_cell" cell_id="58c0c78413014023bea97ad0d26cc47c" style="width:25.000%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell first_cell" id="58c0c78413014023bea97ad0d26cc47c" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_box " id="95ee1c2a3d9b4fb9855357919df0cc99" blk_class="blk_box" type_id="28" pos="1" data-id="b-95ee1c2a3d9b4fb9855357919df0cc99" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix"><div class="blk_box_self clearfix" bg="#ffffff" data-is_border_allow="0" style="padding:20px 20px;border-radius:10px;background:#ffffff;">
                                                    <div class="cell tpl_cell tpl_box_cell sortable_cell l_float  " id="000cbae016cd40b2b13e4a1756b2b0af" style="width: 100%;">
                                                        <div class="blk    blk_image_ext " id="ece7d76e656d425290112aff1a46062f" blk_class="blk_image_ext" type_id="21" pos="2" data-id="b-ece7d76e656d425290112aff1a46062f" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix">
                                                                <div class="blk_image_data_wrap no_sel c_text">
                                                                    <div class="img_container">
                                                                        <img style="width: 198px; border-radius: 5px; " src="/images/main/file(8).png" >


                                                                    </div>

                                                                </div></div>
                                                        </div>
                                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="43bb377904a84db8b8920b9ce7f48114" blk_class="blk_text" type_id="1" pos="3" data-id="b-43bb377904a84db8b8920b9ce7f48114" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix" style="padding:5px 0px 20px 0px;"><p style="text-align: center;"><font face="verdana, geneva, sans-serif"><span style="font-size:14px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;">Фермер</span></span><br><br><span style="font-size: 20px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;">Петр<br>Власенко</span></span></font></p></div>
                                                        </div>
                                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="dce8c13095fa4892955d05b30150f7aa" blk_class="blk_text" type_id="1" pos="4" data-id="b-dce8c13095fa4892955d05b30150f7aa" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix" style="padding:11px 0px 0px 0px;"><p><span style="font-style:normal;font-weight:400;font-size:16px;">Провели продажу сырья. Времени на проверку контрагента, заключение договора и все переговоры потратили в 3 раза меньше, чем при обычной сделке. Советую тем, кто ценит свое время и деньги! </span></p></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="mask blk-box__mask"></div></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="eed73a40951547a887ee51adc7da6cb6" style="width:25.000%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="eed73a40951547a887ee51adc7da6cb6" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_box " id="23a5e7b40bfc402aabd994f15ce652ed" blk_class="blk_box" type_id="28" pos="1" data-id="b-23a5e7b40bfc402aabd994f15ce652ed" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix"><div class="blk_box_self clearfix" bg="#ffffff" data-is_border_allow="0" style="padding:20px 20px;border-radius:10px;background:#ffffff;">
                                                    <div class="cell tpl_cell tpl_box_cell sortable_cell l_float  " id="ced91814b78445a6a3789e34b3ab69b1" style="width: 100%;">
                                                        <div class="blk    blk_image_ext " id="720fec43869042b2945eb629471285be" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-720fec43869042b2945eb629471285be" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix">
                                                                <div class="blk_image_data_wrap no_sel c_text">
                                                                    <div class="img_container">
                                                                        <img style="width: 195px; border-radius: 5px; " src="/images/main/file(9).png" >


                                                                    </div>

                                                                </div></div>
                                                        </div>
                                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="7eb559418a564f33a2339244029f85a8" blk_class="blk_text" type_id="1" pos="2" data-id="b-7eb559418a564f33a2339244029f85a8" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix" style="padding:2px 0px 18px 0px;">

                                                                <p style="text-align: center;"><span style="font-size:14px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-style: normal; font-weight: 400;">Владелец бизнеса</span></span></span><br><br><span style="font-size:20px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-style: normal; font-weight: 400;">Азамат<br>Мусагалиев</span></span></span></p></div>
                                                        </div>
                                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="7dfc487d382c47b5934166f1b740557d" blk_class="blk_text" type_id="1" pos="3" data-id="b-7dfc487d382c47b5934166f1b740557d" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix" style="padding:11px 0px 0px 0px;"><p><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-style:normal;font-weight:400;font-size:16px;">Постоянно пользуюсь услугами портала "Деловед", специалисты и сервисы которого работают очень четко. Все сделки проходят прозрачно. Юристы оказывают очень профессиональное сопровождение и консультации. Рекомендую!</span></span></p></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="mask blk-box__mask"></div></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="85c2816965e149fdb555042c3e5659f8" style="width:25.000%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="85c2816965e149fdb555042c3e5659f8" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_box " id="688da40cbce84b81ad23242242a88515" blk_class="blk_box" type_id="28" pos="1" data-id="b-688da40cbce84b81ad23242242a88515" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix"><div class="blk_box_self clearfix" bg="#ffffff" data-is_border_allow="0" style="padding:20px 20px;border-radius:10px;background:#ffffff;">
                                                    <div class="cell tpl_cell tpl_box_cell sortable_cell l_float  " id="f6201ec206a545e6a91334caf36d6ec6" style="width: 100%;">
                                                        <div class="blk    blk_image_ext " id="75352411af7c4c56b1b69c19540718ef" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-75352411af7c4c56b1b69c19540718ef" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix">
                                                                <div class="blk_image_data_wrap no_sel c_text">
                                                                    <div class="img_container">
                                                                        <img style="width: 159px; border-radius: 5px; " src="/images/main/file(10).png" >


                                                                    </div>

                                                                </div></div>
                                                        </div>
                                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="34b130f753cc4fb4aa466d2d3c9a100c" blk_class="blk_text" type_id="1" pos="3" data-id="b-34b130f753cc4fb4aa466d2d3c9a100c" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 26px 0px;">
                                                                <p style="text-align: center;"><span style="font-size:14px;"><strong><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-style: normal; font-weight: 400;">Владелец торговой компании</span></span></strong></span><br><br><span style="font-size:20px;"><strong><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-style: normal; font-weight: 400;">Владимир Вознесенский</span></span></strong></span></p></div>
                                                        </div>
                                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="fd39bfbab986484ca5d677dceb772261" blk_class="blk_text" type_id="1" pos="4" data-id="b-fd39bfbab986484ca5d677dceb772261" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix" style="padding:0px;"><p><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-style:normal;font-weight:400;font-size:16px;">Ранее неоднократно возникали проблемы при работе с новыми не проверенными партнерами из других регионов. Заключая сделки с помощью портала "Деловед", я обезопасил свой бизнес от рисков на 100%. Здесь возможно и проверить контрагента, и посмотреть его рейтинги, и получить грамотную консультацию от юриста.</span></span></p></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="mask blk-box__mask"></div></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="acbdb9963b354f7b97e05ded22297b0d" style="width:25.000%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="acbdb9963b354f7b97e05ded22297b0d" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_box " id="1ff877e69152414c96fb82c149c5b5f6" blk_class="blk_box" type_id="28" pos="1" data-id="b-1ff877e69152414c96fb82c149c5b5f6" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix"><div class="blk_box_self clearfix" bg="#ffffff" data-is_border_allow="0" style="padding:20px 20px;border-radius:10px;background:#ffffff;">
                                                    <div class="cell tpl_cell tpl_box_cell sortable_cell l_float  " id="76a30c2f2f084a0088a0806c7f829911" style="width: 100%;">
                                                        <div class="blk    blk_image_ext " id="d74161b1a0294b90832950ea637ad43e" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-d74161b1a0294b90832950ea637ad43e" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix">
                                                                <div class="blk_image_data_wrap no_sel c_text">
                                                                    <div class="img_container">
                                                                        <img style="width: 211px; border-radius: 5px; " src="/images/main/file(11).png" >


                                                                    </div>

                                                                </div></div>
                                                        </div>
                                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="ff56e8bdadc64ecc8f8617d36ae05407" blk_class="blk_text" type_id="1" pos="2" data-id="b-ff56e8bdadc64ecc8f8617d36ae05407" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 20px 0px;">
                                                                <p style="text-align: center;"><span style="font-size:14px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-style: normal; font-weight: 400;">Юрист логистической компании</span></span></span><br><br><span style="font-size:20px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-style: normal; font-weight: 400;">Юлия Маматова</span></span></span></p></div>
                                                        </div>
                                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="2992c1d5453c45d7b4f9438894c1a05c" blk_class="blk_text" type_id="1" pos="3" data-id="b-2992c1d5453c45d7b4f9438894c1a05c" style="opacity: 0;">

                                                            <div class="blk-data ie_css3 clearfix" style="padding:15px 0px 0px 0px;"><p><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="font-style:normal;font-weight:400;font-size:16px;">Специалисты "Деловеда" обладают большим багажем знаний и опыта. "Деловед" - это универсальный гарант сделок в дистанционных продажах товаров и услуг, который надежно обеспечивает безопасность как покупателям, так и продавцам. </span></span></p></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="mask blk-box__mask"></div></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>





        </div>
        <div class="blk_section bg_type_image sprint4  is_parallax is_cover" data-par-speed="100" id="a082cdef1c9d4d82a281bc35e8baff8b" data-id="s-a082cdef1c9d4d82a281bc35e8baff8b" bg_type="image" pos="14" style="padding-bottom: 59px;padding-top: 53px;">

            <div id="section_image_a082cdef1c9d4d82a281bc35e8baff8b" class="section-image is_p" style="background-image: url(&#39;https://s.lpmtr.ru/files/3/7/f/37fa4be34cbb3f27be490e350fb228c2.jpg&#39;);background-position: 50% 50%;background-repeat: no-repeat;"></div>
            <div class="section-blackout" style="-ms-filter:&#39;progid:DXImageTransform.Microsoft.Alpha(Opacity=0.84)&#39;; filter:alpha(opacity=0.84); -moz-opacity:0.84; -khtml-opacity:0.84; opacity:0.84;background-color: #EBF9FA;"></div>

            <div class="mha clearfix blk_section_inner" style="width:1170px; background-position: 50% 0%;background-repeat: no-repeat;">

                <div class="tpl_cell tpl_section_cell sortable_cell l_float  " id="01b65450969d46bca53bdc923fc94d09" style="width: 100%;">
                    <div class="blk    blk_text blk-no-bg-lpm-449" id="37f693fd433d4ff9a72ceb0ebbee35bd" blk_class="blk_text" type_id="1" pos="1" data-id="b-37f693fd433d4ff9a72ceb0ebbee35bd" style="opacity: 0;">

                        <div class="blk-data ie_css3 clearfix" style="padding:22px 0px 19px 0px;"><p style="text-align: center;"><span style="color:#000066;"><span style="font-size:56px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;">ТАРИФЫ</span></span></span></p></div>
                    </div>
                    <div class="blk_container v3 cnt-cells-3 orange_cell_resize " id="e96b2a47406d463eb16d9b34bc9496ae" type_id="" pos="3">


                        <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                            <div class="blk_container_cells cells-3">
                                <div class="td_container_cell" cell_id="e0226b5f895148849bd87c39ec3d2471" style="width:45.048%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell first_cell" id="e0226b5f895148849bd87c39ec3d2471" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_text " id="bc9d76219f254256a5dccc212bce0d9a" blk_class="blk_text" type_id="1" pos="1" data-id="b-bc9d76219f254256a5dccc212bce0d9a" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:11px 0px 9px 0px;background-color:rgba(130,170,52,1);border-radius:7px;"><p style="text-align: center;"><span style="font-size:36px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="color:#FFFFFF;"><g:link controller="front" style="color:white" action="tariffs">Стартовая подписка</g:link></span></span></span></p></div>
                                        </div>
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="752ebf3e50344224895dfa1b579524e7" blk_class="blk_text" type_id="1" pos="2" data-id="b-752ebf3e50344224895dfa1b579524e7" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:0px;"><p style="text-align: center;"><span style="font-size:22px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;">Мы подобрали для Вас оптимальный набор инструментов<br>для начала работы с порталом</span></span></p></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell blk-container__empty-cell" cell_id="5bf8e3067bda4d6d8835f9f37a21ec58" style="width:10.000%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell empty_cell" id="5bf8e3067bda4d6d8835f9f37a21ec58">

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="c484266d10514c6687e2a29d69a7e51e" style="width:44.951%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="c484266d10514c6687e2a29d69a7e51e" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_text " id="3302ce0b045240cc9057ec6023ff365f" blk_class="blk_text" type_id="1" pos="1" data-id="b-3302ce0b045240cc9057ec6023ff365f" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:11px 0px 9px 0px;background-color:rgba(130,170,52,1);border-radius:7px;"><p style="text-align: center;"><span style="font-size:36px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="color:#FFFFFF;"><g:link controller="front" style="color:white" action="tariffs">Расширенная подписка</g:link></span></span></span></p></div>
                                        </div>
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="2e9e3a23c51b4d07a4f594997f5fd529" blk_class="blk_text" type_id="1" pos="2" data-id="b-2e9e3a23c51b4d07a4f594997f5fd529" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:0px;"><p style="text-align: center;"><span style="font-size:22px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;">Предлагаем максимально полный набор инструментов для наиболее комфортного ведения безопасных сделок</span></span></p></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                            </div>
                        </div>

                    </div><div class="blk    blk_text blk-no-bg-lpm-449" id="1ff997558c1b40f98ca88e435e276716" blk_class="blk_text" type_id="1" pos="4" data-id="b-1ff997558c1b40f98ca88e435e276716" style="opacity: 0;">

                        <div class="blk-data ie_css3 clearfix" style="padding:0px;"><p style="text-align: center;"><u><span style="font-size:32px;"><font color="#000066" face="verdana, geneva, sans-serif"><g:link style="color:#000066" controller="front" action="tariffs">Узнать подробнее</g:link></font></span></u></p></div>
                    </div>

                </div>
            </div>





        </div>
        <div class="blk_section bg_type_image sprint4  is_parallax is_cover" data-par-speed="100" id="35c721373abd4ec8a3b8be3355e94f53" data-id="s-35c721373abd4ec8a3b8be3355e94f53" bg_type="image" pos="18" style="padding-bottom: 58px;padding-top: 64px;">

            <div id="section_image_35c721373abd4ec8a3b8be3355e94f53" class="section-image is_p" style="background-image: url(&#39;https://s.lpmtr.ru/files/6/4/7/647d4c325a02698e832a0b71dc20e023.jpg&#39;);background-position: 50% 50%;background-repeat: no-repeat;"></div>
            <div class="section-blackout" style="-ms-filter:&#39;progid:DXImageTransform.Microsoft.Alpha(Opacity=0.92)&#39;; filter:alpha(opacity=0.92); -moz-opacity:0.92; -khtml-opacity:0.92; opacity:0.92;background-color: #BDE055;"></div>

            <div class="mha clearfix blk_section_inner" style="width:1170px; background: no-repeat 50% 0%;">

                <div class="tpl_cell tpl_section_cell sortable_cell l_float  " id="1406524ce39145beb0be6ac82816786a" style="width: 100%;">
                    <div class="blk    blk_text blk-no-bg-lpm-449" id="080ec6bfc0e44c40be10ed39cc63c36c" blk_class="blk_text" type_id="1" pos="1" data-id="b-080ec6bfc0e44c40be10ed39cc63c36c" style="opacity: 0;">

                        <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 29px 0px;"><p style="text-align: center;"><span style="font-size:56px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="line-height:1;"><span style="font-style: normal; font-weight: 500;">ТРЕБУЕТСЯ КОНСУЛЬТАЦИЯ?</span></span></span></span></p></div>
                    </div>
                    <div class="blk is_animated_block    blk_text blk-no-bg-lpm-449" id="8a45c89d73b042d8bd11ec77783b4180" blk_class="blk_text" type_id="1" pos="4" data-id="b-8a45c89d73b042d8bd11ec77783b4180" style="opacity: 0;visibility: visible!important;">

                        <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 0px 0px;"><p style="text-align: center;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="line-height:1.2;"><span style="font-style: normal; font-weight: 300;"><font face="roboto"><span style="font-size: 22px;">Получите </span><span style="color:#ffffff;"><span style="font-size:28px;"><strong><span style="font-weight: 400;">бесплатную консультацию</span></strong></span></span><span style="font-size: 22px;"> нашего специалиста</span></font></span></span></span></p></div>
                    </div>
                    <div class="blk    blk_form  blk-no-bg blk-no-border" id="22c043068e1e4ea88042f1223dc58f7d" blk_class="blk_form" type_id="6" pos="5" data-id="b-22c043068e1e4ea88042f1223dc58f7d" style="opacity: 0;">

                        <div class="blk-data ie_css3 clearfix"><div class="blk_form_wrap c_text is_popover ">

                                <!--Если пользователь является гостем-->
                                <?php  if(Yii::$app->user->isGuest):?>
                                    <a class="btn-new ie_css3 btn-form-popover" href="#" data-target="#Contact" data-toggle="modal">ПОЛУЧИТЬ КОНСУЛЬТАЦИЮ</a>
                                <?php endif?>

                                <!--Если пользователь не является гостем-->
                                <?php if(!Yii::$app->user->isGuest):?>
                                    <a class="btn-new ie_css3 btn-form-popover"  href="/#">ПОЛУЧИТЬ КОНСУЛЬТАЦИЮ</a>
                                <?php endif?>


                                    <script>
                                        $(document).ready(function(){
                                            $('#signupform-inn').change(function () {
                                                if ($('#signupform-inn').val().length === 10){
                                                    console.log('10');
                                                    var inn = $('#signupform-inn').val();
                                                    $.ajax({
                                                        type:'POST',
                                                        data:{
                                                            'go':9031,
                                                            'agent_id':53,
                                                            'agent_pass':'MZcaHpC3',
                                                            'user_login':'Aiding',
                                                            'user_pass':'CCloCgO3',
                                        //                'msp_type':1,
                                        //                'branchs':2,
                                                            'list_count_page':500,
                                                            'status':1,
                                                            'list_current_page':1,
                                                            'inn':inn,
                                                            'resource_id':7,
                                                            'forms[]':8,
                                                            'return_type_info':3,
                                                            'list_query_id':0
                                                        },
                                                        dataType: "xml",
                                                        url:'http://api2-s1.1clicom.ru/services.php',
                                                        success:function (data) {


                                                            var data = $(data).find('record')[0];
                                                            if(data){
                                                                $('.div_hidden').hide()

                                                                var ogrn = $(data).find('ogrn'); //
                                                                if(!ogrn){
                                                                    $('.div_hidden').show('fast');
                                                                }
                                                                $('#signupform-ogrn').val(ogrn.text());
                                                                var organization_name = $(data).find('organization_name');//
                                                                $('#signupform-full_name').val(organization_name.text())
                                                                console.log(organization_name)
                                                                $('#signupform-brand_name').val(organization_name.text())

                                                                var address = $(data).find('address');//
                                                                $('#signupform-legal_address]').val(address.text())
                                                                var phone = $(data).find('phone');//
                                                                $('#signupform-phone1').val(phone.text())

                                                                var fax = $(data).find('fax');//
                                                                $('#signupform-fax').val(fax.text());
                                                                var opf = $(data).find('opf');
                                                                if(opf.text() ==='Общества с ограниченной ответственностью' ){
                                                                    $('#signupform-org_form_id').val(2)
                                                                }
                                                                if(opf.text() ==='Открытые акционерные общества' ){
                                                                    $('#signupform-org_form_id').val(3)
                                                                }
                                                                if(opf.text() ==='Закрытые акционерные общества' ){
                                                                    $('#signupform-org_form_id').val(5)
                                                                }
                                                                if(opf.text() ==='Публичные акционерные общества' ){
                                                                    $('#signupform-org_form_id').val(4)
                                                                }
                                                                if(opf.text() ==='Индивидуальный предприниматель' ){
                                                                    $('#signupform-org_form_id').val(1)
                                                                }
                                                                var head_fio = $(data).find('head_fio');//
                                                                var place = $(data).find('place');

                                                                $('#signupform-address').val(place.text());

                                                                $('#signupform-director').val(head_fio.first().text());


                                                                var registration_date = $(data).find('registration_date');//
                                                                var date = registration_date.text().split('.');

                                                                var full_date = date[1]+'/'+date[0]+'/'+date[2]
                                                                $('#signupform-date').val(full_date);

                                                                $('#signupform-work_time').val('ПН-ПТ: 9:30 - 18.00, СБ, ВС: Выходной');

                                                            }else{
                                                                $('.div_hidden').show()
                                                            }
                                                        },
                                                        error:function (err) {
                                                            $('.div_hidden').show()
                                                            console.log(err);

                                                        }

                                                    });

                                                }
                                            });

                                        });
                                        function renderSuccess(data) {
                                            window.location.href = data['urlString']
                                        }
                                        function renderError(XMLHttpRequest) {
                                            $('.error-temp').remove();
                                            console.log(XMLHttpRequest['responseJSON']['errors']);
                                            $.each(XMLHttpRequest['responseJSON']['errors'],function (key,value) {
                                                if(value['field'] === "agreement"){

                                                }
                                                else {
                                                    var span = $('<span>',{class:'error-temp',style:'color:red'});
                                                    $("[name="+value['field']+"]").after(span.text('Не корректно введен или такой уже имеется'))
                                                }
                                            })
                                        }
                                    </script>


                            </div>
                        </div>
                    </div>

                </div>
            </div>





        </div>
        <div class="blk_section bg_type_image sprint4 " data-par-speed="" id="8c8a9ee156e04d338a7b027d277aa9b5" data-id="s-8c8a9ee156e04d338a7b027d277aa9b5" bg_type="image" pos="19" style="padding-bottom: 24px;padding-top: 32px;background-color: #94c43d;z-index: 0!important">

            <div id="section_image_8c8a9ee156e04d338a7b027d277aa9b5" class="section-image " style="background-position: 50% 0%;background-repeat: no-repeat;"></div>

            <div class="mha clearfix blk_section_inner" style="width:1170px; background-position: 50% 0%;background-repeat: no-repeat;">

                <div class="tpl_cell tpl_section_cell sortable_cell l_float  " id="430b28296b75475f9846db869566ceff" style="width: 100%;">
                    <div class="blk    blk_text blk-no-bg-lpm-449" id="c34bf662ec5f43e9927ca9e5989f1475" blk_class="blk_text" type_id="1" pos="1" data-id="b-c34bf662ec5f43e9927ca9e5989f1475" style="opacity: 0;">

                        <div class="row bottom_menu blk-data ie_css3 clearfix" style="padding:0px;"><p style="text-align: center;"><span style="font-size:18px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="color:#FFFFFF;">
                            <div class="col-xs-12">
                                <ul style="padding: 0;text-align: center;">
                                       <li style="margin:0 15px 0 15px;"><a style="font-size: 1.3em" href="#">Статьи</a></li>
                                        <li style="margin:0 15px 0 15px;"><a style="font-size: 1.3em" href="#">О портале</a></li>


                                    <li style="margin:0 15px 0 15px;"><a style="font-size: 1.3em" href="#">Товары</a></li>
                                        <li style="margin:0 15px 0 15px;"><a style="font-size: 1.3em" href="#">Услуги</a></li>

                                    <!--Если пользователь является гостем-->
                                    <?php  if(Yii::$app->user->isGuest):?>
                                        <li style="margin:0 15px 0 15px;"><a style="font-size: 1.3em" href="javascript:void(0)" onclick="noAuth()">Отзывы или предложения</a></li>
                                    <?php endif?>

                                    <!--Если пользователь не является гостем-->
                                    <?php if(!Yii::$app->user->isGuest):?>
                                        <li style="margin:0 15px 0 15px;"><a style="font-size: 1.3em" href="#" data-target="#Suggestion" data-toggle="modal">Отзывы или предложения</a></li>
                                    <?php endif;?>
                                </ul>
                            </div>
                            </span></span></span></p></div>
                    </div>

                </div>
            </div>





        </div>
        <div class="blk_section bg_type_image sprint4 " data-par-speed="" id="c097e98837044116b1d3fcb31ee6aea6" data-id="s-c097e98837044116b1d3fcb31ee6aea6" bg_type="image" pos="20" style="padding-bottom: 58px;padding-top: 100px;background-color: #f7f7f7;">

            <div id="section_image_c097e98837044116b1d3fcb31ee6aea6" class="section-image " style="background-position: 50% 0%;background-repeat: no-repeat;"></div>

            <div class="mha clearfix blk_section_inner" style="width:1170px;z-index: 0; background-position: 50% 0%;background-repeat: no-repeat;">

                <div class="tpl_cell tpl_section_cell sortable_cell l_float  " id="5da2bcbde60d4b94859ace213a981ae6" style="width: 100%;">
                    <div class="blk    blk_text blk-no-bg-lpm-449" id="bf11f598476e41dbac09f851b84a8cfe" blk_class="blk_text" type_id="1" pos="1" data-id="b-bf11f598476e41dbac09f851b84a8cfe" style="opacity: 0;">

                        <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 0px 0px;"><p style="text-align: center;"><span style="font-size:56px;"><span f_id="verdana" style="font-family:verdana,geneva,sans-serif;"><span style="line-height:1;"><span style="font-style: normal; font-weight: 500;">НАШИ КОНТАКТЫ</span></span></span></span></p></div>
                    </div>
                    <div class="blk    blk_text blk-no-bg-lpm-449" id="2f5973a7e50a440bb8292c9665232864" blk_class="blk_text" type_id="1" pos="3" data-id="b-2f5973a7e50a440bb8292c9665232864" style="opacity: 0;">

                        <div class="blk-data ie_css3 clearfix" style="padding:0px 0px 29px 0px;">
                            <p style="text-align: center;"><span f_id="roboto_light" style="font-family:roboto;font-style:normal;font-weight:300;"><span style="font-size:22px;">Свяжитесь&nbsp;с нами, и мы обязательно ответим!</span></span></p></div>
                    </div>
                    <div class="blk_container v3 cnt-cells-3 orange_cell_resize " id="a66cf9e40dbc4872903be00ba317b20b" type_id="" pos="4">


                        <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                            <div class="blk_container_cells cells-3">
                                <div class="td_container_cell" cell_id="2670a7cad8e440ea84f81cf76abc9b7d" style="width:33.333%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell first_cell" id="2670a7cad8e440ea84f81cf76abc9b7d" style="border-radius:0px;padding:0px">
                                        <div class="blk    blk_text blk-no-bg-lpm-449" id="1cb50365c8b5489a88b558fce4794deb" blk_class="blk_text" type_id="1" pos="1" data-id="b-1cb50365c8b5489a88b558fce4794deb" style="opacity: 0;">

                                            <div class="blk-data ie_css3 clearfix" style="padding:0px;">
                                                <p style="text-align: center;"><span f_id="roboto_thin" style="font-family:roboto;font-style:normal;font-weight:100;"><span style="font-size: 16px;"><strong style="font-family: roboto; font-size: 22px; background-color: rgb(255, 255, 255);">Почта:</strong></span><br style="font-family: roboto; font-size: 22px; background-color: rgb(255, 255, 255);"><span style="font-size:20px;"><span f_id="roboto_light" style="font-weight: 300;">deloved.info@gmail.com</span></span></span></p></div>
                                        </div>

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell" cell_id="6eb34b171abb4c08989fcab4ce799164" style="width:33.333%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell" id="6eb34b171abb4c08989fcab4ce799164" style="border-radius:0px;padding:0px">
                                        <div class="blk_container v3 cnt-cells-3 orange_cell_resize " id="50171332efe74848b93e6610d9c2574d" type_id="" pos="3">


                                            <div class="blk_container_cells_wrap" style="margin:0 -10px;">
                                                <div class="blk_container_cells cells-2">
                                                    <div class="td_container_cell" cell_id="37def586f6a245149dee4ea9d5c6367d" style="width:50%;padding:0 10px;">
                                                        <!--cell-->
                                                        <div class="cell v3 container_cell sortable_cell first_cell" id="37def586f6a245149dee4ea9d5c6367d" style="border-radius:0px;padding:0px">
                                                            <div class="blk    blk_image_ext " id="78b0aa358d9d490d9f17ed883ff790d2" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-78b0aa358d9d490d9f17ed883ff790d2" style="opacity: 0;">

                                                                <div class="blk-data ie_css3 clearfix">
                                                                    <div class="blk_image_data_wrap no_sel r_text">
                                                                        <div class="img_container">
                                                                            <a href="https://vk.com/publicdelovedru"><img style="width: 40px; border-radius: 0px"  src="/images/main/file(12).png" ></a>


                                                                        </div>

                                                                    </div></div>
                                                            </div>

                                                            <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                                        </div>
                                                        <!--end-cell-->
                                                    </div>
                                                    <div class="td_container_cell" cell_id="3a6fd40d09e4401bbee14b75267c9e3b" style="width:50%;padding:0 10px;">
                                                        <!--cell-->
                                                        <div class="cell v3 container_cell sortable_cell" id="3a6fd40d09e4401bbee14b75267c9e3b" style="border-radius:0px;padding:0px">
                                                            <div class="blk    blk_image_ext " id="0eef48d221b041c18c9119d06cce8824" blk_class="blk_image_ext" type_id="21" pos="1" data-id="b-0eef48d221b041c18c9119d06cce8824" style="opacity: 0;">

                                                                <div class="blk-data ie_css3 clearfix">
                                                                    <div class="blk_image_data_wrap no_sel c_text">
                                                                        <div class="img_container">
                                                                            <a href="https://www.facebook.com/%D0%91%D0%B8%D0%B7%D0%BD%D0%B5%D1%81-%D0%BF%D0%BE%D1%80%D1%82%D0%B0%D0%BB-%D0%94%D0%B5%D0%BB%D0%BE%D0%B2%D0%B5%D0%B4-336929573339077/"><img style="width: 40px; border-radius: 0px" src="/images/main/file(13).png" ></a>


                                                                        </div>

                                                                    </div></div>
                                                            </div>

                                                            <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                                        </div>
                                                        <!--end-cell-->
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                                <div class="td_container_cell blk-container__empty-cell" cell_id="380e6bb066ed4791b613b12d38e60742" style="width:33.333%;padding:0 10px;">
                                    <!--cell-->
                                    <div class="cell v3 container_cell sortable_cell empty_cell" id="380e6bb066ed4791b613b12d38e60742">

                                        <div class="blk-container__del-cell"><i class="fa fa-trash-o"></i></div>
                                    </div>
                                    <!--end-cell-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>





        </div>
    </div>
    <!--end-sections-list-->
    <div id="popup_list"></div>
    <!--end-popup-list view-->
</div>
<?php if(Yii::$app->user->isGuest) {
    echo Login::widget();
    echo SignUp::widget();
    echo PasswordReset::widget();
    echo Contact::widget();
}
?>
<?php if(!Yii::$app->user->isGuest){
    echo Suggestion::widget();
}?>
<script>
    function noAuth() {
        $('#Login').modal('show');
    }


    $(function () {
        var hash = window.location.hash;
        if(hash == '#loginmodal'){

            $('#Login').modal('show');


        }
        $('.lang').click(function () {
            var $lang =$(this).text();
            $.ajax({
                type:'POST',
                url:'/admin/account/change-language?lang='+$lang,
                success:function () {
                    window.location.reload();
                },
                error:function () {

                }
            });

        })
    })
</script>

