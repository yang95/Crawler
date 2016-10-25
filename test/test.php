<?php
/**
 * Created by PhpStorm.
 * User: lyang
 * Date: 2016/10/25
 * Time: 14:11
 */
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
Crawler::pushQueue("http://yangakw.cn");
$iErr     = null;
$suFunc   = function ($url) {
    $page = Manager::Page();
    $page->setDir(__DIR__ . "/tmp");
    $dom = Manager::Dom($page->getData($url));
    echo $dom->find("title", 0)->plaintext;
};
$iCrawler = Manager::Crawler($suFunc, $iErr);

$iCrawler->cache(function ($url) {
    $page = Manager::Page();
    $data = $page->getData($url);
});