<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.min.css',
        'css/front.css',
        'css/login.css',
        'css/bottom_menu.css',
        'css/flash-alerts.css'
    ];
    public $js = [

        'js/jstree/jstree.min.js',
        'js/jstree/misc.js',
        'js/front.js'

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
