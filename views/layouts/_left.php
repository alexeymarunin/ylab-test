<?php

use yii\web\View;
use app\models\User;

/**
 * @var View $this
 * @var User $user
 * @var string $content
 */

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget([
                'options' => [ 'class' => 'sidebar-menu' ],
                'items'   => [
                    [ 'label' => 'Контент', 'options' => [ 'class' => 'header' ] ],
                    [ 'label' => 'Задачи', 'icon' => 'tasks', 'url' => [ '/tasks' ] ],
                    [ 'label' => 'Статусы', 'icon' => 'lightbulb-o', 'url' => [ '/statuses' ] ],
                    [ 'label' => 'Пользователи', 'icon' => 'users', 'url' => [ '/users' ] ],
                    [ 'label' => 'Система', 'options' => [ 'class' => 'header' ] ],
                    [ 'label' => 'Выход', 'icon' => 'sign-out', 'url' => [ '/logout' ] ],
                ]
        ]) ?>

    </section>

</aside>
