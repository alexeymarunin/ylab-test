<?php

namespace app\controllers;

use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\base\InvalidConfigException;
use Yii;

/**
 * Класс UserController
 *
 * @package app\controllers
 * @author  Марунин Алексей
 * @since   1.0
 */
class UserController extends AbstractController
{
    const ACTION_INDEX  = 'index';
    const ACTION_VIEW   = 'view';
    const ACTION_CREATE = 'create';
    const ACTION_UPDATE = 'update';
    const ACTION_DELETE = 'delete';

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return string
     * @throws InvalidConfigException
     */
    public function actionIndex()
    {
        Url::remember();

        $query = User::find();

        $dataProvider = Yii::createObject( [
            'class' => ActiveDataProvider::className(),
            'query' => $query,
        ] );

        return $this->render( 'index', [
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *          
     * @param int $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView( $id )
    {
        /** @var User $model */
        $model = User::findOne( $id );

        if ( !$model ) {
            throw new NotFoundHttpException( 'Пользователь не найден' );
        }

        return $this->render( 'view', [
            'model' => $model,
        ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return string|Response
     * @throws InvalidConfigException
     */
    public function actionCreate()
    {
        /** @var User $model */
        $model = Yii::createObject( User::className() );

        if ( $model->load( Yii::$app->request->post() ) && $model->validate() ) {
            $model->save( false );
            $this->successFlash( 'Создан новый пользователь' );

            return $this->redirect( [ 'view', 'id' => $model->id ] );
        }

        return $this->render( 'create', [
            'model' => $model,
        ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     * @param int $id
     *
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate( $id )
    {
        /** @var User $model */
        $model = User::findOne( $id );

        if ( !$model ) {
            throw new NotFoundHttpException( 'Пользователь не найден' );
        }

        if ( $model->load( Yii::$app->request->post() ) && $model->validate() ) {
            $model->save( false );
            $this->successFlash( 'Пользователь успешно изменен' );

            return $this->redirect( [ 'view', 'id' => $model->id ] );
        }

        return $this->render( 'update', [
            'model' => $model,
        ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param int $id
     *
     * @return Response
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws \Throwable
     */
    public function actionDelete( $id )
    {

        /** @var User $model */
        $model = User::findOne( $id );

        if ( !$model ) {
            throw new NotFoundHttpException( 'Пользователь не найден' );
        }

        $model->delete();

        $this->successFlash( 'Пользователь удален' );

        return $this->goBack();
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
                'roles'   => [ '@' ],
                'actions' => [
                    static::ACTION_INDEX,
                    static::ACTION_VIEW,
                    static::ACTION_CREATE,
                    static::ACTION_UPDATE,
                    static::ACTION_DELETE,
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
            static::ACTION_INDEX  => [ 'GET' ],
            static::ACTION_VIEW   => [ 'GET' ],
            static::ACTION_CREATE => [ 'GET', 'POST' ],
            static::ACTION_UPDATE => [ 'GET', 'POST' ],
            static::ACTION_DELETE => [ 'POST' ],
        ];
    }


}
