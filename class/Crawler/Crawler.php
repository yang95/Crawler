<?php
/**
 * Created by PhpStorm.
 * User: lyang
 * Date: 2016/10/25
 * Time: 12:36
 */

namespace Yangakw\Crawler;


use YangakwInterface\Crawler\CrawlerInterface;
use YangakwInterface\Page\PageInterface;

class Crawler implements CrawlerInterface
{
    protected $cacheDB;
    protected $errCacheDB;
    protected static $Queue = [];

    public function initQueue($cacheDB, $errCacheDB = null)
    {
        // TODO: Implement initQueue() method.
        $this->cacheDB    = $cacheDB;
        $this->errCacheDB = $errCacheDB;
    }

    /**
     * @param $sUrl
     *
     * @return mixed
     */
    public static function pushQueue($sUrl)
    {
        // TODO: Implement pushQueue() method.
        if ($sUrl) {
            array_push(self::$Queue, $sUrl);
        }
        return $sUrl;
    }

    /**
     * @return mixed|null
     */
    public static function popQueue()
    {
        // TODO: Implement popQueue() method.
        $sUrl = array_pop(self::$Queue);
        return empty($sUrl) ? null : $sUrl;
    }

    /**
     * @return int
     */
    public function run()
    {
        $rUrl = $this->popQueue();
        $i    = 0;
        while (!(empty($rUrl))) {
            call_user_func($this->cacheDB,$this->errCacheDB, $rUrl);
            $rUrl = $this->popQueue();
            $i++;
        }
        return $i;
    }

    public function cache(PageInterface $page)
    {
        // TODO: Implement cache() method.
        $rUrl = $this->popQueue();
        $i    = 0;
        while (!(empty($rUrl))) {
            $page->getData($rUrl);
            $rUrl = $this->popQueue();
            $i++;
        }
        return $i;
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        echo "no method";
    }

}