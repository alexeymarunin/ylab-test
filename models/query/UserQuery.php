<?php

namespace app\models\query;

use yii\db\ActiveQuery;

/**
 * Класс UserQuery
 *
 * @package app\models\query
 * @author  Марунин Алексей
 * @since   1.0
 *
 * @see     \app\models\User
 */
class UserQuery extends ActiveQuery
{
    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param int $id
     *
     * @return UserQuery
     */
    public function andWhereId( $id )
    {
        return $this->andWhere( [ 'id' => $id ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $hash
     *
     * @return UserQuery
     */
    public function andWhereHash( $hash )
    {
        return $this->andWhere( [ 'hashed_password' => $hash ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $login
     *
     * @return UserQuery
     */
    public function andWhereLogin( $login )
    {
        return $this->andWhere( [ 'login' => $login ] );
    }
}
