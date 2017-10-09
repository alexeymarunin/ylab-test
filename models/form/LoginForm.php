<?php

namespace app\models\form;

use app\models\User;
use yii\base\Model;
use Yii;

/**
 * Класс LoginForm
 *
 * @package app\models\form
 * @author  Марунин Алексей
 * @since   1.0
 */
class LoginForm extends Model
{
    /** @var string */
    public $username;

    /** @var string */
    public $password;

    /** @var bool */
    public $rememberMe = true;


    /**
     * @var User
     */
    protected $user;


    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'username', 'password' ], 'required' ],
            [ 'username', 'validateUser' ],
            [ 'password', 'validatePassword' ],
            [ 'rememberMe', 'boolean' ],
        ];
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $attribute
     */
    public function validateUser( $attribute )
    {
        if ( $this->hasErrors() ) return;

        $user = $this->getUser();
        if ( !$user ) {
            $this->addError( $attribute, 'Пользователь не найден' );
        }
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param string $attribute
     */
    public function validatePassword( $attribute )
    {
        if ( $this->hasErrors() ) return;

        $password = $this->$attribute;
        if ( !$this->getUser()->validatePassword( $password ) ) {
            $this->addError( $attribute, 'Неверный пароль' );
        }
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return User|null
     */
    public function getUser()
    {
        if ( !$this->user ) {
            $this->user = User::find()->andWhereLogin( $this->username )->one();
        }

        return $this->user;
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
            'username'   => 'Логин',
            'password'   => 'Пароль',
            'rememberMe' => 'Запомнить',
        ];
    }

}
