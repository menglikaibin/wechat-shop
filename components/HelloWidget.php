<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/9
 * Time: 15:50
 */
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class HelloWidget extends Widget
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        ob_start();
    }

    public function run()
    {
        $content = ob_get_contents();
        return Html::encode($content);
    }
}