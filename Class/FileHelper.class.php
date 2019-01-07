<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2018-12-18
 * Time: 02:55
 */

class FileHelper
{
    /**
     * Ścieżka do przechowywanych plików cache
     */
    const FILES_CACHE = PROJECT_DIR . '/Files/cache/';

    /**
     * Ścieżka do przechowywanych plików json
     */
    const FILES_JSON = PROJECT_DIR . '/Files/json/';

    /**
     * Zwraca dane z pliku w postaci string (BEZ UŻYCIA FOPEN!)
     *
     * @param string $fullPathToFile - Dokładna ścieżka do pliku
     *
     * @return string - Zawartość pliku
     */
    public function loadFile(string $fullPathToFile): string
    {
        ob_start();
        include $fullPathToFile;
        return ob_get_clean();
    }

    /**
     * Zwraca pełną ścieżkę pliku w cache.
     *
     * @param string $fileName
     * @param string $director
     *
     * @return string - Ścieżka pliku w cache
     */
    public function pathToFile(string $fileName, string $director = 'cache'): string
    {
        if ($director === 'cache') {
            return self::FILES_CACHE . $fileName;
        } elseif ($director === 'json') {
            return self::FILES_JSON . $fileName;
        }
    }

    /**
     * Zwraca listę plików w folderze Files/cache
     *
     * @return array - Lista plików
     */
    public function getFilesList(): array
    {
        $scanDir = scandir(self::FILES_CACHE);
        $directory = array_slice($scanDir, 2);
        return $directory;
    }

    /**
     * Zapisuje pliki json
     *
     * @param string $jsonData - Dane w formacie json
     * @param string $fileName - Nazwa pliku docelowego
     */
    public function saveFileJson(string $jsonData, string $fileName)
    {
        $fullFilePath = $this->pathToFile($fileName, 'json') . '.json';
        file_put_contents($fullFilePath, $jsonData);
    }
}