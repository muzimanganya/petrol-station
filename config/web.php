<?php

use app\components\Formatter;
use app\models\User;
use yii\filters\AccessControl;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'en',
    'bootstrap' => ['languagepicker'],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'api' => [
            'class' => 'app\modules\api\Module',
        ],
        'gridview' => ['class' => 'kartik\grid\Module']
    ],
    'components' => [
        'formatter' => [
            'class' => Formatter::class
        ],
        'languagepicker' => [
            'class' => 'lajax\languagepicker\Component',
            // List of available languages (icons only)
            'languages' => ['en' => 'English', 'fr' => 'Français'],
            'callback' => function () {
                if (!\Yii::$app->user->isGuest) {
                    User::updateAll(['lang' => Yii::$app->language], ['id' => Yii::$app->user->id]);
                }
            }
        ],
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
    'as access' => [
        'class' => AccessControl::class,
        'except' => ['api/*', 'site/error', 'site/login'],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ]
        ]
    ],
    'on beforeAction' => function ($event) {
        $lang = Yii::$app->user->identity->lang ?? 'en';
        Yii::$app->language = $lang;
    }
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
