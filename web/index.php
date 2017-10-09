<?php

if ( file_exists( '.maintenance' ) ) {
    header( 'HTTP/1.0 503 Service Unavailable', true ,503 );
    header( 'Retry-After: 3600' );
}

// Composer
require( __DIR__ . '/../vendor/autoload.php' );

// Environment
require( __DIR__ . '/../config/env.php' );

// Yii
require( __DIR__ . '/../vendor/yiisoft/yii2/Yii.php' );

( new yii\web\Application(
    \yii\helpers\ArrayHelper::merge(
        require( __DIR__ . '/../config/base.php' ),
        require( __DIR__ . '/../config/web.php' )
    )
) )->run();
