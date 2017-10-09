<?php

use app\models\Status;
use yii\web\View;

/**
 * @var View $this
 * @var Status $model
 */

$this->title = 'Изменить статус';
$this->params[ 'breadcrumbs' ][] = [ 'label' => 'Статусы', 'url' => [ '/statuses' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="status-update">

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>