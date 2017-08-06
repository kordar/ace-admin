<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/local/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/local/params-local.php')
);

return [

    'id' => 'backend',    # 入口ID
    'language' => 'zh-CN',  # 语言
    'layoutPath' => '@acedir/layouts',  # 布局文件
    'basePath' => dirname(__DIR__),

    'controllerNamespace' => 'backend\controllers',

    'modules' => [
        'basis' => [
            'class' => 'backend\modules\basis\Module',
        ],
        'rbac' => [
            'class' => 'backend\modules\rbac\Module',
        ],
        'news' => [
            'class' => 'backend\modules\news\Module',
        ],
        'parts' => [
            'class' => 'backend\modules\parts\Module',
        ],
    ],

    // 组件管理器默认配置
    'components' => [

        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@cache',
        ],

        ## rbac认证管理
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'db' => 'ace',
            'itemTable'=>'{{%auth_item}}',
            'itemChildTable'=>'{{%auth_item_child}}',
            'assignmentTable'=>'{{%auth_assignment}}',
            'ruleTable'=>'{{%auth_rule}}',
        ],

        ## 前端资源布局管理
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

        ## csrf 配置
        'request' => [
            'csrfParam' => '_csrf-ace-admin',
        ],

        # 用户登录认证管理
        'user' => [
            'identityClass' => 'kordar\ace\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-ace-admin', 'httpOnly' => true],
        ],

        # session 基本配置
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'ace-admin',
        ],

        # 错误句柄配置
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'enableStrictParsing' => false,
            'rules' => [
                '/' => 'site/index',
                'login' => 'site/login',
                'logout' => 'site/logout',
                'forgot' => 'site/request-password-reset',
                'signup' => 'site/signup',
                // 后台菜单
               '<modules>/<controller>/<action>' => '<modules>/<controller>/<action>',
               // '<controller>/<action>' => 'rbac/<controller>/<action>',
               //'<controller>/<action>' => 'news/<controller>/<action>',
              // '<controller>/<action>' => 'parts/<controller>/<action>',
            ]
        ],
    ],

    'params' => $params,
];
