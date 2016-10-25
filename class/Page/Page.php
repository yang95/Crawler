<?php

/**
 * Created by PhpStorm.
 * User: lyang
 * Date: 2016/10/25
 * Time: 12:30
 */
namespace Yangakw\Page;

use YangakwInterface\Page\PageInterface;

class Page implements PageInterface
{
    private static $dir = "/page_cache/";

    public function getData($url)
    {
        $urlName = $this->getUrlName($url);
        if (is_file($urlName)) {
            goto END;
        } else {
            $content = self::getPage($url);
            file_put_contents($urlName, $content);
        }
        END:
        return file_get_contents($urlName);
    }

    public function getUrlName($url)
    {
        $url = str_replace("\\", "-", $url);
        $url = str_replace("/", "-", $url);
        $url = str_replace("?", "-", $url);
        $url = str_replace("<", "-", $url);
        $url = str_replace(">", "-", $url);
        $url = str_replace(":", "-", $url);
        $url = str_replace("*", "-", $url);
        $url = str_replace("|", "-", $url);
        $url = str_replace('"', "-", $url);
        if (empty($path)) {
            return $this->getPageDir() . "/" . $url . ".html";
        } else {
            return $path . "/" . $url . ".html";
        }
    }

    public function getPageDir()
    {
        if (!is_dir($this->getDir())) {
            if (!mkdir($this->getDir())) {
                exit("can not mkdir page_dir");
            }
        }
        return $this->getDir();
    }

    public static function getPage($url)
    {
        // TODO: Implement getPage() method.
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT,
            'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curl, CURLOPT_REFERER, "http://XXX");
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        return $data;
    }

    /**
     * @return string
     */
    public static function getDir()
    {
        return self::$dir;
    }

    /**
     * @param string $dir
     */
    public static function setDir($dir)
    {
        self::$dir = $dir;
    }

}