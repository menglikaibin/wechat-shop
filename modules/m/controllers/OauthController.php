<?php

namespace app\modules\m\controllers;


use app\common\component\HttpClient;
use app\common\services\UrlService;
use app\modules\m\controllers\common\BaseController;

class OauthController extends BaseController
{
    //登录
    public function actionLogin()
    {
        $scope = $this->get("scope", "snsapi_base");
        $appid = \Yii::$app->params['weixin']['appid'];
        $redirect_uri = UrlService::buildMUrl("oauth/call-back");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}&state=STATE#wechat_redirect";
        return $this->redirect($url);
    }

    public function actionCallBack()
    {
        $code = $this->get("code", "");
        if (!$code) {
            return $this->goHome();
        }
        $appid = \Yii::$app->params['weixin']['appid'];
        $app_secret = \Yii::$app->params['weixin']['sk'];

        //通过code获取网页授权的access_token
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$app_secret}&code={$code}&grant_type=authorization_code";

        $ret = HttpClient::get($url);
        $ret = @json_decode($ret, true);
        $res_token = isset($ret['access_token']) ? $ret['access_token'] : "";
        if (!$res_token) {
            return $this->goHome();
        }

        $openid = isset($ret['openid']) ? $ret['openid'] : "";
        $scope = isset($ret['scope']) ? $ret['scope'] : "";

        if ($scope == 'snsapi_userinfo') {
            $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$res_token}&openid={$openid}&lang=zh_CN";
        }

        $wechat_userinfo = HttpClient::get($url);
        var_dump($wechat_userinfo);die;

        //通过code获取网页授权的access_token
        return "i am back";
    }
}