<?php

namespace app\modules\api\models;

use app\models\Status as BaseStatus;

/**
 * Класс Status
 *
 * @package app\modules\api\models
 * @author  Марунин Алексей
 * @since   1.0
 */
class Status extends BaseStatus
{
    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'title',
            'order',
        ];
    }
}
