<?php

use app\helpers\Html;
use app\widgets\GridView;
use yii\web\View;
use yii\data\ActiveDataProvider;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Пользователи';
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="status-index">

    <?= Html::createButton( 'Добавить пользователя' ) ?>

    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'layout'       => '{items}{summary}{pager}',
        'tableOptions' => [
            'class' => 'table table-striped table-responsive table-hover table-bordered',
        ],
        'columns'      => [
            [
                'class'   => 'yii\grid\SerialColumn',
                'options' => [
                    'width' => '30px',
                ],
            ],

            [
                'attribute' => 'login',
            ],
            [
                'attribute' => 'fullName',
            ],

            [
                'class'          => 'yii\grid\ActionColumn',
                'options'        => [
                    'width' => '100px',
                ],
                'buttons'        => [
                    'view'   => function ( $url, $model ) {
                        return Html::viewButton( 'Просмотр', $model );
                    },
                    'update' => function ( $url, $model ) {
                        return Html::updateButton( 'Редактирование', $model );
                    },
                    'delete' => function ( $url, $model ) {
                        return Html::deleteButton( 'Удалить данного пользователя?', $model );
                    },
                ],
                'visibleButtons' => [
                    'view'   => true,
                    'update' => true,
                    'delete' => true,
                ],
            ],
        ],
    ] ); ?>

</div>


