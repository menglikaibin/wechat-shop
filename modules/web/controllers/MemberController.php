<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 16:16
 */
namespace app\modules\web\controllers;

use app\common\services\ConstantMapService;
use app\common\services\UrlService;
use app\common\services\UtilService;
use app\models\member\Member;
use app\modules\web\controllers\common\BaseController;

class MemberController extends BaseController
{
    public function actionIndex()
    {
        //获取前端传过来的筛选条件
        $mix_kw = trim($this->get("imx_kw", "")); //关键字
        $status = intval($this->get("status", ConstantMapService::$status_default)); //账号状态
        $p      = intval($this->get("p", 1)); //当前页
        $p      = $p > 0 ? $p : 1;

        $query = Member::find();
        // 条件查询
        if ($mix_kw) {
            $where_nickname = ['like', 'nickname', $mix_kw];
            $where_mobile = ['like', 'mobile', $mix_kw];
            $query->where(['or', $where_nickname, $where_mobile]);
        }

        if ($status > ConstantMapService::$status_default) {
            $query->andWhere(['status'=>$status]);
        }

        $offset = ($p - 1) * $this->page_size;
        //获取符合条件的数量
        $total_res_count = $query->count();

        $pages = UtilService::ipagination([
            'total_count' => $total_res_count,
            'page_size' => $this->page_size,
            'page' => $p,
            'display' => 10
        ]);

        $list = $query->orderBy(['id' => SORT_DESC])
            ->offset($offset)
            ->limit($this->page_size)
            ->all();

        $member_list = [];

        if ($list) {
            foreach ($list as $key => $item) {
                $member_list[] = [
                    'id' => $item['id'],
                    'nickname' => $item['nickname'],
                    'mobile' => $item['mobile'],
                    'sex_desc' => ConstantMapService::$sex_mapping[$item['sex']],
                    'avatar' => UrlService::buildPicUrl("avatar", $item['avatar']),
                    'status_desc' => ConstantMapService::$status_mapping[$item['status']],
                    'status' => $item['status']
                ];
            }
        }

        return $this->render("index", [
            'pages' => $pages,
            'member_list' => $member_list,
            'status_mapping' => ConstantMapService::$status_mapping,
            'search_conditions' => [
                'mix_kw' => $mix_kw,
                'p' => $p,
                'status' => $status
            ]
        ]);
    }

    public function actionOps()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->renderJson([], ConstantMapService::$default_syserror, -1);
        }

        $id = $this->post('id');
        $act = trim($this->post('act', ""));

        if (!$id) {
            return $this->renderJson([], "请选择要操作的会员", -1);
        }
        if (!in_array($act, ["remove", "recover"])) {
            return $this->renderJson([], "操作有误,请重试", -1);
        }

        $info = Member::find()->where(['id'=>$id])->one();
        if (!$info) {
            return $this->renderJson([], "账号信息不存在,请重试", -1);
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
        $info->update(false);
        return $this->renderJson([], "操作成功", -1);

    }

    public function actionInfo()
    {

        return $this->render("info");
    }

    public function actionSet()
    {

        return $this->render("set");
    }

    public function actionComment()
    {

        return $this->render("comment");
    }
}