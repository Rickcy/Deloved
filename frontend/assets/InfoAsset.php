<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 12.09.17
 * Time: 13:44
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class InfoAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/info.css'
    ];

    public $js = [
        'js/info.js'
    ];

    public $depends =[
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}