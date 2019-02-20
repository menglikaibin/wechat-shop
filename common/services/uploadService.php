<?php
namespace app\common\services;

//上传服务
class uploadService extends BaseService
{
    public static function uploadByFile($file_name, $file_path, $bucket='')
    {
        if (!$file_name) {
            return self::_err("参数名是必须的");
        }

        if (!$file_path || !file_exists($file_path)) {
            return self::_err("请输入合法参数file_path");
        }

        $hash_key = md5(file_get_contents($file_path));

        //文件放到指定目录,在每个篮子下面按照日期放置图片

    }
}