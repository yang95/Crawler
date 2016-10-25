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

Crawler::pushQueue("http://yangakw.cn");
$iErr     = null;
$page     = Manager::Page();
$success  = function ($iErr, $url) use ($page) {

    $page->setDir(__DIR__ . "/tmp");
    $data = $page->getData($url);
    $dom = Manager::Dom($data);
    echo $dom->find("title",0)->plaintext;
};
$iCrawler = Manager::Crawler($success);

$iCrawler->run();