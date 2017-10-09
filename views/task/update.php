<?php

use app\models\Task;
use yii\web\View;

/**
 * @var View $this
 * @var Task $model
 * @var array $statuses
 */

$this->title = 'Изменить задачу';
$this->params[ 'breadcrumbs' ][] = [ 'label' => 'Задачи', 'url' => [ '/tasks' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;

?>
<div class="task-update">

    <?= $this->render( '_form', [
        'model'    => $model,
        'statuses' => $statuses,
    ] ) ?>
</div>