<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2018-12-18
 * Time: 01:55
 */
require_once('head.php');

$sites = [
    'elgordo' => 'https://www.elgordo.com/results/euromillonariaen.asp',
    'lotto' => 'http://www.lotto.pl/lotto/wyniki-i-wygrane',
    'eurojackpot' => 'http://www.lotto.pl/eurojackpot/wyniki-i-wygrane'
];

$objDownloader = new Downloader();
$objDownloader->getPages($sites);

$objParser = new Parser();
$test = $objParser->init();

var_dump($test);