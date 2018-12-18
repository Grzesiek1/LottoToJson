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
    public $curl;

    /**
     * Downloader constructor.
     */
    public function __construct()
    {
        $this->curl = new Curl();
    }

    public function getPages(array $pages)
    {

    }
}