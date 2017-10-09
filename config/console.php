<?php

/**
 * Настройки консольного приложения
 */

return [
    'id'   => 'console-app',

    'components' => [

        'log'   => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'   => 'yii\log\FileTarget',
                    'levels'  => [ 'error', 'warning' ],
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

    'bootstrap' => [
        'log',
    ],

    'controllerNamespace' => 'app\\commands',
];
