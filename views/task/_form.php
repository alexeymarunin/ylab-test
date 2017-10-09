<?php

use app\models\Task;
use app\widgets\DetailView;
use app\widgets\DatePicker;
use yii\web\View;

/**
 * @var View $this
 * @var Task $model
 * @var array $statuses
 */

?>

<?= DetailView::widget( [
    'model' => $model,
    'mode'  => DetailView::MODE_EDIT,

    'attributes' => [
        [
            'attribute' => 'title',
        ],
        [
            'attribute' => 'desc',
            'type' => DetailView::INPUT_TEXTAREA,
        ],
        [
            'attribute' => 'due_date',
            'type' => DetailView::INPUT_WIDGET,
            'widgetOptions' => [
                'class' => DatePicker::className(),
            ],
        ],
        'status_id' => [
            'attribute' => 'status_id',
            'type'      => DetailView::INPUT_DROPDOWN_LIST,
            'items'     => $statuses,
        ],
    ],
] ) ?>

