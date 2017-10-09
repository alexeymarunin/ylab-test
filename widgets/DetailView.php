<?php

namespace app\widgets;

use kartik\detail\DetailView as BaseDetailView;
use rmrevin\yii\fontawesome\FA;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Класс DetailView
 *
 * @package app\widgets
 * @author  Марунин Алексей
 * @since   1.0
 */
class DetailView extends BaseDetailView
{
    public $formClass = '\kartik\form\ActiveForm';
    
    /** @var string */
    public $headingTitle = false;

    /** @var string */
    public $mainTemplate = '{detail}<div class="col-xs-12">{buttons}</div>';

    /** @var string */
    public $buttons1 = '{update} {cancel}';
    public $buttons2 = '{save} {cancel}';

    public $cancelOptions = [ ];

    /**
     * @author  Марунин Алексей
     * @since   1.0
     */
    public function init()
    {
        $this->panel = ArrayHelper::merge([
            'type'           => self::TYPE_ACTIVE,
            'heading'        => $this->headingTitle,
            'headingOptions' => [
                'template' => '{title}',
            ],
        ], $this->panel );

        $this->buttonContainer = [
            'class' => '',
        ];

        $isNewRecord = ( $this->model instanceof ActiveRecord ? $this->model->isNewRecord : false );
        $this->updateOptions = ArrayHelper::merge( [
            'label' => FA::i( 'gears' ) . ' Изменить',
            'url'   => Url::to( [ 'update', 'id' => $this->model->id ] ),
            'class' => 'btn btn-primary',
        ], $this->updateOptions );
        $this->saveOptions = ArrayHelper::merge( [
            'label' => FA::i( 'check' ) . ' ' . ( $isNewRecord ? 'Создать' : 'Сохранить' ),
            'class' => 'btn btn-success',
        ], $this->saveOptions );
        $this->cancelOptions = ArrayHelper::merge( [
            'label' => FA::i( 'reply' ) . ' Отменить',
            'title' => 'Отменить',
            'url'   => Url::previous(),
            'class' => 'btn btn-default',
        ], $this->cancelOptions );

        parent::init();
    }

    protected function renderButtons( $mode = 1 )
    {
        $buttons = "buttons{$mode}";

        return strtr(
            $this->$buttons,
            [
                '{view}'   => $this->renderButton( 'view' ),
                '{update}' => $this->renderButton( 'update' ),
                '{delete}' => $this->renderButton( 'delete' ),
                '{save}'   => $this->renderButton( 'save' ),
                '{reset}'  => $this->renderButton( 'reset' ),
                '{cancel}' => $this->renderButton( 'cancel' ),
            ]
        );
    }

    /**
     * Renders a button
     *
     * @param string $type the button type
     *
     * @return string
     */
    protected function renderButton( $type )
    {
        if ( !$this->enableEditMode ) {
            return '';
        }
        switch ( $type ) {
            case 'update':
                return $this->getCustomButton( 'update', 'gear', 'Изменить' );
            case 'cancel':
                return $this->getCustomButton( 'cancel', 'replay', 'Отмена' );
            default:
                return parent::renderButton( $type );
        }
    }

    protected function getCustomButton( $type, $icon, $title )
    {
        $buttonOptions = $type . 'Options';
        $options = $this->$buttonOptions;
        $label = ArrayHelper::remove( $options, 'label', FA::i( $icon ) );
        if ( empty( $options[ 'class' ] ) ) {
            $options[ 'class' ] = 'kv-action-btn';
        }
        Html::addCssClass( $options, 'kv-btn-' . $type );
        $options = ArrayHelper::merge( [ 'title' => $title ], $options );
        if ( $this->tooltips ) {
            $options[ 'data-toggle' ] = 'tooltip';
            $options[ 'data-container' ] = 'body';
        }
        $url = ArrayHelper::remove( $options, 'url', '#' );

        return Html::a( $label, $url, $options );
    }
    
    
}

