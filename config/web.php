<?php

/**
 * Настройки веб-приложения
 */

return [
    'id'           => 'admin-app',
    'defaultRoute' => 'task/index',
    'homeUrl'      => Yii::getAlias( '@adminUrl' ),

    'components' => [

        'user' => [
            'class'           => 'yii\web\User',
            'identityClass'   => 'app\models\User',
            'loginUrl'        => [ 'auth/login' ],
            'enableAutoLogin' => true,
        ],

        'request' => [
            'cookieValidationKey' => env( 'COOKIE_VALIDATION_KEY' ),
        ],

        'assetManager' => [
            'class'           => 'yii\web\AssetManager',
            'linkAssets'      => env( 'LINK_ASSETS', true ),
            'appendTimestamp' => false,
            'bundles'         => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-purple',
                ],
            ],
        ],

        'urlManager' => [
            'class'           => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                [ 'pattern' => '/', 'route' => 'task/index' ],

                [ 'pattern' => '/login', 'route' => 'auth/login' ],
                [ 'pattern' => '/logout', 'route' => 'auth/logout' ],

                [ 'pattern' => '/users', 'route' => 'user/index' ],
                [ 'pattern' => '/statuses', 'route' => 'status/index' ],
                [ 'pattern' => '/tasks', 'route' => 'task/index' ],

                [ 'pattern' => '/api/tasks', 'route' => 'api/task/index' ],
                [ 'pattern' => '/api/task/<id:\d>', 'route' => 'api/task/view' ],
                [ 'pattern' => '/api/task/<id:\d>/change-status', 'route' => 'api/task/change-status' ],
            ],
        ],

        'log'   => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'   => 'yii\log\FileTarget',
                    'levels'  => [ 'error', 'warning' ],
                    'logFile' => '@runtime/logs/errors.log',
                    'logVars' => [ ],
                ],
                [
                    'class'   => 'yii\log\FileTarget',
                    'levels'  => [ 'info' ],
                    'logFile' => '@runtime/logs/debug.log',
                    'logVars' => [ ],
                ],
            ],
        ],

        // Кэш
        'cache' => [
            'class'     => 'yii\caching\FileCache',
            'cachePath' => '@runtime/cache',
        ],

    ],

    'modules' => [
        'api' => [
            'class' => '\app\modules\api\Module',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'debug'    => [
            'class'      => 'yii\debug\Module',
            'allowedIPs' => [ '127.0.0.1', '::1' ],
        ],
    ],

    'bootstrap' => [
        'log', 'debug',
    ],

    'params' => [
        // кол-во дней, в течение которых сохраняется пароль при входе
        'loginDuration'    => 15,
    ],
];
