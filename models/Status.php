<?php

namespace app\models;

use app\models\query\StatusQuery;
use app\models\query\TaskQuery;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use Yii;

/**
 * Класс Status
 *
 * @package app\models
 * @author  Марунин Алексей
 * @since   1.0
 *
 * @property int $id
 * @property string $title
 * @property int $order
 *
 * @property Task[] $tasks
 */
class Status extends ActiveRecord
{
    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return StatusQuery
     *
     * @throws InvalidConfigException
     */
    public static function find()
    {
        return Yii::createObject( StatusQuery::className(), [ static::className() ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return array
     */
    public function rules()
    {
        return [
            [ 'title', 'required' ],
            [ 'title', 'string', 'max' => 255 ],
            [ 'order', 'integer' ],
        ];
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return TaskQuery
     */
    public function getTasks()
    {
        return $this->hasMany( Task::className(), [ 'status_id' => 'id' ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'title' => 'Название',
            'order' => 'Сортировка',
        ];
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return string
     */
    public static function tableName()
    {
        return '{{%statuses}}';
    }
}
