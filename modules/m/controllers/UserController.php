<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 16:52
 */
namespace app\modules\m\controllers;

use yii\web\Controller;

class UserController extends Controller
{
    public function actionBind()
    {
        $this->layout = false;

        return $this->render("bind");
    }
}