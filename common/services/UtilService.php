<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/16
 * Time: 14:39
 */

namespace app\common\services;


//只封装通用方法
class UtilService
{
    public static function getIP()
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $_SERVER['REMOTE_ADDR'];
    }
}