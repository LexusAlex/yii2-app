<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class HighlightAsset extends AssetBundle
{
    public $sourcePath = '@vendor/nezhelskoy/yii2-highlight/src/';

    public $css = [
        'dist/styles/github.css',
    ];
    public $js = [
        'dist/highlight.pack.js',
    ];
}