<?php

namespace app\controllers;

use app\models\form\LoginForm;
use yii\web\Response;
use Yii;

/**
 * Класс AuthController
 *
 * @package app\controllers
 * @author  Марунин Алексей
 * @since   1.0
 */
class AuthController extends AbstractController
{
    const ACTION_LOGIN  = 'login';
    const ACTION_LOGOUT = 'logout';


    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        $this->layout = 'main-login';

        $data = Yii::$app->request->post();
        $model = new LoginForm();

        if ( $model->load( $data ) && $model->validate() ) {
            $duration = Yii::$app->params[ 'loginDuration' ] * 24 * 3600;
            Yii::$app->user->login( $model->getUser(), $duration );

            return $this->goBack();
        }
        else {
            return $this->render( 'login', [
                'model' => $model,
            ] );
        }
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return array
     */
    public function accessRules()
    {
        return [
            [
                'allow'   => true,
                'roles'   => [ '?' ],
                'actions' => [
                    static::ACTION_LOGIN,
                ],
            ],
            [
                'allow'   => true,
                'roles'   => [ '@' ],
                'actions' => [
                    static::ACTION_LOGOUT,
                ],
            ],
        ];
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return array
     */
    public function verbs()
    {
        return [
            static::ACTION_LOGIN  => [ 'POST' ],
            static::ACTION_LOGOUT => [ 'POST' ],
        ];
    }

}
