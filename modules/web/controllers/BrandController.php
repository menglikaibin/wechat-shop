<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 15:56
 */
namespace app\modules\web\controllers;

use yii\web\Controller;

class BrandController extends Controller
{
    public function actionInfo()
    {
        $this->layout = false;

        return $this->render("info");
    }

    public function actionSet()
    {
        $this->layout = false;

        return $this->render("set");
    }

    public function actionImages()
    {
        $this->layout = false;

        return $this->render("images");
    }
}