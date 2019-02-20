<?php
/**
 * Created by PhpStorm.
 * User: 吴凯斌
 * Date: 2019/2/20
 * Time: 22:59
 */
namespace app\modules\web\controllers;

use app\modules\web\controllers\common\BaseController;

class UploadController extends BaseController
{
    private $_allow_file_type = ['jpg', 'jpeg', 'png', 'gif'];

    /**
     * 上传接口
     * bucket: avatar/brand/book
     */
    public function actionPic()
    {
        $bucket = trim($this->post("bucket", ""));
        $callback = "window.parent.upload"; //error,success方法

        if (!$_FILES || !isset($_FILES['pic'])) {
            return "<script>{$callback}.error('请选择图片再提交')</script>";
        }

        $file_name = $_FILES['pic']['name'];
        $tmo_file_extend = explode('.', $file_name);
        if (!in_array(strtolower(end($tmo_file_extend)), $this->_allow_file_type)) {
            return "<script>{$callback}.error('请上传指定的类型图片, 类型允许jpg,jpeg,png,gif')</script>";
        }

        //上传图片业务逻辑 todo
        return "<script>{$callback}.success('上传图片成功')</script>";
    }
}