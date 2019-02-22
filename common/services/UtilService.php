<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/16
 * Time: 14:39
 */

namespace app\common\services;


//只封装通用方法
use yii\helpers\Html;

class UtilService
{
    public static function getIP()
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function encode($display)
    {
        return Html::encode($display);
    }

    public static function getRootPath()
    {
        return dirname(\Yii::$app->vendorPath);
    }
}