<?php

/**
 * Created by PhpStorm.
 * User: lyang
 * Date: 2016/10/25
 * Time: 12:09
 */
namespace YangakwInterface\Crawler;

use YangakwInterface\Page\PageInterface;

interface CrawlerInterface
{
    /**
     * @param      $cacheDB
     * @param      $rUrl
     * @param      $i
     * @param null $errCacheDB
     *
     * @return mixed
     */
    public function init($cacheDB, $rUrl,$i, $errCacheDB = null);


    /**
     * @return mixed
     */
    public function run();

    /**
     * 缓存数据
     *
     * @param $func
     *
     * @return mixed
     */
    public function cache($func);
}