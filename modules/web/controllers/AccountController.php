<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 15:47
 */
namespace app\modules\web\controllers;

use app\common\services\ConstantMapService;
use app\models\User;
use app\modules\web\controllers\common\BaseController;

class AccountController extends BaseController
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = "main";
    }

    //账户列表
    public function actionIndex()
    {
        $status = intval($this->get("status", ConstantMapService::$status_default));
        $mix_kw = trim($this->get("mix_kw",""));
        $p = intval($this->get("p", 1));

        $query = User::find();

        if ($status > ConstantMapService::$status_default) {
            $query->andWhere(['status' => $status]);
        }

        if ($mix_kw) {
            $where_nickname = ['like', 'nickname', '%'.$mix_kw.'%',false];
            $where_mobile = ['like', 'mobile', '%'.$mix_kw.'%', false];
            $query->andWhere(['or', $where_nickname, $where_mobile]);
        }

        //分页功能,1:总记录数量 2:每页展示的数量
        $page_size = 3;
        $total_res_count = $query->count();
        $total_page = ceil($total_res_count/$page_size);


        $list = $query->orderBy(['uid' => SORT_DESC])
            ->offset( ($p - 1) * $page_size )
            ->limit($page_size)
            ->all();


        return $this->render("index",[
            'list' => $list,
            'status_mapping' => ConstantMapService::$status_mapping,
            'search_status' =>
                [
                    'status' => $status,
                    'mix_kw' => $mix_kw,
                    'p' => $p
                ],
            'pages' =>
                [
                    'total_count' => $total_res_count,
                    'page_size' => $page_size,
                    'total_page' => $total_page,
                    'p' => $p
                ]
        ]);
    }

    //账户编辑或添加
    public function actionSet()
    {
        return $this->render("set");
    }

    //账户详情
    public function actionInfo()
    {
        return $this->render("info");
    }

    //删除账户
    public function actionOps()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->renderJson([], '系统繁忙,请稍后再试', -1);
        }

        $uid = intval($this->post("uid", 0));
        $act = trim($this->post("act",""));

        if (!$uid) {
            return $this->renderJson([], "请选择要操作的账号", -1);
        }

        if (!$act) {
            return $this->renderJson([], "请选择要进行的操作", -1);
        }


        if (!in_array($act, ['remove', 'recover'])) {
            return $this->renderJson([], "操作有误,请重新选择", -1);
        }

        $user_info = User::find()->where(['uid' => $uid])->one();
        if (!$user_info) {
            return $this->renderJson([], "您指定的账号不存在~~", -1);
        }

        switch ($act)
        {
            case "remove":
                $user_info->status = 0;
                break;
            case "recover":
                $user_info->status = 1;
                break;
        }

        $user_info->updated_time = date('Y-m-d H:i:s');
        $user_info->update(0);
        return $this->renderJson([], "操作成功");
    }
}