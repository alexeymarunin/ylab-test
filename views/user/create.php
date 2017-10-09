<?php

use app\models\User;
use yii\web\View;

/**
 * @var View $this
 * @var User $model
 */

$this->title = 'Добавить пользователя';
$this->params[ 'breadcrumbs' ][] = [ 'label' => 'Пользователи', 'url' => [ '/users' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;

?>

<div class="status-create">

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>