<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 15:47
 */
namespace app\modules\web\controllers;

use app\common\services\ConstantMapService;
use app\common\services\UrlService;
use app\models\log\AppAccessLog;
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
        if (\Yii::$app->request->isGet) {
            $id = intval($this->get("id", 0));
            $info = [];

            if ($id) {
                $info = User::find()->where(['uid' => $id])->one();
            }

            return $this->render("set", [
                'info' => $info
            ]);
        }

        $nickname = trim($this->post("nickname"), "");
        $mobile = trim($this->post("mobile"), "");
        $email = trim($this->post("email"), "");
        $login_name = trim($this->post("login_name"), "");
        $login_pwd = trim($this->post("login_pwd"), "");
        $id = intval($this->post("id", 0));
        $date_now = date("Y-m-d H:i:s");

        if (mb_strlen($nickname, "utf-8") < 1) {
            return $this->renderJson([], "请输入符合规范的姓名", -1);
        }
        if (!preg_match("/^1[34578]\d{9}$/", $mobile)) {
            return $this->renderJson([], "请输入符合规范的手机号码", -1);
        }
        if (!preg_match("/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/", $email)) {
            return $this->renderJson([], "请输入符合规范的邮箱", -1);
        }
        if (mb_strlen($login_name, "utf-8") < 1) {
            return $this->renderJson([], "请输入符合规范的登录名", -1);
        }
        if (mb_strlen($login_pwd, "utf-8") < 6) {
            return $this->renderJson([], "请输入不小于6位数的密码", -1);
        }

        $acc = User::find()->where(["login_name" => $login_name])->andWhere(["!=", "uid", $id])->count();

        if ($acc) {
            return $this->renderJson([], "该用户已存在,请重新输入", -1);
        }

        $info = User::find()->where(['uid' => $id])->one();
        if ($info) {
            $model_user = $info;
        }else{
            $model_user = new User();
            $model_user->setSalt();
            $model_user->create_time = $date_now;
        }

        $model_user->nickname = $nickname;
        $model_user->mobile = $mobile;
        $model_user->email = $email;
        $model_user->avatar = ConstantMapService::$default_avatar;
        $model_user->login_name = $login_name;

        if ($login_pwd != ConstantMapService::$default_login_pwd) {
            $model_user->setPassword($login_pwd);
        }

        $model_user->updated_time = $date_now;
        $model_user->save(false);

        return $this->renderJson([], "操作成功~~");
    }

    //账户详情
    public function actionInfo()
    {
        $id = intval($this->get("id", 0));
        $reback_url = UrlService::buildWebUrl("/account/index");

        //如果没有id则刷新页面
        if (!$id) {
            return $this->redirect($reback_url);
        }

        $info = User::find()->where(['uid' => $id])->one();
        //如果没有找到用户信息则刷新页面
        if (!$info) {
            return $this->redirect($reback_url);
        }

        $access_list = AppAccessLog::find()->where(['uid'=>$info['uid']])
            ->orderBy(['id'=>SORT_DESC])
            ->limit(10)
            ->all();

        return $this->render("info",[
            'info' => $info,
            'access_list' => $access_list
        ]);
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