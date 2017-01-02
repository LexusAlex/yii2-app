<?php
namespace frontend\assets;

use yii\web\AssetBundle;
/**
 * Class NormalizeAsset
 * @package app\assets
 */
class NormalizeAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/components/normalize.css/';
    /**
     * @var array
     */
    public $css = [
        'normalize.css',
    ];
}