<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        //        'ace' => [
        //            'class' => 'yii\db\Connection',
        //            'dsn' => 'mysql:host=192.168.153.128;dbname=ace',
        //            'username' => 'root',
        //            'password' => '',
        //            'charset' => 'utf8',
        //            'tablePrefix' => 'ace_'
        //        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // 'allowedIPs' => ['*']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // 'allowedIPs' => ['*']
    ];
}

return $config;
