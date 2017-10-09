<?php

require '_aliases.php';

return [
    'name'           => env( 'APP_NAME' ),
    'version'        => '1.0',
    'basePath'       => dirname( __DIR__ ),
    'vendorPath'     => __DIR__ . '/../vendor',
    'extensions'     => require( __DIR__ . '/../vendor/yiisoft/extensions.php' ),
    'language'       => 'ru-RU',
    'sourceLanguage' => 'ru',
    'timeZone'       => 'Europe/Moscow',

    // Компоненты
    'components'     => [

        'db' => [
            'class'    => 'yii\db\Connection',
            'dsn'     => 'sqlite:' . realpath( __DIR__ . '/../runtime/data.db' ),
//            'dsn'      => 'sqlsrv:Server=GALOSH\SQLEXPRESS;Database=test',
//            'username' => 'test',
//            'password' => '1234',
            'charset'  => 'utf8',
        ],

        'formatter' => [
            'class'             => 'yii\i18n\Formatter',
            'nullDisplay'       => '',
            'dateFormat'        => 'php:d.m.Y',
            'thousandSeparator' => '',
            'decimalSeparator'  => '.',
        ],

    ],

    // Дополнительные параметры
    'params'         => [
        'adminEmail' => env( 'ADMIN_EMAIL' ),
    ],

];