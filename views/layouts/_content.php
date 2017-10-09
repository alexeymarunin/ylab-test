<?php

use dmstr\widgets\Alert;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * @var View $this
 * @var string $content
 */

$title = ArrayHelper::getValue( $this->blocks, 'content-header', Html::encode( $this->title ) );
$breadcrumbs = ArrayHelper::getValue( $this->params, 'breadcrumbs', [] );
$isError = ( Yii::$app->controller->action->id == 'error' );
?>
<div class="content-wrapper">
    <section class="content-header">
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= Breadcrumbs::widget( [ 'links' => $breadcrumbs, ] ) ?>
        <div class="panel panel-<?= $isError ? 'danger' : 'info' ?>">
            <div class="panel panel-heading">
                <h3><?= $title ?></h3>
            </div>
            <div class="panel panel-body">
                <?= $content ?>
            </div>
            <div class="panel panel-footer">
                <?= Breadcrumbs::widget( [ 'links' => $breadcrumbs, ] ) ?>
            </div>
        </div>
    </section>
</div>

<footer class="main-footer">
        Тестовое задание для YLab, версия <?= Yii::$app->version ?>
</footer>

<!-- Control Sidebar -->
