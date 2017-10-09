<?php

use app\models\Task;
use yii\web\View;

/**
 * @var View $this
 * @var Task $model
 * @var array $statuses
 */

$this->title = 'Добавить задачу';
$this->params[ 'breadcrumbs' ][] = [ 'label' => 'Статусы', 'url' => [ '/statuses' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="task-create">

    <?= $this->render( '_form', [
        'model'    => $model,
        'statuses' => $statuses,
    ] ) ?>

</div>