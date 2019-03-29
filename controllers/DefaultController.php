<?php

namespace app\controllers;

use app\common\component\BaseWebController;
use app\common\services\captcha\ValidateCode;
use yii\web\Controller;


class DefaultController extends BaseWebController
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = "main";
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

    private $captcha_cookie_name = "validate_code";

    public function actionImg_captcha()
    {
        $font_path = \Yii::$app->getBasePath() . "/web/fonts/captcha.ttf";
        $captcha_handle = new ValidateCode($font_path);
        $captcha_handle->doimg();
        $this->setCookie($this->captcha_cookie_name, $captcha_handle->getCode());
    }
}
