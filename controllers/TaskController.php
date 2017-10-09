<?php

namespace app\controllers;

use app\models\Status;
use app\models\Task;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\web\UnprocessableEntityHttpException;
use yii\helpers\Url;
use yii\base\InvalidConfigException;
use Yii;

/**
 * Класс TaskController
 *
 * @package app\controllers
 * @author  Марунин Алексей
 * @since   1.0
 */
class TaskController extends AbstractController
{
    const ACTION_INDEX         = 'index';
    const ACTION_VIEW          = 'view';
    const ACTION_CREATE        = 'create';
    const ACTION_UPDATE        = 'update';
    const ACTION_CHANGE_STATUS = 'change-status';
    const ACTION_DELETE        = 'delete';

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

        $query = Task::find();

        $dataProvider = Yii::createObject( [
            'class' => ActiveDataProvider::className(),
            'query' => $query,
        ] );

        $statuses = $this->getStatuses();

        return $this->render( 'index', [
            'dataProvider' => $dataProvider,
            'statuses'     => $statuses,
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
        /** @var Task $model */
        $model = Task::findOne( $id );

        if ( !$model ) {
            throw new NotFoundHttpException( 'Задача не найдена' );
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
        /** @var Task $model */
        $model = Yii::createObject( Task::className() );

        if ( $model->load( Yii::$app->request->post() ) && $model->validate() ) {
            $model->save( false );
            $this->successFlash( 'Создана новая задача' );

            return $this->redirect( [ 'view', 'id' => $model->id ] );
        }

        $statuses = $this->getStatuses();

        return $this->render( 'create', [
            'model'    => $model,
            'statuses' => $statuses,
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
        /** @var Task $model */
        $model = Task::findOne( $id );

        if ( !$model ) {
            throw new NotFoundHttpException( 'Задача не найдена' );
        }

        if ( $model->load( Yii::$app->request->post() ) && $model->validate() ) {
            $model->save( false );
            $this->successFlash( 'Задача успешно изменена' );

            return $this->redirect( [ 'view', 'id' => $model->id ] );
        }

        $statuses = $this->getStatuses();

        return $this->render( 'update', [
            'model'    => $model,
            'statuses' => $statuses,
        ] );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param int $id
     *
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionChangeStatus( $id )
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        /** @var Task $model */
        $model = Task::findOne( $id );

        if ( !$model ) {
            throw new NotFoundHttpException( 'Задача не найдена' );
        }

        if ( $model->load( Yii::$app->request->post(), '' ) && $model->validate() ) {
            $model->save( false );
        }

        return [ 'id' => $model->id, 'status_id' => $model->status_id ];
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

        /** @var Task $model */
        $model = Task::findOne( $id );

        if ( !$model ) {
            throw new NotFoundHttpException( 'Задача не найдена' );
        }

        $model->delete();

        $this->successFlash( 'Задача удалена' );

        return $this->goBack();
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return array
     */
    protected function getStatuses()
    {
        $statuses = Status::find()->orderByTitle()->asArray()->all();

        return ArrayHelper::map( $statuses, 'id', 'title' );
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
                    static::ACTION_CHANGE_STATUS,
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
            static::ACTION_INDEX         => [ 'GET' ],
            static::ACTION_VIEW          => [ 'GET' ],
            static::ACTION_CREATE        => [ 'GET', 'POST' ],
            static::ACTION_UPDATE        => [ 'GET', 'POST' ],
            static::ACTION_CHANGE_STATUS => [ 'POST' ],
            static::ACTION_DELETE        => [ 'POST' ],
        ];
    }


}
