<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 16:16
 */
namespace app\modules\web\controllers;

use app\modules\web\controllers\common\BaseController;

class MemberController extends BaseController
{
    public function actionIndex()
    {

        return $this->render("index");
    }

    public function actionInfo()
    {

        return $this->render("info");
    }

    public function actionSet()
    {

        return $this->render("set");
    }

    public function actionComment()
    {

        return $this->render("comment");
    }
}