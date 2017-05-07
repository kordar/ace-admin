<?php
return [

    // 入口ID
    'id' => 'app-backend',
    // 语言
    'language' => 'zh-CN',
    // 布局文件
    'layoutPath' => '@acedir/layouts',
    //
    'bootstrap' => ['log'],

    'components' => [

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'db' => 'ace'
        ],

        'assetManager' => [
            'appendTimestamp' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => '@aceassets',
                    'js' => [
                        ['js/jquery-2.1.4.min.js', 'condition'=>'!IE'],
                        ['js/jquery-1.11.3.min.js', 'condition'=>'IE'],
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@aceassets',
                    'css' => [
                        'css/bootstrap.min.css'
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@aceassets',
                    'js' => [
                        'js/bootstrap.min.js'
                    ]
                ],
            ],
        ],

        'request' => [
            'csrfParam' => '_csrf-backend',
        ],

        'user' => [
            'identityClass' => 'kordar\ace\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],

        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'ace-admin',
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

    ],
];