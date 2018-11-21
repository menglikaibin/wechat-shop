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

        $query = User::find();

        if ($status > ConstantMapService::$status_default) {
            $query->andWhere(['status' => $status]);
        }

        if ($mix_kw) {
            $where_nickname = ['like', 'nickname', '%'.$mix_kw.'%',false];
            $where_mobile = ['like', 'mobile', '%'.$mix_kw.'%', false];
            $query->andWhere(['or', $where_nickname, $where_mobile]);
        }


        $list = $query->orderBy(['uid' => SORT_DESC])->all();
        return $this->render("index",[
            'list' => $list,
            'status_mapping' => ConstantMapService::$status_mapping,
            'search_status' => [
                'status' => $status,
                'mix_kw' => $mix_kw
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
}