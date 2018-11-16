<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/1
 * Time: 16:43
 */
namespace app\modules\web\controllers;

use app\modules\web\controllers\common\BaseController;
use yii\web\Controller;

class DashboardController extends BaseController
{
    public function actionIndex()
    {
        $this->layout = "main";

        return $this->render("index");
    }
}