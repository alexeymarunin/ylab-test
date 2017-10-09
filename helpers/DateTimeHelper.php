<?php

namespace app\helpers;

use Yii;
use DateTime;
use DateTimeZone;

/**
 * Класс DateTimeHelper
 *
 * @package common\helpers
 * @author  Марунин Алексей
 * @since   1.0
 */
class DateTimeHelper
{
    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $value
     * @param string $timeZone
     *
     * @return int
     */
    public static function dateTimeToTimestamp( $value, $timeZone = null )
    {
        if ( $timeZone === null ) {
            $timeZone = Yii::$app->timeZone;
        }
        $datetime = new DateTime( $value, new DateTimeZone ( $timeZone ) );

        return $datetime->getTimestamp();
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param int $value
     * @param string $format
     * @param string $timeZone
     *
     * @return string
     */
    public static function timestampToDateTime( $value, $format = null, $timeZone = null )
    {
        if ( $format === null ) {
            $format = 'Y-m-d H:i:s';
        }

        if ( $timeZone === null ) {
            $timeZone = Yii::$app->timeZone;
        }

        $datetime = new DateTime( 'now', new DateTimeZone ( $timeZone ) );

        return $datetime->setTimestamp( $value )->format( $format );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $value
     * @param string $format
     * @param string $timeZone
     *
     * @return string|null
     */
    public static function normalizeDateTime( $value, $format = null, $timeZone = null )
    {
        if ( $value === null ) return $value;

        $timestamp = static::dateTimeToTimestamp( $value, $timeZone );
        return static::timestampToDateTime( $timestamp, $format, $timeZone );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.3
     *
     * @param string $date
     * @param string $format
     * @param string $timeZone
     *
     * @return string
     */
    public static function dayBefore( $date, $format = null, $timeZone = null )
    {
        if ( $date === null ) return $date;

        $timestamp = static::dateTimeToTimestamp( $date, $timeZone );
        $timestamp -= 24*3600;

        return static::timestampToDateTime( $timestamp, $format, $timeZone );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $date
     * @param string $format
     * @param string $timeZone
     *
     * @return string
     */
    public static function dayAfter( $date, $format = null, $timeZone = null )
    {
        if ( $date === null ) return $date;

        $timestamp = static::dateTimeToTimestamp( $date, $timeZone );
        $timestamp += 24*3600;

        return static::timestampToDateTime( $timestamp, $format, $timeZone );
    }

    /**
     * Возвращает разницу (в часах) между двумя датами
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $startDate
     * @param string $endDate
     *
     * @return int
     */
    public static function hoursDiff( $startDate, $endDate )
    {
        $startTimestamp = static::dateTimeToTimestamp( $startDate );
        $endTimestamp = static::dateTimeToTimestamp( $endDate );

        return intval( ( $endTimestamp - $startTimestamp ) / 3600 );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $date1
     * @param string $date2
     *
     * @return int
     */
    public static function compareDates( $date1, $date2 )
    {
        $timestamp1 = static::dateTimeToTimestamp( $date1 );
        $timestamp2 = static::dateTimeToTimestamp( $date2 );

        return ( $timestamp1 - $timestamp2 );
    }
}
