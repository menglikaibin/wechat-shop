<?php

namespace app\modules\weixin\controllers;

use app\common\component\BaseWebController;
use app\models\book\Book;
use app\models\book\BookCat;
use yii\log\FileTarget;

class MsgController extends BaseWebController
{
    //接受微信请求
    public function actionIndex()
    {
        //加密验证
//        if (!$this->checkSignature()) {
//            return "error signature";
//        }
//
//        if (array_key_exists("echostr", $_GET) && $_GET['echostr']) {
//            return $_GET['echostr'];//用于微信第一次认证
//        }

        //获取post的xml数据,很多设置了register_globals禁止_GLOBAL方法
        $xml_data = file_get_contents("php://input");

        $this->record_log("[xml_data]:" . $xml_data);
        if (!$xml_data) {
            return "error xml";
        }
        $xml_obj = simplexml_load_string($xml_data, "SimpleXMLElement", LIBXML_NOCDATA);
        $from_name = $xml_obj->FromUserName;
        $to_name = $xml_obj->ToUserName;
        $type = $xml_obj->MsgType;

        switch ($type)
        {
            case "text":
                $kw = trim($xml_obj->Content);
                break;
            case "event":

                break;
        }

        return "hello world";
    }

    private function search($kw)
    {
        $query = Book::find()->where(['status' => 1]);
        $where_name = ['like', 'name', $kw];
        $where_tag = ['like', 'tags', $kw];
        $res = $query->andWhere(['or', $where_name, $where_tag])->orderBy('id DESC')->all();
        return $res;
    }

    public function checkSignature()
    {
        $signature = trim($this->get("signature", ""));
        $timestamp = trim($this->get("timestamp", ""));
        $nonce = trim($this->get("nonce", ""));
        $tmpArr = array(\Yii::$app->params['weixin']['app_token'], $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    public function record_log($msg)
    {
        $log = new FileTarget();
        $log->logFile = \Yii::$app->getRuntimePath() . "/logs/weixin_msg_" . date('Ymd') . ".log";
        $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "";
        $log->messages[] = [
            "[url:{$request_uri}][post:" . http_build_query($_POST) . "][" . $msg . "]",
            1,
            'application',
            microtime( true )
        ];
        $log->export();
    }

}