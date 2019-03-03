<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/14
 * Time: 9:24
 */

namespace app\common\services;


//构建链接
use yii\helpers\Url;

class UrlService
{
    //构建web模块所有链接
    public static function buildWebUrl($path, $params = [])
    {
        $domain_config = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([$path],$params));
        return $domain_config['web'].$path;
    }

    //构建m模块所有链接
    public static function buildMUrl($path, $params = [])
    {
        $domain_config = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([$path],$params));
        return $domain_config['m'].$path;
    }

    //构建官网链接
    public static function buildWwwUrl($path, $params = [])
    {
        $domain_config = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([$path],$params));
        return $domain_config['www'].$path;
    }

    //构建空连接
    public static function buildNullUrl()
    {
        return "javascript:void(0);";
    }

    //构建图片链接
    public static function buildPicUrl($bucket, $image_key)
    {
        $domain_config = \Yii::$app->params['domain'];
        $upload_config = \Yii::$app->params['upload'];

        return $domain_config['www'] . $upload_config[$bucket] . "/" . $image_key;
    }

}