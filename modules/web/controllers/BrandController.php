<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 15:56
 */
namespace app\modules\web\controllers;

use app\models\brand\BrandImages;
use app\models\brand\BrandSetting;
use yii\web\Controller;
use app\modules\web\controllers\common\BaseController;

class BrandController extends BaseController
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = "main";
    }

    public function actionInfo()
    {
        $info = BrandSetting::find()->one();
        return $this->render("info",[
            'info' => $info
        ]);
    }

    public function actionSet()
    {
        if (\Yii::$app->request->isGet) {
            $id = $this->get("id", 0);
            $info = [];
            if ($id != 0) {
                $info = BrandSetting::find()->where(['id'=>$id])->one();
            }
            return $this->render("set",[
                'info' => $info
            ]);
        }
        $name = trim($this->post("name"));
        $image_key = trim($this->post("image_key"));
        $mobile = trim($this->post("mobile"));
        $address = trim($this->post("address"));
        $description = trim($this->post("description"));
        $now = date('Y-m-d H:i:s');

        if (mb_strlen($name, "utf-8") < 1) {
            return $this->renderJson([], "请输入符合规范的品牌", -1);
        }
        if (!$image_key) {
            return $this->renderJson([], "请上传品牌logo", -1);
        }
        if (mb_strlen($mobile, "utf-8") < 1) {
            return $this->renderJson([], "请输入符合规范的手机", -1);
        }
        if (mb_strlen($address, "utf-8") < 1) {
            return $this->renderJson([], "请输入符合规范的地址", -1);
        }
        if (mb_strlen($description, "utf-8") < 1) {
            return $this->renderJson([], "请输入符合规范的描述", -1);
        }

        $info = BrandSetting::find()->one();
        if ($info) {
            $model_brand = $info;
        } else {
            $model_brand = new BrandSetting();
            $model_brand->created_time = $now;
        }
        $model_brand->name = $name;
        $model_brand->logo = $image_key;
        $model_brand->mobile = $mobile;
        $model_brand->address = $address;
        $model_brand->description = $description;
        $model_brand->updated_time = $now;
        $model_brand->save(false);
        return $this->renderJson([], "操作成功", 200);

    }

    public function actionImages()
    {
        $list = BrandImages::find()->orderBy(['id' => SORT_DESC])->all();
        return $this->render("images",[
            'list' => $list
        ]);
    }

    //上传图片
    public function actionSetImage()
    {
        $image_key = trim($this->post("image_key"));
        if (!$image_key) {
            return $this->renderJson([], "请上传图片之后再提交", -1);
        }

        $total_count = BrandImages::find()->count();

        if ($total_count > 5) {
            return $this->renderJson([], "最多上传5张", -1);
        }

        $model = new BrandImages();
        $model->image_key = $image_key;
        $model->created_time = date('Y-m-d H:i:s');
        $model->save(false);

        return $this->renderJson([], "操作成功", 200);
    }
}