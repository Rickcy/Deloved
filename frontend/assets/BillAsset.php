<?php
/**
 * Created by PhpStorm.
 * User: marvel
 * Date: 21.09.17
 * Time: 16:27
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class BillAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/bill.css'
    ];
}