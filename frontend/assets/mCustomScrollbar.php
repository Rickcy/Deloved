<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 25.08.17
 * Time: 15:19
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class mCustomScrollbar extends AssetBundle
{
    public $sourcePath = '@bower/malihu-custom-scrollbar-plugin';
    public $baseUrl = '@web';

    public $css = [
        'jquery.mCustomScrollbar.css',
    ];

    public $js = [
        'jquery.mCustomScrollbar.concat.min.js',
        'jquery.mCustomScrollbar.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}