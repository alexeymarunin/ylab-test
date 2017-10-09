<?php

use app\models\User;
use yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var User $user
 * @var string $content
 */

?>

<header class="main-header">

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Пользователь: <span class="hidden-xs"><?= $user->fullName ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle hidden"
                                 alt="User Image"/>

                            <p>
                                <?= $user->fullName ?>
                                <small>Зарегистрирован <?= Yii::$app->formatter->asDate( $user->created_at ) ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="">
                                <?= Html::a(
                                    'Выход',
                                    [ 'auth/logout' ],
                                    [ 'data-method' => 'post', 'class' => 'btn btn-default btn-flat col-xs-12' ]
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
