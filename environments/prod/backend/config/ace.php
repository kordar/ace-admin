<?php
return [

    'id' => 'ace-admin',
    'basePath' => dirname(__DIR__),
    'language' => 'zh-CN',
    'controllerNamespace' => 'ace\controllers',
    'layoutPath' => '@kordar/layouts',
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
                    'sourcePath' => '@kordar/yii2-ace/src/assets/ace/assets',
                    'js' => [
                        ['js/jquery-2.1.4.min.js', 'condition'=>'!IE'],
                        ['js/jquery-1.11.3.min.js', 'condition'=>'IE'],
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@kordar/yii2-ace/src/assets/ace/assets',
                    'css' => [
                        'css/bootstrap.min.css'
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@kordar/yii2-ace/src/assets/ace/assets',
                    'js' => [
                        'js/bootstrap.min.js'
                    ]
                ],
            ],
        ],

        'request' => [
            'csrfParam' => '_csrf-ace',
        ],
        'user' => [
            'identityClass' => 'kordar\ace\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-ace', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'enableStrictParsing' => true,
            'rules' => $rules
        ],

    ],
];