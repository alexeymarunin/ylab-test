<?php

namespace app\models\query;

use yii\db\ActiveQuery;

/**
 * Класс StatusQuery
 *
 * @package app\models\query
 * @author  Марунин Алексей
 * @since   1.0
 *
 * @see     \app\models\Status
 */
class StatusQuery extends ActiveQuery
{
    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param int $sort
     *
     * @return StatusQuery
     */
    public function orderByTitle( $sort = SORT_ASC )
    {
        return $this->orderBy( [ 'title' => $sort ] );
    }
}
