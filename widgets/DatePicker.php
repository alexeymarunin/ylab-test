<?php

namespace app\widgets;

use app\helpers\Html;
use app\models\base\TimeTrackActiveRecord;
use kartik\date\DatePicker as BaseDatePicker;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Класс DatePicker
 *
 * @package app\widgets
 * @author  Марунин Алексей
 * @since   1.0
 */
class DatePicker extends BaseDatePicker
{
    public $convertFormat = true;

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @inheritdoc
     */
    public function init()
    {
        if ( $this->type != static::TYPE_RANGE ) {
            $this->layout = '{picker}{input}{remove}';
        }
        $this->buttonOptions = ArrayHelper::merge( [
            'label' => Html::icon( 'calendar' ),
        ], $this->buttonOptions );

        $this->pluginOptions = ArrayHelper::merge( [
            'format'         => 'php:Y-m-d',
            'autoclose'      => true,
            'todayHighlight' => true,
        ], $this->pluginOptions );

        parent::init();
    }

    protected function renderAddon( &$options, $type = 'picker' )
    {
        if ( $options === false ) {
            return '';
        }
        if ( is_string( $options ) ) {
            return $options;
        }
        $icon = ( $type === 'picker' ) ? 'calendar' : 'remove';
        Html::addCssClass( $options, 'input-group-addon kv-date-' . $icon );
        $icon = Html::icon( ArrayHelper::remove( $options, 'icon', $icon ) );
        $title = ArrayHelper::getValue( $options, 'title', '' );
        if ( $title !== false && empty( $title ) ) {
            $options[ 'title' ] = ( $type === 'picker' ) ? Yii::t( 'kvdate', 'Select date' ) :
                Yii::t( 'kvdate', 'Clear field' );
        }

        return Html::tag( 'span', $icon, $options );
    }
}
