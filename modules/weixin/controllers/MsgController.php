<?php

namespace app\modules\weixin\controllers;

use app\common\component\BaseWebController;

class MsgController extends BaseWebController
{
    //接受微信请求
    public function actionIndex()
    {
        //加密验证
        if (!$this->checkSignature()) {
            return "error signature";
        }

        if (array_key_exists("echostr", $_GET) && $_GET['echostr']) {
            return $_GET['echostr'];//用于微信第一次认证
        }
        return;
    }

    public function checkSignature()
    {
        $signature = trim($this->get("signature", ""));
        $timestamp = trim($this->get("timestamp", ""));
        $nonce = trim($this->get("nonce", ""));
        $tmpArr = array(\Yii::$app->params['weixin']['token'], $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

}