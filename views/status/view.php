<?php

use app\models\Status;
use app\widgets\DetailView;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var Status $model
 */

$this->title = 'Просмотр статуса';
$this->params[ 'breadcrumbs' ][] = [ 'label' => 'Статусы', 'url' => [ '/statuses' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="user-view">

    <?= DetailView::widget( [
        'model' => $model,
        'mode'  => DetailView::MODE_VIEW,

        'cancelOptions' => [
            'url' => Url::to( [ 'index' ] ),
        ],
        'attributes'    => [
            'title',
            'order',
        ],
    ] ) ?>

</div>