<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 16:28
 */
namespace app\modules\web\controllers;

use yii\web\Controller;

class FinanceController extends Controller
{
    public function actionIndex()
    {
        $this->layout = "main";

        return $this->render("index");
    }

    public function actionPay_info()
    {
        $this->layout = "main";

        return $this->render("pay-info");
    }

    public function actionAccount()
    {
        $this->layout = "main";

        return $this->render("account");
    }
}