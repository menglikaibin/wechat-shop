<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 17:23
 */
namespace app\modules\m\controllers;

use yii\web\Controller;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $this->layout = false;

        return $this->render("index");
    }

    public function actionInfo()
    {
        $this->layout = false;

        return $this->render("info");
    }
}