<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2018-12-18
 * Time: 01:55
 */
error_reporting(E_ALL);
define('cacheFiles', __DIR__ . '/Files/cache/');

require_once('ExternalFiles/vendor/autoload.php');
require_once('class/Main.class.php');
require_once('class/Downloader.class.php');
require_once('class/Parser.class.php');
