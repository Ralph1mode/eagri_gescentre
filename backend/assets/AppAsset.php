<?php

namespace backend\assets;

use Codeception\Util\Template;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'template/css/site.css',
        'template/vendor/jqvmap/css/jqvmap.min.css',
        'template/vendor/chartist/css/chartist.min.css',
        'template/vendor/summernote/summernote.css',
        'template/vendor/datatables/css/jquery.dataTables.min.css',
        'template/vendor/bootstrap-select/dist/css/bootstrap-select.min.css',
        'template/css/style.css',
        'template/css/skin-3.css',
        'template/css/skin-2.css',
        'template/css/skin-1.css',
        'template/css/slimselect.min.css',
        /** my card style */
        /* 'template/style_carte/css/step-9.css',
        'template/style_carte/docs/slimselect.min.css',
        'template/style_carte/img/slimselect.min.css', */

    ];
    public $js = [
        'template/js/slimselect.min.js',
        'template/vendor/global/global.min.js',
        'template/vendor/bootstrap-select/dist/js/bootstrap-select.min.js',
        'template/js/custom.min.js',
        'template/js/dlabnav-init.js',
        'template/vendor/jquery-sparkline/jquery.sparkline.min.js',
        'template/js/plugins-init/sparkline-init.js',
        'template/vendor/raphael/raphael.min.js',
        'template/vendor/morris/morris.min.js',
        'template/js/plugins-init/widgets-script-init.js',
        'template/js/dashboard/dashboard.js',
        'template/vendor/summernote/js/summernote.min.js',
        'template/js/plugins-init/summernote-init.js',
        'template/vendor/svganimation/vivus.min.js',
        'template/vendor/svganimation/svg.animation.js',
        'template/js/styleSwitcher.js',
        "template/vendor/datatables/js/jquery.dataTables.min.js",
        "template/js/plugins-init/datatables.init.js",
        "template/js/sweetalert.min.js",
        'template/js/yii_overrides.js',
        "template/js/ajax-modal-popup.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
