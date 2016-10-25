<?php
/**
 * Created by PhpStorm.
 * User: lyang
 * Date: 2016/10/25
 * Time: 12:13
 */

namespace YangakwInterface\Page;


interface PageInterface
{
    /**
     * @param $url
     *
     * @return mixed
     */
    public function getData($url);

    /**
     * @param $url
     *
     * @return mixed
     */
    public function getUrlName($url);

    /**
     * @return mixed
     */
    public function getPageDir();

    /**
     * 获取页面
     *
     * @param $url
     *
     * @return mixed
     */
    public static function getPage($url);

    /**
     * @param $dir
     *
     * @return mixed
     */
    public static function setDir($dir);

    /**
     * @return mixed
     */
    public static function getDir();

}