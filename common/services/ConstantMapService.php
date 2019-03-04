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

    //账号状态
    public static $status_mapping=[
        1 => '正常',
        0 => '已删除',
    ];

    public static $sex_mapping = [
        1 => '男',
        2 => '女',
        0 => '未填写'
    ];

    public static $default_avatar = "default_avatar";

    public static $default_login_pwd = "******";

    public static $default_syserror = "系统繁忙,请稍后再试~~";

}