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
    const KEY_REDIS = "crawler_ols";
    const EXIST     = 1;
    public static $LIST = [];

    /**
     * @param $func
     * @param $url
     * @param $errFunc
     *
     * @return Crawler
     */
    public static function Crawler($func, $url,$i, $errFunc)
    {
        $iCrawler = new Crawler();
        $iCrawler->init($func, $url, $i,$errFunc);
        return $iCrawler;
    }

    public static function Dom($str)
    {
        return HtmlDomParser::str_get_html($str);
    }

    public static function Page($p = null)
    {
        if (empty($p)) {
            exit("please config page cache dir");
        }
        $page = new Page();
        $page->setDir($p);
        return $page;
    }

    public static function pop(\Redis $redis)
    {
        return $redis->lpop(self::KEY_REDIS);
    }

    public static function push(\Redis $redis, $url)
    {
        if (!isset(self::$LIST[$url])) {
            self::$LIST[$url] = self::EXIST;
            echo $url . "\n";
            $redis->lpush(self::KEY_REDIS, $url);
        }
    }

    /**
     * @param      $sUrl
     * @param null $sBaseUrl
     *
     * @return string
     */
    public static function tidyUrl($sUrl, $sBaseUrl = null)
    {
        $aBlock = parse_url($sUrl);
        if (isset($aBlock['scheme'])) {
            return $sUrl;
        }
        $aBlock = parse_url($sBaseUrl);
        if ($sUrl[0] === '/') {
            return sprintf(
                '%s://%s%s',
                $aBlock['scheme'],
                $aBlock['host'],
                $sUrl
            );
        } else {
            return sprintf(
                '%s://%s%s/%s',
                $aBlock['scheme'],
                $aBlock['host'],
                isset($aBlock['path']) ? dirname($aBlock['path']) : '',
                $sUrl
            );
        }
    }

    /**
     * @param $value
     *
     * @return string
     */
    public static function term_replace($value)
    {
        $re = str_replace("'", "’", $value);
        $re = str_replace("&nbsp;", " ", $re);
        return trim($re);
    }
}