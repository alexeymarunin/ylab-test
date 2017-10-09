<?php

namespace app\helpers;

use yii\bootstrap\Html as BaseHtml;
use rmrevin\yii\fontawesome\FA;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Класс Html
 *
 * @package app\helpers
 * @author  Марунин Алексей
 * @since   1.0
 */
class Html extends BaseHtml
{
    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $text
     * @param bool $visible
     * @param string $url
     *
     * @return string
     */
    public static function createButton( $text = 'Добавить', $visible = true, $url = 'create' )
    {
        $action = ( is_array( $url ) ? $url : [ $url ] );
        $button = static::a( FA::i( FA::_PLUS_CIRCLE ) . ' ' . $text, Url::to( $action ), [ 'class' => 'btn btn-success' ] );

        return ( $visible ? static::tag( 'span', $button ) : '' );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $title
     * @param ActiveRecord $model
     * @param string $url
     *
     * @return string
     */
    public static function viewButton( $title, $model, $url = 'view' )
    {
        return static::a( FA::i( FA::_FOLDER_OPEN ), [ $url, 'id' => $model->id ], [
            'class'      => 'btn btn-xs btn-default',
            'title'      => $title,
            'aria-label' => $title,
            'data-pjax'  => '0',
        ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $title
     * @param ActiveRecord $model
     * @param string $url
     *
     * @return string
     */
    public static function updateButton( $title, $model, $url = 'update' )
    {
        return static::a( FA::i( FA::_PENCIL ), [ $url, 'id' => $model->id ], [
            'class'      => 'btn btn-xs btn-primary',
            'title'      => $title,
            'aria-label' => $title,
            'data-pjax'  => '0',
        ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $confirm
     * @param ActiveRecord $model
     * @param string $url
     *
     * @return string
     */
    public static function deleteButton( $confirm, $model, $url = 'delete' )
    {
        return static::a( FA::i( FA::_TIMES ), [ $url, 'id' => $model->id ], [
            'class'        => 'btn btn-xs btn-danger',
            'data-confirm' => $confirm,
            'data-method'  => 'post',
        ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $icon
     * @param array $options
     *
     * @return string
     */
    public static function icon( $icon, $options = [ ] )
    {
        return FA::i( $icon, $options );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $text
     * @param array|string|null $url
     * @param array $options
     *
     * @return string
     */
    public static function external( $text, $url = null, $options = [ ] )
    {
        $icon = ' ' . static::icon( 'external-link' );

        return $text ? static::a( $text . $icon, $url, ArrayHelper::merge( [ 'class' => 'external-link', 'target' => '_blank' ], $options ) ) : '';
    }
}
