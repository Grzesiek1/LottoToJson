<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2018-12-18
 * Time: 01:55
 */
error_reporting(E_ALL);
define('FilesDirector', __DIR__ . '/Files');

require_once('ExternalFiles/vendor/autoload.php');

// Ładowanie naszych klas
function __classLoader($class)
{
    try {
        require_once('Class/' . $class . '.class.php');
    } catch (exception $e) {
        try {
            require_once('Class/' . strtolower($class) . '.class.php');
        } catch (exception $e) {
            $class = mb_convert_case($class, MB_CASE_TITLE, 'UTF-8');
            require_once('Class/' . $class . '.class.php');
        }
    }
}

spl_autoload_register('__classLoader');