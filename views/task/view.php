<?php

use app\models\Task;
use app\widgets\DetailView;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var Task $model
 */

$this->title = 'Просмотр задачи';
$this->params[ 'breadcrumbs' ][] = [ 'label' => 'Задачи', 'url' => [ '/tasks' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="task-view">

    <?= DetailView::widget( [
        'model' => $model,
        'mode'  => DetailView::MODE_VIEW,

        'cancelOptions' => [
            'url' => Url::to( [ 'index' ] ),
        ],
        'attributes'    => [
            'title',
            'desc',
            [
                'attribute' => 'due_date',
                'format' => 'date',
            ],
            'statusTitle',
            'authorName',
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
            ],
        ],
    ] ) ?>

</div>