<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 16:16
 */
namespace app\modules\web\controllers;

use yii\web\Controller;

class MemberController extends Controller
{
    public function actionIndex()
    {
        $this->layout = "main";

        return $this->render("index");
    }

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

    public function actionComment()
    {
        $this->layout = "main";

        return $this->render("comment");
    }
}