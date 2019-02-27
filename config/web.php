<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$route = require __DIR__ . '/route.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => "Asia/Shanghai",
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '21f2ce8b33fadbda0c2a8f69f3dfc054',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => $route,
        'queue' =>
        [
            'class' => 'shmilyzxt\queue\queues\DatabaseQueue',//队列使用的类
            'jobEvent' =>
            [//队列任务时间配置,目前任务支持2个事件
                'on beforeExecute' => ['shmilyzxt\queue\base\JobEventHandler','beforeExecute'],
                'on beforeDelete' => ['shmilyzxt\queue\base\JobEventHandler','beforeDelete']
            ],
            'connector' => $db, //队列中间件链接器配置
            'table' => 'jobs', //存储队列数据表名
            'queue' => 'default', //队列名称
            'expire' => 60,//任务过期时间
            'maxJob' => 0,//队列允许最大任务数,0为不限制
            'failed' =>
            [//任务失败日志记录(目前只支持记录到数据库)
                'logFail' => true, //开启任务失败处理
                'provider' =>
                [
                    'class' => 'shmilyzxt\queue\failed\DatabaseFailedProvider',
                    'db' => $db
                ],
                'table' => 'failed_jobs' //存储失败日志的表名
            ]
        ]
    ],
    'params' => $params,
    'modules' => [
        'web' => [
            'class' => 'app\modules\web\WebModule',
        ],
        'm' => [
            'class' => 'app\modules\m\MModule',
        ],
        'weixin' => [
            'class' => 'app\modules\weixin\WeixinModule',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
