<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'zh-CN',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'yanpei',
            'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/m/login',
        ],
        'account' => [
            'identityClass' => 'app\models\Account',
            'class' => 'yii\web\User',
            'enableAutoLogin' => true,
            'enableSession' => true,
            'loginUrl' => '/admin/default/login',
            'idParam' => '__account_id',
            'identityCookie' => ['name' => '_account_identity', 'httpOnly' => true],
            'authTimeoutParam' => '__account_expire',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mxhichina.com',
                'username' => 'customer-service@eting33.com',
                'password' => 'Yan2016pei',
                'port' => '25',
//                'encryption' => 'tls',
            ],
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'm/doctor/<id:\d+>' => 'm/doctor/info',
                'm/doctor/fav/<id:\d+>-<type:\d+>' => 'm/doctor/fav',
                'm/login' => 'm/user/login',
                'm/search/<keyword:\w+>' => 'm/doctor/search',
                'm/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'm/<controller>/<action>',
                'm/<controller:\w+>/<action:[\w-]+>/<keyword:\w+>' => 'm/<controller>/<action>',

                'admin/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'admin/<controller>/<action>',

                'doctor/search/<keyword:\w+>' => 'doctor/search',
                'product/list/<keyword:\w+>' => 'product/list',
                '<controller:\w+>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
        'redis' => [
            'class' => 'app\models\base\Redis',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 6,
            'keyPrefix' => 'yp',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],
    ],
    'params' => $params,
    'modules' => [
        'm' => [
            'class' => 'app\modules\mobile\Module',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@webroot/upload',
            'uploadUrl' => '/upload',
//            'language' => 'zh-CN',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
