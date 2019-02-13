<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/12
 * Time: 8:29
 */

namespace app\assets;

use yii\web\AssetBundle;

class WebAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
//    public $css = [
//        'css/web/bootstrap.min.css',
//        'font-awesome/css/font-awesome.css',
//        'css/web/style.css',
//    ];
//
//    public $js = [
//        'js/plugins/jquery-2.1.1.js',
//        'js/web/bootstrap.min.js',
//        'js/web/common.js'
//    ];

    public function registerAssetFiles($view)
    {
        //版本号是一个常量,加载js或css是有业务逻辑的

        $release_version = defined("RELEASE_VERSION") ? RELEASE_VERSION : time()*1000;

        $this->css = [
            'css/web/bootstrap.min.css',
            'font-awesome/css/font-awesome.css',
            "css/web/style.css?ver=".$release_version,
        ];

        $this->js = [
            'js/plugins/jquery-2.1.1.js',
            'js/web/bootstrap.min.js',
            'js/plugins/layer/layer.js',
            "js/web/common.js?ver=".$release_version
        ];
        parent::registerAssetFiles($view);
    }
}