<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/12
 * Time: 9:59
 */
namespace app\assets;

use yii\web\AssetBundle;

class MAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = "@web";

    public function registerAssetFiles($view)
    {
        $release_version = defined("RELEASE_VERSION") ? RELEASE_VERSION : time();

        $this->css = [
            'font-awesome/css/font-awesome.css',
            'css/m/app.css',
            "css/m/css_style.css?version=".$release_version
        ];

        $this->js = [
            "js/plugins/jquery-2.1.1.js",
            "js/m/TouchSlide.1.1.js",
            "js/m/common.js?version=".$release_version
        ];

        parent::registerAssetFiles($view);
    }
}