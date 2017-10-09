<?php

use app\models\User;
use app\widgets\DetailView;
use yii\helpers\Url;
use yii\web\View;

/**
 * @var View $this
 * @var User $model
 */

$this->title = 'Просмотр пользователя';
$this->params[ 'breadcrumbs' ][] = [ 'label' => 'Пользователи', 'url' => [ '/users' ] ];
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
            'fullName',
            'login',
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