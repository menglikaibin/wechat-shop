<?php

namespace app\modules\m\controllers;

use yii\web\Controller;
use yii\imagine\Image;

/**
 * Default controller for the `m` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
//        print_r(Image::$driver);
//        return $this->render('index');
        $this->layout = "main";

        return $this->render("index");
    }
}
