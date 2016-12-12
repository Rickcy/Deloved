<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
    * Admin bundle
 **/
class AdminAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/admin.css',
        'css/flash-alerts.css'
    ];
    public $js = [
        'js/admin.js'
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