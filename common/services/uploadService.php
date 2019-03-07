<?php
namespace app\common\services;

//上传服务
use app\models\Images;

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


        $upload_config = \Yii::$app->params['upload'];

        if (!isset($upload_config[$bucket])) {
            return self::_err('指定参数错误');
        }

        $tmp_file_extend = explode(".", $file_name);
        $extension = strtolower(end($tmp_file_extend));

        $hash_key = md5(file_get_contents($file_path));
        //文件放到指定目录,在每个篮子下面按照日期放置图片
        $upload_dir_path = UtilService::getRootPath() . "/web" . $upload_config[$bucket] . "/";
        $folder_name = date('Ymd');
        $upload_dir = $upload_dir_path . $folder_name;

        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777);
            chmod($upload_dir, 0777);
        }

        $upload_full_name = $folder_name . "/" . $hash_key . ".{$extension}";

        if (is_uploaded_file($file_path)) {
            move_uploaded_file($file_path, $upload_dir_path . $upload_full_name);
        } else {
            file_put_contents($upload_dir_path . $upload_full_name, file_get_contents($file_path));
        }

        //调用保存图片方法
        self::saveImage($bucket, $upload_full_name);

        return [
            'code' => 200,
            'path' => $upload_full_name,
            'prefix' => $upload_config[$bucket] . "/"
        ];
    }

    //保存图片资源
    public static function saveImage($bucket='', $file_key='')
    {
        $model_image = new Images();
        $model_image->bucket = $bucket;
        $model_image->file_key = $file_key;
        $model_image->created_time = date('Y-m-d H:i:s');
        $model_image->save(false);
    }
}