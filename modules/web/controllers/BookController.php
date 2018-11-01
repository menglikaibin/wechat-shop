<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 16:02
 */
namespace app\modules\web\controllers;

use yii\web\Controller;

class BookController extends Controller
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

    public function actionInfo()
    {
        $this->layout = false;

        return $this->render("info");
    }

    public function actionImages()
    {
        $this->layout = false;

        return $this->render("images");
    }

    //分类列表
    public function actionCat()
    {
        $this->layout = false;

        return $this->render("cat");
    }

    //分类列表设置
    public function actionCatSet()
    {
        $this->layout = false;

        return $this->render("cat_set");
    }
}