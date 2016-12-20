<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    //public $sourcePath = '@frontend/web';
    public $css = [
        'css/style.css',
    ];
    public $js = [
        'js/main.js'
    ];
    public $depends = [
        'frontend\assets\NormalizeAsset',
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
