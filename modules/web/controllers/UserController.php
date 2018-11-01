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
        return $this->render("login");
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