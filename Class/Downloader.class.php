<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2018-12-18
 * Time: 01:57
 */

use \Curl\Curl;

class Downloader extends Main
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
     * @param array $pages ['pageName' => 'pageUrl']
     */
    public function getPages(array $pages)
    {
        foreach ($pages as $siteName => $siteUrl) {
            $this->curl->download($siteUrl, $this->pathToFile($siteName));
        }
    }
}