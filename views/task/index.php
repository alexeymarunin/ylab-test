<?php

use app\models\Task;
use app\helpers\Html;
use app\widgets\GridView;
use kartik\editable\Editable;
use yii\web\View;
use yii\data\ActiveDataProvider;
use yii\base\Model;

/**
 * @var View $this
 * @var ActiveDataProvider $dataProvider
 * @var Model $filterModel
 * @var array $statuses
 */

$this->title = 'Задачи';
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="task-index">

    <?= Html::createButton( 'Добавить задачу' ) ?>

    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
//        'filterModel'  => $filterModel,
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
                'attribute' => 'title',
            ],

            [
                'attribute' => 'due_date',
                'format'    => 'date',
            ],

            [
                'attribute' => 'status_id',
                'value'     => function ( $model, $key, $index, $column ) use ( $statuses ) {
                    return Html::activeDropDownList( $model, 'status_id',
                        $statuses,
                        [
                            'id'  => 'task-' . $model->id . '-status',
                            'onchange' => 'onChangeTaskStatus(' . $model->id . ')',
                        ]

                    );
                },
                'format'    => 'raw',
                'filter'    => $statuses,
            ],

            [
                'attribute' => 'created_at',
                'format'    => 'datetime',
            ],
            [
                'attribute' => 'updated_at',
                'format'    => 'datetime',
            ],

            [
                'attribute' => 'authorName',
                'value'     => function ( Task $model ) {
                    return Html::a( $model->authorName, [ 'user/view', 'id' => $model->created_by ] );
                },
                'format'    => 'raw',
            ],

            [
                'class'          => 'yii\grid\ActionColumn',
                'options'        => [
                    'width' => '150px',
                ],
                'buttons'        => [
                    'view'   => function ( $url, $model ) {
                        return Html::viewButton( 'Просмотр', $model );
                    },
                    'update' => function ( $url, $model ) {
                        return Html::updateButton( 'Редактирование', $model );
                    },
                    'delete' => function ( $url, $model ) {
                        return Html::deleteButton( 'Удалить данную задачу?', $model );
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

