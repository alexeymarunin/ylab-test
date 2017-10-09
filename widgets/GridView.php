<?php

namespace app\widgets;

use kartik\grid\GridView as BaseGridView;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Класс GridView
 *
 * @package app\widgets
 * @author  Марунин Алексей
 * @since   1.0
 */
class GridView extends BaseGridView
{
    /**
     * @var string
     */
    public $layout = '{toolbar} {items}';

    /**
     * @var bool
     */
    public $toggleData = false;

    /**
     * @var bool
     */
    public $striped = false;

    /**
     * @var bool
     */
    public $hover = true;


    /**
     * @author  Марунин Алексей
     * @since   1.0
     */
    public function init()
    {
        $this->exportConfig = ArrayHelper::merge( [ self::HTML => [], ], $this->exportConfig );

        return parent::init();
    }
}
