<?php
namespace hail812\adminlte3\assets;

use yii\web\AssetBundle;

class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';

    public $css = [
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css',
        'css/adminlte.min.css',
        //'/backend/web/css/AdminLTE.min.css',
        '/backend/web/css/skins/_all-skins.min.css',
        '/backend/web/js/plugins/sweetalert/sweetalert.css',
        'https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css',
        // '/backend/web/js/plugins/datatables/dataTables.bootstrap.css',
        // '/backend/web/js/plugins/datatables/buttons/buttons.dataTables.min.css',
        
        '//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css',
        
        '//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css',
        '//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css',
        '//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css',
        '/backend/web/css/site.css',
        //'https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css',

    ];

    public $js = [
       // 'https://code.jquery.com/jquery-3.5.1.js',
        'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js',
        'https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',
        'js/adminlte.min.js',
        '/backend/web/js/app.min.js',
        '/backend/web/js/plugins/slimScroll/jquery.slimscroll.min.js',
        '/backend/web/js/plugins/sweetalert/sweetalert.min.js',
        '/backend/web/js/plugins/bootstrap-notify/bootstrap-notify.min.js',
        //'/backend/web/js/plugins/datatables/jquery.dataTables.min.js',
        //'/backend/web/js/plugins/datatables/dataTables.bootstrap.min.js',
        //'/backend/web/js/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js',
        //'/backend/web/js/plugins/datatables/buttons/dataTables.buttons.min.js',
        '/backend/web/js/plugins/datatables/buttons/buttons.flash.min.js',
        '/backend/web/js/plugins/datatables/buttons/buttons.html5.min.js',
        //'https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js',
        'https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js',
        '//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js',
        '/backend/web/js/scripts.js',


    ];

    public $depends = [
        'hail812\adminlte3\assets\BaseAsset',
        'hail812\adminlte3\assets\PluginAsset'
    ];
}