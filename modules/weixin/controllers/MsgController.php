<?php

namespace app\modules\weixin\controllers;

use app\common\component\BaseWebController;
use app\common\services\UrlService;
use app\models\book\Book;
use app\models\book\BookCat;
use yii\log\FileTarget;

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

        $res = ['type'=>"text", 'data'=>$this->defaultTip()];

        switch ($type)
        {
            case "text":
                $kw = trim($xml_obj->Content);
                $res = $this->search($kw);
                break;
            case "event":

                break;
        }

        switch ($res['type']) {
            case "text":
                $this->textTpl($from_name, $to_name, $res['data']);
                break;
            case "rich":
                $this->richTpl($from_name, $to_name, $res['data']);
                break;
        }

        return "hello world";
    }

    /**
     * @param $kw
     * @return array|\yii\db\ActiveRecord[]
     * 模糊查询名字和标签
     */
    private function search($kw)
    {
        $query = Book::find()->where(['status' => 1]);
        $where_name = ['like', 'name', $kw];
        $where_tag = ['like', 'tags', $kw];
        $res = $query->andWhere(['or', $where_name, $where_tag])->orderBy(['id'=>SORT_DESC])->limit(3)->all();
        $data = $res ? $this->getRichXml($res) : $this->defaultTip();
        $type = $res ? "rich" : "text";
        return ['type'=>$type, 'data'=>$data];
    }

    /**
     * @param $from_name
     * @param $to_name
     * @param $content
     * @return string
     * 回复文本消息
     */
    private function textTpl($from_name, $to_name, $content)
    {
        $tpl = <<<EOT
        <xml>
          <ToUserName><![CDATA[%s]]></ToUserName>
          <FromUserName><![CDATA[%s]]></FromUserName>
          <CreateTime>%s</CreateTime>
          <MsgType><![CDATA[text]]></MsgType>
          <Content><![CDATA[%s]]></Content>
        </xml>
EOT;
        return sprintf($tpl, $from_name, $to_name, time(), $content);

    }

    /**
     * @param $from_name
     * @param $to_name
     * @param $data
     * @return string
     * 回复图文消息
     */
    private function richTpl($from_name, $to_name, $data)
    {
        $tpl = <<<EOT
        <xml>
          <ToUserName><![CDATA[%s]]></ToUserName>
          <FromUserName><![CDATA[%s]]></FromUserName>
          <CreateTime>%s</CreateTime>
          <MsgType><![CDATA[news]]></MsgType>
          %s
        </xml>
EOT;
        return sprintf($tpl, $from_name, $to_name, time(), $data);
    }

    private function getRichXml($list)
    {
        $article_count = count($list);
        $article_content = "";
        foreach ($list as $item) {
            $tmp_description = mb_substr(strip_tags($item['summary']), 0, 20, "utf-8");
            $tmp_pic_url = UrlService::buildPicUrl("book", $item['main_image']);
            $tmp_url = UrlService::buildMUrl("/product/info", ['id'=>$item['id']]);
            $article_content .=
                "<item>
                  <Title><![CDATA[{$item['name']}]]></Title>
                  <Description><![CDATA[{$tmp_description}]]></Description>
                  <PicUrl><![CDATA[{$tmp_pic_url}]]></PicUrl>
                  <Url><![CDATA[{$tmp_url}]]></Url>
                </item>";
        }

        $article_body = "<ArticleCount>%s</ArticleCount><Articles>%s</Articles>";
        return sprintf($article_body, $article_count, $article_content);
    }

    private function defaultTip()
    {
        $resData = <<<EOT
没找你你想要的东西:(\n
EOT;
        return $resData;

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