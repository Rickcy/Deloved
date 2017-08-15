<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 13.08.17
 * Time: 22:37
 */

namespace frontend\assets;


use yii\web\AssetBundle;
use yii\web\View;

class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/login.css',
        'css/bottom_menu.css',
        'css/main/style_view.css',
        'css/main/module_button_up.css',
        'css/main/css.css',
        'css/main/css(1).css',
        'css/main/css(2).css',
        'css/main/css(3).css',
        'css/main/css(4).css',
        'css/main/css(5).css',
        'css/main/sites.css',
    ];
    public $js = [
        'js/main/module_button_up.js',
        'js/main/module_micro_animation.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $jsOptions = [
        'position'=> View::POS_HEAD
    ];
}