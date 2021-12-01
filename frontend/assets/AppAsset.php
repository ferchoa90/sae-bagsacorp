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
      '/backend/web/js/plugins/sweetalert/sweetalert.css',
      //  'css/bootstrap.min.css',
      //  'css/slick.css',
      //  'css/slick-theme.css',
      //  'css/nouislider.min.css',
      //  'css/font-awesome.min.css',
     //   'css/style.css',
    ];
    public $js = [
      '/backend/web/js/plugins/sweetalert/sweetalert.min.js',
     /*    'js/jquery.min.js',
        'js/bootstrap.min.js',
        'js/slick.min.js',
        'js/nouislider.min.js',
        'js/jquery.zoom.min.js',
        'js/main.js', */
    ];
    public $depends = [
      /*   'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset', */
    ];
}
