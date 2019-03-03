<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 16:02
 */
namespace app\modules\web\controllers;

use app\common\services\ConstantMapService;
use app\models\book\Book;
use app\models\book\BookCat;
use app\modules\web\controllers\common\BaseController;

class BookController extends BaseController
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = "main";
    }

    public function actionIndex()
    {

        return $this->render("index");
    }

    public function actionSet()
    {

        return $this->render("set");
    }

    public function actionInfo()
    {

        return $this->render("info");
    }

    public function actionImages()
    {

        return $this->render("images");
    }

    //分类列表
    public function actionCat()
    {
        $status = intval($this->get("status", ConstantMapService::$status_default));
        $query = BookCat::find();

        if ($status > ConstantMapService::$status_default) {
            $query->where(['status'=>$status]);
        }

        $list = $query->orderBy(['weight'=>SORT_DESC, 'id'=>SORT_DESC])->all();

        return $this->render("cat",[
            'list' => $list,
            'status_mapping' => ConstantMapService::$status_mapping,
            'search_conditions' => [
                'status' => $status
            ]
        ]);
    }

    //分类操作
    public function actionCatOps()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->renderJson([], ConstantMapService::$default_syserror, -1);
        }

        $id = intval($this->post('id', []));
        $act = trim($this->post('act', ''));

        if (!$id) {
            return $this->renderJson([], "请选择你要操作的账号", -1);
        }
        if (!in_array($act, ['remove', 'recover'])){
            return $this->renderJson([], "操作有误~", -1);
        }

        $info = BookCat::find()->where(['id'=>$id])->one();
        if (!$info) {
            return $this->renderJson([], "指定分类不存在", -1);
        }

        switch ($act)
        {
            case "remove":
                $info->status = 0;
                break;

            case "recover":
                $info->status = 1;
                break;
        }

        $info->updated_time = date('Y-m-d H:i:s');
        $info->save(false);
        return $this->renderJson([], "操作成功");
    }

    //分类列表设置
    public function actionCatSet()
    {
        if (\Yii::$app->request->isGet) {
            $id = intval($this->get('id', 0));
            $info = [];
            if ($id) {
                $info = BookCat::find()->where(['id'=>$id])->one();

            }
            return $this->render("cat_set",[
                'info' => $info
            ]);
        }

        $id = intval($this->post('id', 0));
        $weight = intval($this->post('weight', 1));
        $name = trim($this->post('name', ""));
        $date_now = date('Y-m-d H:i:s');

        if (mb_strlen($name, "utf-8") < 1) {
            return $this->renderJson([], "请输入合法的名称", -1);
        }

        $has_in = BookCat::find()->where(['name'=>$name])->andWhere(['!=', 'id', $id])->count();

        if ($has_in) {
            return $this->renderJson([], "该分类名已存在", -1);
        }

        $cat_info = BookCat::find()->where(['id'=>$id])->one();

        if ($cat_info) {
            $model_book_cat = $cat_info;
        } else {
            $model_book_cat = new BookCat();
            $model_book_cat->created_time = $date_now;
        }

        $model_book_cat->name = $name;
        $model_book_cat->weight = $weight;
        $model_book_cat->updated_time = $date_now;
        $model_book_cat->save(false);

        return $this->renderJson([], "操作成功~~");
    }
}