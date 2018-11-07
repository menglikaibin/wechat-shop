<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19
 * Time: 11:43
 */
namespace app\modules\web\controllers;

use yii\web\Controller;

class UserController extends Controller
{
    //登录页面
    public function actionLogin()
    {
        $this->layout = false;

        return $this->render("login");
    }

    //编辑登录人信息
    public function actionEdit()
    {
        $this->layout = "main";

        return $this->render("edit");
    }

    //重置密码
    public function actionResetPwd()
    {
        $this->layout = "main";

        return $this->render("reset_pwd");
    }
}