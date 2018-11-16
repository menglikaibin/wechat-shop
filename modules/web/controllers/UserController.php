<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/19
 * Time: 11:43
 */
namespace app\modules\web\controllers;

use app\common\services\UrlService;
use app\models\User;
use app\modules\web\controllers\common\BaseController;

class UserController extends BaseController
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
//        var_dump($this->post(null));
        $login_name = trim($this->post("login_name",""));
        $login_pwd = trim($this->post("login_pwd"));


        //验证
        if (!$login_name || !$login_pwd) {
            return $this->renderJs("请输入正确的用户名和密码~~1",UrlService::buildWebUrl('/user/login'));
        }

        //业务逻辑判断
        $user_info = User::find()->where(['login_name'=>$login_name])->one();
        if (!$user_info) {
            return $this->renderJs("请输入正确的用户名和密码~~2",UrlService::buildWebUrl('/user/login'));
        }

        //验证密码
        //密码加密算法 = md5(login_pwd + md5(login_salt))
        $pwd = md5($login_pwd . md5($user_info['login_salt']));
        if ($pwd != $user_info['login_pwd']) {
            return $this->renderJs("请输入正确的用户名和密码~~3",UrlService::buildWebUrl('/user/login'));
        }

        //使用cookie保存登录人信息
        //token加密算法 md5(login_name + login_pwd + login_salt);
        $this->setLoginStatus($user_info);
        return $this->redirect(UrlService::buildWebUrl("/dashboard/index"));
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

    //用户退出
    public function actionLogout()
    {
        $this->removeLoginStatus();
        return $this->redirect(UrlService::buildWebUrl("/user/login"));
    }
}