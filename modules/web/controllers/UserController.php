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
        if (!$user_info->verifyPassword($login_pwd)) {
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
        //判断是否是get请求,如果是get请求那就展示页面
        if (\Yii::$app->request->isGet) {
            //获取当前登录人的信息

            return $this->render("edit",['user_info'=>$this->current_user]);
        }

        $nickname = trim($this->post("nickname",""));
        $email = trim($this->post("email",""));
        if (mb_strlen($nickname, "utf-8") < 1) {
            return $this->renderJson([], "请输入合法的用户名", -1);
        }

        if (mb_strlen($email, "utf-8") < 1) {
            return $this->renderJson([], "请输入合法的邮箱", -1);
        }

        $user_info = $this->current_user;
        $user_info->nickname = $nickname;
        $user_info->email = $email;
        $user_info->updated_time = date("Y-m-d H:i:s");
        $user_info->update(0);
        return $this->renderJson([],"编辑成功");



    }

    //重置密码
    public function actionResetPwd()
    {
        if (\Yii::$app->request->isGet) {
            return $this->render('reset_pwd',[
               'user_info' => $this->current_user
            ]);
        }
        $user_info = $this->current_user;

        $old_password = trim($this->post("old_password"));
        $new_password = trim($this->post("new_password"));

        if (mb_strlen($old_password < 1)) {
            return $this->renderJson([], "请输入原密码", -1);
        }
        if (mb_strlen($new_password < 6)) {
            return $this->renderJson([], "请输入一个不小于6位的新密码", -1);
        }


        //判断原密码是否正确
        if (!$user_info->verifyPassword($old_password)) {
            return $this->renderJson([], "请输入正确的原密码~~", -1);
        }

        $user_info->setPassword($new_password);
        $user_info->updated_time = date('Y-m-d H:i:s');

        $user_info->update(0);
        //更新cookie
        $this->setLoginStatus($user_info);

        return $this->renderJson([], "重置密码成功~~", 200);
    }

    //用户退出
    public function actionLogout()
    {
        $this->removeLoginStatus();
        return $this->redirect(UrlService::buildWebUrl("/user/login"));
    }
}