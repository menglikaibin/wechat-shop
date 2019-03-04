<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 2018/11/16
 * Time: 14:39
 */

namespace app\common\services;


//只封装通用方法
use yii\helpers\Html;

class UtilService
{
    public static function getIP()
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $_SERVER['REMOTE_ADDR'];
    }

    public static function encode($display)
    {
        return Html::encode($display);
    }

    public static function getRootPath()
    {
        return dirname(\Yii::$app->vendorPath);
    }

    public static function ipagination($param)
    {
//        print_r($param);die;
        $ret = [
            'previous'  => true,
            'next'      => true,
            'from'      => 0,
            'end'       => 0,
            'total_page'=> 0,
            'current'   => 0,
            'page_size' => intval($param['page_size'])!==null ? intval($param['page_size']) : 10,
            'offset'    => 0
        ];

        //用户总数
        $total = (int)$param['total_count'];
        //单页数量
        $pageSize = (int)$param['page_size'];
        //当前页
        $page  = (int)$param['page'];
        $display = (int)$param['display'];
        $total_page = (int)ceil($total / $pageSize);
        $total_page = $total_page ? $total_page : 1;

        if ($page < 1) {
            $ret['previous'] = false;
        }
        if ($page >= $total_page) {
            $ret['next'] = false;
        }
        $semi = (int)ceil($display / 2);
        if ($page - $semi > 0) {
            $ret['from'] = $page - $semi;
        } else {
            $ret['from'] = 1;
        }

        if ($page + $semi <= $total_page) {
            $ret['end'] = $page + $semi;
        } else {
            $ret['end'] = $total_page;
        }

        $ret['total_count'] = $total;
        $ret['total_page'] = $total_page;
        $ret['current'] = $page;
        $ret['offset'] = max([0, ($page - 1) * $ret['page_size']]);
        return $ret;
    }
}