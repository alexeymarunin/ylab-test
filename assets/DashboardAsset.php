<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Класс DashboardAsset
 *
 * @package app\assets
 * @author  Марунин Алексей
 * @since   1.0
 */
class DashboardAsset extends AssetBundle
{
    public $sourcePath = '@app/assets';
    public $baseUrl = '@web';

    public $css = [
        'css/custom.css',
    ];

    public $js = [
        'js/app.js',
    ];

    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];

}
