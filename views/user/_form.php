<?php

use app\models\User;
use app\widgets\DetailView;
use yii\web\View;

/**
 * @var View $this
 * @var User $model
 */

?>

<?= DetailView::widget( [
    'model' => $model,
    'mode'  => DetailView::MODE_EDIT,

    'attributes' => [
        [
            'displayOnly' => !$model->isNewRecord,
            'attribute' => 'login',
        ],
        'first_name',
        'middle_name',
        'last_name',
        [
            'type' => DetailView::INPUT_PASSWORD,
            'attribute' => 'password',
        ],
    ],
] ) ?>

