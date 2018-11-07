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
        $this->layout = "main";

        return $this->render("info");
    }

    public function actionSet()
    {
        $this->layout = "main";

        return $this->render("set");
    }

    public function actionImages()
    {
        $this->layout = "main";

        return $this->render("images");
    }
}