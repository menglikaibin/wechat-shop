<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/20
 * Time: 16:53
 */

namespace app\common\services;


class ConstantMapService
{
    public static $status_default = -1;

    public static $status_mapping=[
        1 => '正常',
        0 => '已删除'
    ];

    public static $default_avatar = "default_avatar";

}