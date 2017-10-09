<?php

namespace app\modules\api\controllers;

use app\controllers\AbstractController;
use app\modules\api\models\Task;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\base\InvalidConfigException;
use Yii;


/**
 * Класс TaskController
 *
 * @package app\modules\api\controllers
 * @author  Марунин Алексей
 * @since   1.0
 */
class TaskController extends AbstractController
{
    const ACTION_INDEX = 'index';
    const ACTION_VIEW = 'view';
    const ACTION_CHANGE_STATUS = 'change-status';

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return string
     * @throws InvalidConfigException
     */
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $query = Task::find();

        /** @var ActiveDataProvider $dataProvider */
        $dataProvider = Yii::createObject( [
            'class' => ActiveDataProvider::className(),
            'query' => $query,
        ] );

        return $dataProvider->getModels();
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
        Yii::$app->response->format = Response::FORMAT_JSON;

        /** @var Task $model */
        $model = Task::findOne( $id );

        if ( !$model ) {
            throw new NotFoundHttpException( 'Задача не найдена' );
        }

        return $model;
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

        return $model;
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
                    static::ACTION_INDEX,
                    static::ACTION_VIEW,
                ],
            ],
            [
                'allow'   => true,
                'roles'   => [ '@' ],
                'actions' => [
                    static::ACTION_CHANGE_STATUS,
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
            static::ACTION_CHANGE_STATUS => [ 'POST' ],
        ];
    }

}
