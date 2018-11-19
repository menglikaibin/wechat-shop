<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/13
 * Time: 10:01
 */
namespace app\common\component;

use yii\web\Controller;

/**
 * Class BaseWebController
 * @package app\common\component
 * 集成常用公用方法 提供给所有Controller使用
 * get,post,setCookie,getCookie,removeCookie,rendJson
 */
class BaseWebController extends Controller
{
    public $enableCsrfValidation = false; //关闭csrf,常用攻击手段

    //获取http的get参数
    public function get($key, $default_val = "")
    {
        return \Yii::$app->request->get($key, $default_val);
    }

    //获取http的post参数
    public function post($key, $default_val = "")
    {
        return \Yii::$app->request->post($key, $default_val);
    }

    //设置cookie值
    public function setCookie($name, $value, $expire = 0)
    {
        $cookie = \Yii::$app->response->cookies;
        $cookie->add(new \yii\web\Cookie([
            'name' => $name,
            'value' => $value,
            'expire' => $expire
        ]));
    }

    //获取cookie
    public function getCookie($name, $default = "")
    {
        $cookie = \Yii::$app->request->cookies;
        return $cookie->getValue($name, $default);
    }

    //移除cookie
    public function removeCookie($name)
    {
        $cookie = \Yii::$app->response->cookies;
        $cookie->remove($name);
    }

    //api统一返回json格式方法
    public function renderJson($data = [], $msg = 'ok', $code = 200)
    {
        header("Content-type: application/json");
        echo json_encode([
            "code" => $code,
            "msg" => $msg,
            "data" => $data,
            "req_id" => uniqid()
        ]);
    }

    //返回js信息
    public function renderJs($msg, $url)
    {
        return $this->renderPartial("@app/views/common/js", ['msg' => $msg, 'url' => $url]);
    }

}