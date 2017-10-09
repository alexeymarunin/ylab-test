<?php

namespace app\models;

use app\models\query\StatusQuery;
use app\models\query\TaskQuery;
use app\models\query\UserQuery;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use Yii;

/**
 * Класс Task
 *
 * @package app\models
 * @author  Марунин Алексей
 * @since   1.0
 *
 * @property int $id
 * @property string $title
 * @property string $desc
 * @property string $due_date
 * @property int $status_id
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Status $status
 * @property string $statusTitle
 * @property User $author
 * @property string $authorName
 */
class Task extends ActiveRecord
{
    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return TaskQuery
     *
     * @throws InvalidConfigException
     */
    public static function find()
    {
        return Yii::createObject( TaskQuery::className(), [ static::className() ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestampBehavior' => 'yii\behaviors\TimestampBehavior',
            'blameableBehavior' => 'yii\behaviors\BlameableBehavior',
        ];
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
            [ 'desc', 'required' ],
            [ 'desc', 'string', 'max' => 4000 ],
            [ 'due_date', 'date', 'format' => 'php:Y-m-d' ],
            [ 'status_id', 'integer' ],
            [ 'status_id', 'exist', 'targetClass' => Status::className(), 'targetAttribute' => 'id' ],
        ];
    }

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
     * @return string
     */
    public function getStatusTitle()
    {
        return $this->getStatus()->exists() ? $this->status->title : '<неизвестно>';
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return UserQuery
     */
    public function getAuthor()
    {
        return $this->hasOne( User::className(), [ 'id' => 'created_by' ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return string
     */
    public function getAuthorName()
    {
        return $this->getAuthor()->exists() ? $this->author->fullName : '<неизвестно>';
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
            'id'          => 'ID',
            'title'       => 'Название',
            'desc'        => 'Описание',
            'due_date'    => 'Срок выполнения',
            'created_at'  => 'Создана',
            'updated_at'  => 'Изменена',
            'created_by'  => 'Автор',
            'authorName'  => 'Автор',
            'status_id'   => 'Статус',
            'statusTitle' => 'Статус',
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
        return '{{%tasks}}';
    }
}
