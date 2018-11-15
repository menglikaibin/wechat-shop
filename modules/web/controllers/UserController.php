<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19
 * Time: 11:43
 */
namespace app\modules\web\controllers;

use app\common\component\BaseWebController;

class UserController extends BaseWebController
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = "main";
    }

    //登录页面
    public function actionLogin()
    {
        $this->layout = false;

        if (\Yii::$app->request->isGet) {
            return $this->render("login");
        }

        //登录逻辑处理

    }

    //编辑登录人信息
    public function actionEdit()
    {
        return $this->render("edit");
    }

    //重置密码
    public function actionResetPwd()
    {
        return $this->render("reset_pwd");
    }
}