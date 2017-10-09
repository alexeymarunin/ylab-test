<?php

namespace app\modules\api\models;

use app\models\query\StatusQuery;
use app\models\Task as BaseTask;

/**
 * Класс Task
 *
 * @package app\modules\api\models
 * @author  Марунин Алексей
 * @since   1.0
 */
class Task extends BaseTask
{
    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return StatusQuery
     */
    public function getStatus()
    {
        return $this->hasOne( Status::className(), [ 'id' => 'status_id' ] );
    }

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
            'desc',
            'due_date',
            'created_at',
            'updated_at',
            'status',
            'author' => 'authorName',
        ];
    }
}
