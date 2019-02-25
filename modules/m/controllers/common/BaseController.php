<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2019/2/25
 * Time: 18:57
 */
namespace app\modules\m\controllers\common;

use app\common\component\BaseWebController;

class BaseController extends BaseWebController
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = "main";
    }

    public function beforeAction($action)
    {
        return true;
    }
}