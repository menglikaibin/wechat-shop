<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 15:47
 */
namespace app\modules\web\controllers;

use yii\web\Controller;

class AccountController extends Controller
{
    //账户列表
    public function actionIndex()
    {
        $this->layout = false;

        return $this->render("index");
    }

    //账户编辑或添加
    public function actionSet()
    {
        $this->layout = false;

        return $this->render("set");
    }

    //账户详情
    public function actionInfo()
    {
        $this->layout = false;

        return $this->render("info");
    }
}