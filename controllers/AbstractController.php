<?php

namespace app\controllers;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;

/**
 * Класс AbstractController
 *
 * @package app\controllers
 * @author  Марунин Алексей
 * @since   1.0
 */
class AbstractController extends Controller
{

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param $text
     */
    public function successFlash( $text )
    {
        Yii::$app->getSession()->setFlash( 'success', $text );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param $text
     */
    public function dangerFlash( $text )
    {
        Yii::$app->getSession()->setFlash( 'danger', $text );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @param $text
     */
    public function infoFlash( $text )
    {
        Yii::$app->getSession()->setFlash( 'info', $text );
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['accessBehavior'] = ArrayHelper::merge( [ 'class' => 'yii\filters\AccessControl' ], $this->accessBehavior() );

        return $behaviors;
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return array
     */
    public function accessBehavior()
    {
        $rules = $this->accessRules();
        return empty( $rules ) ? [] : [ 'rules' => $rules ];
    }

    /**
     * @author  Марунин Алексей
     * @since   1.0
     *
     * @return array
     */
    public function accessRules()
    {
        return [];
    }

}
