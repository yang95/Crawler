<?php
/**
 * Created by PhpStorm.
 * User: lyang
 * Date: 2016/10/25
 * Time: 12:36
 */

namespace Yangakw\Crawler;


use YangakwInterface\Crawler\CrawlerInterface;

class Crawler implements CrawlerInterface
{
    protected $cacheDB;
    protected $errCacheDB;
    protected $iUrl;
    protected $Deep;

    public function init($cacheDB, $rUrl, $i, $errCacheDB = null)
    {
        // TODO: Implement initQueue() method.
        $this->cacheDB    = $cacheDB;
        $this->iUrl       = $rUrl;
        $this->Deep       = $i;
        $this->errCacheDB = $errCacheDB;
    }


    /**
     * @return mixed
     */
    public function run()
    {
        if (empty($this->cacheDB)) {
            return 0;
        }
        return call_user_func($this->cacheDB, $this->iUrl, $this->Deep);
    }

    /**
     * @param $func
     *
     * @return mixed
     */
    public function cache($func)
    {
        return call_user_func($func, $this->iUrl);
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        echo "no method";
    }

}