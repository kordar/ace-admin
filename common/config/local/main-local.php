<?php
return [
    'components' => [
        'ace' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=192.168.0.108;port=3307;dbname=ace',
            'username' => 'root',
            'password' => 'k1338945dh@#',
            'charset' => 'utf8',
            'tablePrefix' => 'ace_'
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=192.168.0.108;port=3307;dbname=233wan',
            'username' => 'root',
            'password' => 'k1338945dh@#',
            'charset' => 'utf8',
            'tablePrefix' => 'wan_'
        ],
        /*
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        */
    ],
];
