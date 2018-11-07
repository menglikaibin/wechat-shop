<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/6
 * Time: 17:24
 */
namespace app\modules\m\controllers;

use yii\web\Controller;

class PayController extends Controller
{
    public function actionBuy()
    {
        $this->layout = false;

        return $this->render("buy");
    }


}