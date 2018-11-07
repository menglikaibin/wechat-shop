<?php

namespace app\controllers;

use yii\web\Controller;


class DefaultController extends Controller
{
    public function actionIndex()
    {
//        $this->layouts = false;
        return $this->render('index');
    }
}
