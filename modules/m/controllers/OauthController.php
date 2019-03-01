<?php

namespace app\modules\m\controllers;


use app\common\services\UrlService;
use app\modules\m\controllers\common\BaseController;

class OauthController extends BaseController
{
    public function actionLogin()
    {
        $scope = $this->get("scope", "snsapi_base");
        $appid = \Yii::$app->params['weixin']['appid'];
        $redirect_uri = UrlService::buildWebUrl("oauth/call-back");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}&state=STATE#wechat_redirect";

        $this->redirect($url);
    }

    public function actionCallBack()
    {
//        $code = $this->get("code", "");
//        if (!$code) {
//            return $this->goHome();
//        }

        //通过code获取网页授权的access_token
        return "i am back";
    }
}