<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2018-12-18
 * Time: 02:55
 */

class Main
{
    /**
     * Zwraca pełną ścieżkę pliku w cache.
     *
     * @param string $fileName
     *
     * @return string
     */
    protected function pathToCacheFile(string $fileName): string
    {
        return cacheFiles . $fileName;
    }
}