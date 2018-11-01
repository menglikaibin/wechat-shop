<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 16:35
 */
namespace app\modules\web\controllers;

use yii\web\Controller;

class QrcodeController extends Controller
{
    public function actionIndex()
    {
        $this->layout = false;

        return $this->render("index");
    }

    public function actionSet()
    {
        $this->layout = false;

        return $this->render("set");
    }
}