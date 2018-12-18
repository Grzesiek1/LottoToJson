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
     * @param string $director
     *
     * @return string
     */
    protected function pathToFile(string $fileName, $director = 'cache'): string
    {
        if ($director === 'cache') {
            return FilesDirector . '/cache/' . $fileName;
        } elseif ($director === 'json') {
            return FilesDirector . '/json/' . $fileName;
        }
    }
}