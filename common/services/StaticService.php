<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/20
 * Time: 11:35
 */

namespace app\common\services;


//只用于加载应用本身的资源文件
class StaticService
{
    public static function includeAppJsStatic($path, $depend)
    {
        self::includeAppStatic("js", $path, $depend);
    }

    public static function includeAppCssStatic($path, $depend)
    {
        self::includeAppStatic("css", $path, $depend);
    }

    public static function includeAppStatic($type, $path, $depend)
    {
        $release_version = defined("RELEASE_VERSION") ? RELEASE_VERSION : trim(time());
        $path = $path . "?version=" . $release_version;
        if ($type == "js") {
            \Yii::$app->getView()->registerJsFile($path, $depend);
        } elseif ($type == "css") {
            \Yii::$app->getView()->registerCssFile($path, $depend);
        }
    }
}