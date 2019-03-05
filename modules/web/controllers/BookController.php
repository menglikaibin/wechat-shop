<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 16:02
 */
namespace app\modules\web\controllers;

use app\common\services\ConstantMapService;
use app\common\services\UtilService;
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

    //图书展示页面
    public function actionIndex()
    {
        $mix_kw = trim($this->get("mix_kw", ""));
        $status = intval($this->get("status", ConstantMapService::$status_default));
        $cat_id = intval($this->get("cat_id", 0));
        $p = intval($this->get("p", 1));
        $p = ($p > 0) ? $p : 1;

        $query = Book::find();

        if ($mix_kw) {
            $where_nickname = ['like', 'name', $mix_kw];
            $where_tags = ['like', 'tags', $mix_kw];
            $query->where(['or', $where_nickname, $where_tags]);
        }

        if ($status > ConstantMapService::$status_default) {
            $query->andWhere(['status' => $status]);
        }

        if ($cat_id) {
            $query->andWhere(['cat_id'=>$cat_id]);
        }

        //计算从数据库取时的偏移量
        $offset = ($p - 1) * $this->page_size;
        $total_res_count = $query->count();

        $page = UtilService::ipagination([
            'total_count' => $total_res_count,
            'page_size' => $this->page_size,
            'page' => $p,
            'display' => 10
        ]);

        //查询出从第p页开始的10条记录
        $list = $query->orderBy(['id' => SORT_DESC])
            ->offset($offset)
            ->limit($this->page_size)
            ->all();
        $cat_mapping = BookCat::find()->orderBy(['id'=>SORT_DESC])->indexBy("id")->all();
//        foreach ($cat_mapping as $key => $value) {
//            print_r($key);
//            print_r($value);
//            echo "<br>";
//        }
//        die;

        $data = [];

        if ($list) {
            foreach ($list as $item) {
                $tmp_cat_info = isset($cat_mapping[$item['cat_id']]) ? $cat_mapping[$item['cat_id']] : [];
                $data[] = [
                    'id'    => $item['id'],
                    'name'  => UtilService::encode($item['name']),
                    'price' => UtilService::encode($item['price']),
                    'stock' => UtilService::encode($item['stock']),
                    'tags' => UtilService::encode($item['tags']),
                    'status' => UtilService::encode($item['status']),
                    'cat_name' => $tmp_cat_info ? UtilService::encode($tmp_cat_info['name']) : ""
                ];
            }
        }

        return $this->render("index",[
            'pages' => $page,
            'list' => $data,
            'search_conditions' => [
                'mix_kw' => $mix_kw,
                'p' => $p,
                'status' => $status,
                'cat_id' => $cat_id
            ],
            'status_mapping' => ConstantMapService::$status_mapping,
            'cat_mapping' => $cat_mapping
        ]);
    }

    //添加移除图书操作
    public function actionOps()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->renderJson([], ConstantMapService::$default_syserror, -1);
        }

        $id = intval($this->post("id", []));
        $act = trim($this->post("act", 0));

        if (!$id) {
            return $this->renderJson([], $act=="remove"?"请选择要删除的账号":"请选择要恢复的账号", -1);
        }
        if (!in_array($act, ["remove", "recover"])) {
            return $this->renderJson([], "操作有误,请重试", -1);
        }

        $info = Book::find()->where(['id'=>$id])->one();
        if (!$info) {
            return $this->renderJson([], "操作账号不存在", -1);
        }

        switch ($act) {
            case "remove":
                $info->status = 0;
                break;
            case "recover":
                $info->status = 1;
                break;
        }

        $info->updated_time = date('Y-m-d H:i:s');
        $info->update(false);
        return $this->renderJson([], "操作成功", 200);
    }

    public function actionSet()
    {
        if (\Yii::$app->request->isGet) {
            $id = intval($this->get('id', 0));
            $info = [];
            if ($id) {
                $info = Book::find()->where(['id'=>$id])->one();
            }
            $cat_list = BookCat::find()->orderBy(['id'=>SORT_DESC])->all();
            return $this->render("set",[
                'info' => $info,
                'cat_list' => $cat_list
            ]);
        }
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