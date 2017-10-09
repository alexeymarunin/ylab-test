<?php

/**
 * Загружаем переменные окружения
 */
$env = new \Dotenv\Dotenv( dirname( __DIR__ ) );
$env->load();

// Проверяем наличие необходимых переменных
$env->required( 'APP_NAME' )->notEmpty();
$env->required( 'APP_DOMAIN' )->notEmpty();
$env->required( 'COOKIE_VALIDATION_KEY' )->notEmpty();

if ( !function_exists( 'env' ) ) {
    // Вспомогательная функция
    function env( $name, $default = null )
    {
        $value = getenv( $name );

        if ( $value === false ) {
            return $default;
        }

        switch ( strtolower( $value ) ) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;
        }

        return $value;
    }

}

defined( 'YII_DEBUG' ) or define( 'YII_DEBUG', env( 'YII_DEBUG' ), true );
defined( 'YII_ENV' ) or define( 'YII_ENV', env( 'YII_ENV', 'dev' ) );

