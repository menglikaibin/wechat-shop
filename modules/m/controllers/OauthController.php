<?php

namespace app\modules\m\controllers;


use app\common\services\UrlService;
use app\modules\m\controllers\common\BaseController;

class OauthController extends BaseController
{
    //登录
    public function actionLogin()
    {
        $scope = $this->get("scope", "snsapi_base");
        $appid = \Yii::$app->params['weixin']['appid'];
        $redirect_uri = UrlService::buildMUrl("oauth/callback");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?
        appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}&state=STATE#wechat_redirect";

        echo $url;die;
    }

    public function actionCallBack()
    {

    }
}