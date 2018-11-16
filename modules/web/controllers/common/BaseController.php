<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/16
 * Time: 11:21
 */

namespace app\modules\web\controllers\common;


use app\common\component\BaseWebController;
use app\common\services\UrlService;
use app\models\User;

//web统一控制器中做一些web独有的验证
//1:指定特定的布局文件2:登录验证
class BaseController extends BaseWebController
{
    protected $auth_cookie_name = "mooc_book";

    public $allowAllAction = [
        "web/user/login"
    ];

    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }


    public function beforeAction($action)
    {
        //验证是否登录
        $is_login = $this->checkLoginStatus();

        if (in_array($action->getUniqueId(), $this->allowAllAction)) {
            return true;
        }

        if (!$is_login) {
            if (\Yii::$app->request->isAjax) {
                $this->renderJson([], "未登录,请先登录~~", -302);
            } else {
                $this->redirect(UrlService::buildWebUrl('/user/login'));
            }
            return false;
        }

        return true;

    }

    /**
     * 验证当前登录状态是否有效
     */
    public function checkLoginStatus()
    {
        $auth_cookie = $this->getCookie($this->auth_cookie_name);
        if (!$auth_cookie) {
            return false;
        }

        list($auth_token, $uid) = explode("#", $auth_cookie);
        if (!$auth_token || !$uid) {
            return false;
        }

        if (!preg_match("/^\d+$/", $uid)) {
            return false;
        }

        $user_info = User::find()->where(['uid'=>$uid])->one();
        if (!$user_info) {
            return false;
        }

        $auth_token_md5 = $this->generateAuthToken($user_info);
        if ($auth_token != $auth_token_md5) {
            return false;
        }
        return true;

    }


    //设置登录状态的方法
    public function setLoginStatus($user_info)
    {
        $auth_token = $this->generateAuthToken($user_info);
        $this->setCookie($this->auth_cookie_name, $auth_token . "#" . $user_info['uid']);
    }


    //移除登录状态
    public function removeLoginStatus()
    {
        $this->removeCookie($this->auth_cookie_name);
    }


    //统一生成加密字段
    public function generateAuthToken($user_info)
    {
        return md5($user_info['login_name'].$user_info['login_pwd'].$user_info['login_salt']);
    }
}