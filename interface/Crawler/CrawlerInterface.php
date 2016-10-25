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
     * 创建队列
     * @param $cacheDB
     *
     * @return mixed
     */
    public function initQueue($cacheDB);

    /**
     * 添加任务到队列
     *
     * @param $sUrl
     *
     * @return mixed
     */
    public static function pushQueue($sUrl);

    /**
     * 取出任务
     *
     * @return mixed
     */
    public static function popQueue();

    /**
     * @return mixed
     */
    public function run();

    /**
     * 缓存数据
     * @param $func
     *
     * @return mixed
     */
    public function cache($func);
}