<?php
/**
 * Created by PhpStorm.
 * User: 吴凯斌
 * Date: 2019/2/20
 * Time: 22:59
 */
namespace app\modules\web\controllers;

use app\common\services\uploadService;
use app\common\services\UrlService;
use app\common\services\UtilService;
use app\models\Images;
use app\modules\web\controllers\common\BaseController;
use yii\imagine\Image;

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
        $ret = uploadService::uploadByFile($file_name, $_FILES['pic']['tmp_name'], $bucket);

        if (!$ret) {
            return "<script>{$callback}.error('".uploadService::getLastErrorCode()."')</script>";
        }

        return "<script>{$callback}.success('{$ret['path']}')</script>";
    }

    /**
     * 富文本编辑器上传接口
     */
    public function actionUeditor()
    {
        $action = $this->get("action");
//        print_r($action);die;
        $config_path = UtilService::getRootPath()."/web/js/plugins/ueditor/upload_config.json";
        $config = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents($config_path) ), true);
        switch ($action) {
            case "config":
                echo json_encode($config, true);
                break;
                /* 上传图片 */
            case "uploadimage":
                /* 上传涂鸦 */
            case "uploadscrawl":
                /* 上传视频 */
            case "uploadvideo":
                /* 上传文件 */
            case "uploadfile":
                $this->uploadUeditorImage();
                break;
            case "listimage":
                $this->listUeditorImage();
                break;
        }
    }

    /**
     * 上传富文本编辑器的文件
     */
    private function uploadUeditorImage()
    {
        $up_target = $_FILES['upfile'];
        if ($up_target['error'] > 0) {
            return $this->retUeditor("上传失败!error: " . $up_target['error']);
        }
        if (!is_uploaded_file($up_target['tmp_name'])) {
            return $this->retUeditor("非法上传文件");
        }
        $filename = $up_target['name'];
        $ret = uploadService::uploadByFile($filename, $up_target['tmp_name'], "book");

        if (!$ret) {
            return $this->retUeditor(UploadService::getLastErrorCode());
        }

        if (isset($ret['code']) && $ret['code']==205) {
            return $this->retUeditor("此图片已经上传过了");
        }

        return $this->retUeditor("SUCCESS", UrlService::buildWwwUrl($ret['prefix'] . $ret['path']));
    }

    /**
     * 展示富文本编辑器的图片
     */
    private function listUeditorImage()
    {
        $start = intval($this->get("start", 0));
        $page_size = intval($this->get("size", 20));
        $bucket = "book";
        $query = Images::find()->where(['bucket'=>$bucket]);
        if ($start) {
            $query->andWhere(['<', 'id', $start]);
        }
        $list = $query->orderBy('id desc')->limit($page_size)->all();
        $images = [];
        $last_id = 0;
        if ($list) {
            foreach ($list as $item) {
                $images[] = [
                    'url' => UrlService::buildPicUrl($bucket, $item['file_key']),
                    'mtime' => strtotime($item['created_time']),
                    'width' => 300
                ];
                $last_id = $item['id'];
            }
        }

        header('Content-type: application/json');

        $data = [
            'state' => count($images) > 0 ? "SUCCESS":"NO MATCH FILE",
            'list' => $images,
            'start' => $last_id,
            'total' => count($images)
        ];
        echo json_encode($data);
        exit();
    }

    /**
     * 返回信息
     */
    private function retUeditor($state, $url='', $title='', $original='', $type='', $size='')
    {
        header('Content-type: application/json');
        $data = [
            'state' => $state,
            'url' => $url,
            'title' => $title,
            'original' => $original,
            'type' => $type,
            'size' => $size,
            'width' => 200
        ];
        echo json_encode($data);
        exit();
    }
}