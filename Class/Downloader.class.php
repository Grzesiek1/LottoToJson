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
     * Ścieżka do cache curl
     */
    const cacheCurl = __DIR__ . '/../Files/cache/';

    /**
     * @var Object Curl
     */
    protected $curl;

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
            $this->curl->download($siteUrl, $this->pathToCacheCurl($siteName));
        }
    }

    /**
     * Zwraca pełną ścieżkę dla pliku cache curl.
     * 
     * @param string $fileName
     *
     * @return string
     */
    protected function pathToCacheCurl(string $fileName): string
    {
        return self::cacheCurl . $fileName;
    }
}