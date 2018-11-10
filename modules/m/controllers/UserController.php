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
        $this->layout = "user";

        return $this->render("bind");
    }

    //用户购物侧
    public function actionCart()
    {
        $this->layout = "user";

        return $this->render("cart");
    }

    //用户订单列表
    public function actionOrder()
    {
        $this->layout = "user";

        return $this->render("order");
    }

    //我的
    public function actionIndex()
    {
        $this->layout = "user";

        return $this->render("index");
    }

    //我的地址
    public function actionAddress()
    {
        $this->layout = "user";

        return $this->render("address");
    }

    //编辑或添加地址
    public function actionAddress_set()
    {
        $this->layout = "user";

        return $this->render("address_set");
    }

    //我的收藏
    public function actionFav()
    {
        $this->layout = "user";

        return $this->render("fav");
    }

    //评论列表
    public function actionComment()
    {
        $this->layout = "user";

        return $this->render("comment");
    }

    //添加评论
    public function actionComment_set()
    {
        $this->layout = "user";

        return $this->render("comment_set");
    }
}