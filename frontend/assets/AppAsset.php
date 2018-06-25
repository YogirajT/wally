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
    public $css = [
        'css/site.css',
        'css/custom.css',
        // 'css/bootstrap/css/bootstrap.min.css',
        // 'css/font-awesome-4.7.0/css/font-awesome.min.css',
        // 'css/animate.css',
        // 'css/hamburgers.min.css',
        // 'css/select2.min.css',
        // 'css/util.css',
        // 'css/main.css',
    ];
    public $js = [
        // 'js/bootstrap/js/popper.js',
        // 'js/select2/select2.min.js',
        // 'js/tilt/tilt.jquery.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
