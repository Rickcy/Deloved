<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Admin bundle
 **/
class DemoAdminAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/dealChat.css',
        'css/admin.css',
        'css/flash-alerts.css',
        'css/style.min.css',
    ];
    public $js = [
        'js/demo-admin.js',
        'js/jstree/jstree.min.js',
        'js/jstree/misc.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'frontend\assets\mCustomScrollbar'
    ];

    public $jsOptions = [
        'position'=> View::POS_HEAD
    ];
}