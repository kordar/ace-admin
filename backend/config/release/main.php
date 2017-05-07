<?php
$params = array_merge(
    require(__DIR__ . '/../../../common/config/params.php'),
    require(__DIR__ . '/../../../common/config/params-local.php'),
    require(__DIR__ . '/../release/params.php'),
    require(__DIR__ . '/../local/params-local.php')
);

return [

    'basePath' => dirname(dirname(__DIR__)),

    'controllerNamespace' => 'backend\controllers',

    'modules' => [
        'basis' => [
            'class' => 'backend\modules\basis\Module',
        ],
    ],

    'components' => [

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'suffix' => '.html',
            'enableStrictParsing' => true,
            'rules' => [
                '/' => 'site/index',
                'login' => 'site/login',
                'logout' => 'site/logout',
                'forgot' => 'site/request-password-reset',
                'signup' => 'site/signup',
                // 后台菜单
                'menu' => 'basis/sidebar/index',
                'menu/create' => 'basis/sidebar/create',
                'menu/delete' => 'basis/sidebar/delete',
                'menu/view' => 'basis/sidebar/view',
                'menu/update' => 'basis/sidebar/update',

                'debug/<controller>/<action>' => 'debug/<controller>/<action>',
            ]
        ],
    ],
    'params' => $params,
];
