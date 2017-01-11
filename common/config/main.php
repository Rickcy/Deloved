<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'en-US',
    'components' => [
        'i18n' => [
        'translations' => [
            'app*' => [
                'class' =>'yii\i18n\PhpMessageSource',
               // 'basePath' => '@app/messages',
//                'sourceLanguage' => 'en-US',
                'fileMap' => [
                    'app'       => 'app.php',
                    'app/error' => 'error.php',
                ],
            ],
        ],
    ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=deloved',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'urlManager'=>[
            'class'=>'yii\web\UrlManager',
            'enablePrettyUrl'=>true,
            'showScriptName'=>false
        ]

    ],
];
