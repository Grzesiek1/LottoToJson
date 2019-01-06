<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2018-12-18
 * Time: 01:57
 */

use \Curl\Curl;

class Downloader
{
    /**
     * @var Object Curl
     */
    private $curl;

    /**
     * Downloader constructor.
     */
    public function __construct()
    {
        $this->curl = new Curl();
    }

    /**
     * Pobiera listę stron podaną w tablicy i zapisuje do plików.
     *
     * @param array $pages ['pageName' => 'pageUrl'] - Nazwa i url strony do pobrania
     */
    public function getPages(array $pages)
    {
        foreach ($pages as $siteName => $siteUrl) {
            $this->curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
            $this->curl->download($siteUrl, (new FileHelper)->pathToFile($siteName));
        }
    }
}