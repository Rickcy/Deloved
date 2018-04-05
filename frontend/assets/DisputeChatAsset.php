<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 25.08.17
 * Time: 15:24
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class DisputeChatAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
    ];
    public $js = [
        'js/disputeChat.js'
    ];

    public $depends = [
        'frontend\assets\mCustomScrollbar'
    ];
}