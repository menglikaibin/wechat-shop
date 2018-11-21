<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 15:47
 */
namespace app\modules\web\controllers;

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
        $list = User::find()->orderBy(['uid' => SORT_DESC])->all();
        return $this->render("index",[
            'list' => $list,
            ''
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