<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/16
 * Time: 14:35
 */

namespace app\common\services\applog;

use app\common\services\UtilService;
use app\models\log\AppAccessLog;
use app\models\log\AppLog;
use Symfony\Component\Yaml\Yaml;

class AppLogService
{
    public static function addErrorLog($appname, $content)
    {
        $error = \Yii::$app->errorHandler->exception;
        $model_app_log = new AppLog();
        $model_app_log->app_name = $appname;
        $model_app_log->content = $content;

        //获取IP信息存入
        $model_app_log->ip = \Yii::$app->request->getUserIP();

        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            $model_app_log->ua = $_SERVER['HTTP_USER_AGENT'];
        }

        if ($error) {
            $model_app_log->err_code = $error->getCode();
            if (isset($error->statusCode)) {
                $model_app_log->http_code = $error->statusCode;
            }

            if (method_exists($error, "getName")) {
                $model_app_log->err_name = $error->getName();
            }
        }

        $model_app_log->created_time = date('Y-m-d H:i:s');
        $model_app_log->save(0);
    }

    //记录用户访问信息
    public static function addAppAccessLog($uid = 0)
    {
        $get_param = \Yii::$app->request->get();
        $post_param = \Yii::$app->request->post();

        $target_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "";
        $referer    = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
        $ua         = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";

        $access_log = new AppAccessLog();
        $access_log->uid = $uid;
        $access_log->referer_url = $referer;
        $access_log->target_url = $target_url;
        $access_log->ua = $ua;
        $access_log->query_params = json_encode(array_merge($get_param, $post_param));
        $access_log->ip = UtilService::getIP();
        $access_log->created_time = date('Y-m-d H:i:s');

        return $access_log->save(0);

    }


}