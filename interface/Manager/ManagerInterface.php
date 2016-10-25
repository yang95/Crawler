<?php
/**
 * Created by PhpStorm.
 * User: lyang
 * Date: 2016/10/25
 * Time: 12:12
 */

namespace YangakwInterface\Manager;


interface ManagerInterface
{
    /**
     * 添加抓取对象
     * @param $func
     *
     * @return mixed
     */
    public static function  Crawler($func);
}