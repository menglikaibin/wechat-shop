<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/16
 * Time: 14:35
 */

namespace app\common\services\applog;

use app\common\services\UrlService;
use app\common\services\UtilService;
use app\models\log\AppLog;
use SebastianBergmann\CodeCoverage\Util;

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
    }

}