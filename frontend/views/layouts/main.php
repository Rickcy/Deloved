<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\MainAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

MainAsset::register($this);
$session = Yii::$app->session;
if ($session->has('lang')){
    $lang = $session->get('lang');
}else{
    $lang = Yii::$app->language;
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language = $lang ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>


    <style id="placeholder-style_74db5d09fab04093b77e3766750a23b7" type="text/css">
        #frm74db5d09fab04093b77e3766750a23b7 input:-moz-placeholder,
        #frm74db5d09fab04093b77e3766750a23b7 input:-moz-placeholder{
            color: #000000;
        }

        #frm74db5d09fab04093b77e3766750a23b7 input::-webkit-input-placeholder,
        #frm74db5d09fab04093b77e3766750a23b7 textarea::-webkit-input-placeholder {
            color: #000000;
        }
    </style>

    <style id="placeholder-style_22c043068e1e4ea88042f1223dc58f7d" type="text/css">
        #frm22c043068e1e4ea88042f1223dc58f7d input:-moz-placeholder,
        #frm22c043068e1e4ea88042f1223dc58f7d input:-moz-placeholder{
            color: #919191;
        }

        #frm22c043068e1e4ea88042f1223dc58f7d input::-webkit-input-placeholder,
        #frm22c043068e1e4ea88042f1223dc58f7d textarea::-webkit-input-placeholder {
            color: #919191;
        }
    </style>

    <style id="btn-style-h-a" type="text/css">
        div[data-id='b-0542c9465b82469c9343c1acc8ca95e7'] .btn-new{
        ; font-family: Open Sans; font-weight: 300; font-style: normal;font-size:17px;color:#4CAF50;padding:7px 13px;background:transparent;border:2px solid #4CAF50;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;
        }
        div[data-id='b-0542c9465b82469c9343c1acc8ca95e7'] .btn-new:hover{
            background:transparent;border-color:#4CAF50!important;color:#4CAF50;
        }
        div[data-id='b-0542c9465b82469c9343c1acc8ca95e7'] .btn-new:active{
            background:transparent;border-color:#4CAF50!important;color:#4CAF50;transform:scale(0.97);
        }
        form[frm-id='74db5d09fab04093b77e3766750a23b7'] .wind-footer .btn-new{
        ; font-family: Open Sans; font-weight: 300; font-style: normal;font-size:28px;color:#FFFFFF;padding:10px 20px;background:#4CAF50;border:2px solid #4CAF50;-moz-border-radius:255px;-webkit-border-radius:255px;border-radius:255px;
        }
        form[frm-id='74db5d09fab04093b77e3766750a23b7'] .wind-footer .btn-new:hover{
            background:#4CAF50;border-color:#4CAF50!important;color:#FFFFFF;
        }
        form[frm-id='74db5d09fab04093b77e3766750a23b7'] .wind-footer .btn-new:active{
            background:#4CAF50;border-color:#4CAF50!important;color:#FFFFFF;transform:scale(0.97);
        }
        div[data-id='b-74db5d09fab04093b77e3766750a23b7'].blk_form .blk_form_wrap.is_popover .btn-new{
        ; font-family: Open Sans; font-weight: 300; font-style: normal;font-size:30px;color:#FFFFFF;padding:10px 20px;background:#4CAF50;border:2px solid #4CAF50;-moz-border-radius:255px;-webkit-border-radius:255px;border-radius:255px;
        }
        div[data-id='b-74db5d09fab04093b77e3766750a23b7'].blk_form .blk_form_wrap.is_popover .btn-new:hover{
            background:#4CAF50;border-color:#4CAF50!important;color:#FFFFFF;
        }
        div[data-id='b-74db5d09fab04093b77e3766750a23b7'].blk_form .blk_form_wrap.is_popover .btn-new:active{
            background:#4CAF50;border-color:#4CAF50!important;color:#FFFFFF;transform:scale(0.97);
        }
        form[frm-id='22c043068e1e4ea88042f1223dc58f7d'] .wind-footer .btn-new{
        ; font-family: Roboto; font-weight: 400; font-style: normal;font-size:18px;color:#000000;padding:15px 30px;background:#BDE055;border:none;-moz-border-radius:30px;-webkit-border-radius:30px;border-radius:30px;
        }
        form[frm-id='22c043068e1e4ea88042f1223dc58f7d'] .wind-footer .btn-new:hover{
            background:#CDFA64;border-color:#BEBEBE!important;color:#030303;
        }
        form[frm-id='22c043068e1e4ea88042f1223dc58f7d'] .wind-footer .btn-new:active{
            background:#CDFA64;border-color:#BEBEBE!important;color:#030303;transform:scale(0.97);
        }
        div[data-id='b-22c043068e1e4ea88042f1223dc58f7d'].blk_form .blk_form_wrap.is_popover .btn-new{
        ; font-family: Roboto; font-weight: 500; font-style: normal;font-size:14px;color:#252830;padding:20px 40px;background:#FFFFFF;border:none;-moz-border-radius:30px;-webkit-border-radius:30px;border-radius:30px;
        }
        div[data-id='b-22c043068e1e4ea88042f1223dc58f7d'].blk_form .blk_form_wrap.is_popover .btn-new:hover{
            background:#FFFFFF;border-color:#000000!important;color:#252830;
        }
        div[data-id='b-22c043068e1e4ea88042f1223dc58f7d'].blk_form .blk_form_wrap.is_popover .btn-new:active{
            background:#FFFFFF;border-color:#FFFFFF!important;color:#252830;transform:scale(0.97);
        }

    </style>
    <!--css2-->

    <!--js1-->

    <!--head-tags-->
    <!--glob-styles-->
    <style id="site_styles_text" type="text/css">
        .blk_text .blk-data,
        .blk_text .blk-data h1,
        .blk_text .blk-data h2,
        .blk_text .blk-data h3,
        .blk_text .blk-data h4,
        .blk_text .blk-data h5,
        .blk_text .blk-data h6,
        .blk_text .blk-data p,
        .blk_text .blk-data a {
        }
        /* к формам применяем только шрифт */
        .user_form .header_description,
        .user_form .field .label_wrap,
        .user_form .field .field_wrap input,
        .user_form .field .field_wrap textarea,
        .user_form .field .field_wrap select,
        .user_form .header_text {

        }
    </style>
    <style id="site_styles_buttons" type="text/css">
        .blk_form .blk_form_wrap.is_popover .btn-new,
        .user_form_submit .btn-new,
        .blk_button_data_wrap .btn-new {
        ; font-family: Open Sans; font-weight: 300; font-style: normal;font-size:20px;color:#FFFFFF;padding:10px 20px;background:#2084d6;border:none;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;    }
    </style>
    <style type="text/css">
    </style>
    <style type="text/css">
        .ui-widget{
            z-index: 1111!important;
        }
        .jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;
            background: rgba(0, 0, 0, 0.6);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}  .jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style>


    <?php $this->head() ?>

</head>
<body class="action_preview sprint3 sprint5">
<?php $this->beginBody() ?>


<?=$this->render("//common/flash-message")?>


<?= $content ?>




<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
