<?php

namespace app\models;

use app\models\query\TaskQuery;
use app\models\query\UserQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\InvalidConfigException;
use Yii;

/**
 * Класс User
 *
 * @package app\models
 * @author  Марунин Алексей
 * @since   1.0
 *
 * @property int $id
 * @property string $login
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $auth_key
 * @property string $hashed_password
 * @property int $created_at
 * @property int $updated_at
 *
 * @property string $fullName
 * @property Task[] $tasks
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $password;

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return UserQuery
     *
     * @throws InvalidConfigException
     */
    public static function find()
    {
        return Yii::createObject( UserQuery::className(), [ static::className() ] );
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
            'authKeyBehavior'   => [
                'class'      => 'yii\behaviors\AttributeBehavior',
                'attributes' => [ ActiveRecord::EVENT_BEFORE_INSERT => 'auth_key' ],
                'value'      => Yii::$app->getSecurity()->generateRandomString(),
            ],
            'passwordHashBehavior' => [
                'class'      => 'yii\behaviors\AttributeBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'hashed_password',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'hashed_password',
                ],
                'value'      => function( $event ) {
                    /** @var User $model */
                    $model = $event->sender;
                    if ( $model->password ) {
                        return Yii::$app->getSecurity()->generatePasswordHash( $model->password );
                    }
                    return $model->hashed_password;
                },
            ],
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
            [ 'login', 'required' ],
            [ 'login', 'string', 'max' => 32 ],
            [ 'login', 'unique' ],
            [ 'first_name', 'string', 'max' => 255 ],
            [ 'middle_name', 'string', 'max' => 255 ],
            [ 'last_name', 'string', 'max' => 255 ],
            [ 'password', 'string', 'min' => 4 ],
        ];
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return string
     */
    public function getFullName()
    {
        $parts = [ ];
        if ( $this->first_name ) {
            $parts[] = $this->first_name;
        }
        if ( $this->middle_name ) {
            $parts[] = $this->middle_name;
        }
        if ( $this->last_name ) {
            $parts[] = $this->last_name;
        }

        return implode( ' ', $parts );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return TaskQuery
     */
    public function getTasks()
    {
        return $this->hasMany( Task::className(), [ 'created_by' => 'id' ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'login'       => 'Логин',
            'password'    => 'Пароль',
            'first_name'  => 'Имя',
            'middle_name' => 'Отчество',
            'last_name'   => 'Фамилия',
            'fullName'    => 'ФИО',
            'created_at'  => 'Создан',
            'updated_at'  => 'Обновлен',
        ];
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @inheritdoc
     */
    public static function findIdentity( $id )
    {
        return static::find()->andWhereId( $id )->one();
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @inheritdoc
     */
    public static function findIdentityByAccessToken( $token, $type = null )
    {
        return static::find()->andWhereHash( $token )->one();
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @inheritdoc
     */
    public function validateAuthKey( $authKey )
    {
        return ( $this->getAuthKey() === $authKey );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return string
     */
    public static function generatePassword()
    {
        return Yii::$app->getSecurity()->generateRandomString( 8 );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $password
     *
     * @return bool
     */
    public function validatePassword( $password )
    {
        return Yii::$app->getSecurity()->validatePassword( $password, $this->hashed_password );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.1
     *
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

}
