<?php
/**
 * Created by PhpStorm.
 * User: lyang
 * Date: 2016/10/25
 * Time: 14:11
 */
date_default_timezone_set("Asia/Shanghai");
require_once "../vendor/autoload.php";
use Yangakw\Manager\Manager;
use \Yangakw\Crawler\Crawler;
use \Yangakw\Page\Page;

/*
 * Manager
 * Crawler
 * Page
 * Dom
 */
$redis = new Redis();
$redis->connect("127.0.0.1");
$iUrl     = "http://36kr.com/";
$iErr     = null;
$DEEP     = 3;
$suFunc   = function ($url, $tree_deep) use ($iErr, &$suFunc, $redis, $DEEP) {
    $page = Manager::Page(__DIR__ . "/page" . date("Y-m-d"));
    $dom  = Manager::Dom($page->getData($url));
    if (empty($dom)) {
        return;
    }
    $a    = $dom->find("a");
    $list = [];
    if ($tree_deep >= $DEEP) {
        return;
    }
    foreach ($a as $val) {
        $iUrl = Manager::tidyUrl($val->href, $url);
        Manager::push($redis, $iUrl);
    }
    $tree_deep++;

    echo $tree_deep . $url . "________\n";
    while ($iUrl = Manager::pop($redis)) {
        $iCrawler = Manager::Crawler($suFunc, $iUrl, $tree_deep, $iErr);
        $iCrawler->run();
        unset($iCrawler);
    }
    unset($page);
    unset($dom);
};
$iCrawler = Manager::Crawler($suFunc, $iUrl, 1, $iErr);
$iCrawler->run();
/*$iCrawler->cache(function ($iUrl) {
    $page = Manager::Page( __DIR__ . "/page" . date("Y-m-d") );
    $data = $page->getData($iUrl);
});*/