<?php

use app\assets\DashboardAsset;
use app\models\User;
use dmstr\helpers\AdminLteHelper;
use yii\bootstrap\Html;
use yii\web\View;

/**
 * @var View $this
 * @var string $content
 */

$directoryAsset = Yii::$app->assetManager->getPublishedUrl( '@vendor/almasaeed2010/adminlte/dist' );

/** @var User $user */
$user = Yii::$app->user->identity;

DashboardAsset::register( $this );

$this->beginPage();
?>
<!DOCTYPE html>

<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode( $this->title ) ?></title>
    <link rel="shortcut icon" href="/favicon.png" />
    <?php $this->head() ?>
</head>

<body class="hold-transition <?= AdminLteHelper::skinClass() ?> sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <?= $this->render(
        '_header.php',
        [ 'directoryAsset' => $directoryAsset, 'user' => $user ]
    ) ?>

    <?= $this->render(
        '_left.php',
        [ 'directoryAsset' => $directoryAsset, 'user' => $user ]
    )
    ?>

    <?= $this->render(
        '_content.php',
        [ 'content' => $content, 'directoryAsset' => $directoryAsset, 'user' => $user ]
    ) ?>

</div>

<?php $this->endBody() ?>
</body>

</html>

<?php $this->endPage() ?>