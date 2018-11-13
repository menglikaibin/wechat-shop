<?php

namespace app\controllers;

use app\common\component\BaseWebController;
use yii\web\Controller;


class DefaultController extends BaseWebController
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = "main";
    }


    public function actionIndex()
    {
        return $this->render('index');
    }
}
