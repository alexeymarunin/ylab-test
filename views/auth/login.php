<?php

use app\models\form\LoginForm;
use app\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var LoginForm $model
 */

$this->title = 'Вход';

?>
<div class="auth-login">

    <div class="panel panel-default">

        <div class="panel panel-heading logo-heading">
            <h1>Вход в систему</h1>
        </div>

        <div class="panel panel-body">
            <?php $form = ActiveForm::begin( [ 'id' => 'login-form' ] ); ?>
            <?= $form->field( $model, 'username' ) ?>
            <?= $form->field( $model, 'password' )->passwordInput() ?>
            <?= $form->field( $model, 'rememberMe' )->checkbox() ?>
            <div class="form-group">
                <?= Html::submitButton( 'Войти', [ 'class' => 'btn btn-success btn-lg col-sm-6 col-sm-offset-3 col-xs-12', 'name' => 'login-button' ] ) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <p>&nbsp;

    </div>

</div>
