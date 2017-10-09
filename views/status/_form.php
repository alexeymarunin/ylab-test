<?php

use app\models\Status;
use app\widgets\DetailView;
use yii\web\View;

/**
 * @var View $this
 * @var Status $model
 */

?>

<?= DetailView::widget( [
    'model' => $model,
    'mode'  => DetailView::MODE_EDIT,

    'attributes' => [
        'title',
        'order',
    ],
] ) ?>

