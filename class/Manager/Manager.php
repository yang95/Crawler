<?php
/**
 * Created by PhpStorm.
 * User: lyang
 * Date: 2016/10/25
 * Time: 14:07
 */

namespace Yangakw\Manager;


use Yangakw\Crawler\Crawler;
use Yangakw\Page\Page;
use YangakwInterface\Manager\ManagerInterface;
use Sunra\PhpSimple\HtmlDomParser;

class Manager implements ManagerInterface
{
    /**
     * @param $func
     *
     * @return Crawler
     */
    public static function Crawler($func)
    {
        $iCrawler = new Crawler();
        $iCrawler->initQueue($func);
        return $iCrawler;
    }

    public static function Dom($str)
    {
        return HtmlDomParser::str_get_html($str);
    }
    public static function Page(){
        return new Page();
    }
}