<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2018-12-18
 * Time: 01:58
 */

class Parser extends Main
{
    /**
     * Wydobywa numery z wynikami z plików cache i zapisuje te wyniki do plików json
     *
     * @return mixed
     */
    public function init()
    {
        foreach ($this->getFilesList() as $file) {
            $fullPathToFile = $this->pathToFile($file);
            $pageSource = $this->loadFile($fullPathToFile);
            switch ($file) {
                case 'elgordo':
                    $jsonData = $this->extractElgordo($pageSource);
                    $this->saveFileJson($jsonData, $file);
                    break;
                case 'eurojackpot':
                    break;
                case 'lotto':
                    break;
            }
        }
    }

    private function extractElgordo($pageSource)
    {
        // div zaczynający liste wyników
        $firstElement = '<div class="combi balls">';
        // div kończący liste wyników
        $lastElement = '<div class="esp first">';
        // od którego znaku wyciąć (numer znaku)
        $cutFrom = strpos($pageSource, $firstElement) + strlen($firstElement);
        // ile znaków wyciąć (liczba znaków)
        $cutTo = strpos($pageSource, $lastElement) - $cutFrom;
        // wyciete elementy html zawierajace bezposrednio wyniki (bez naglowkow, nawigacji itd)
        $resultLotteryInHtml = substr($pageSource, $cutFrom, $cutTo);


        // usuwamy rozpoczynajacy div/span dla danego wyniku
        $string = str_replace('<div class="num"><span class="int-num">', '', $resultLotteryInHtml);
        // zamieniamy konczacy div/span dla danego wyniku na przecinek
        $string = str_replace('</span></div>', ',', $string);
        // usuwamy biale znaki
        $string = str_replace(["\r", "\n", "\t", " "], '', $string);
        // liste konczymy bez przecinka koncowego
        $string = rtrim($string, ',');
        // konwersja na tablice int
        $array = array_map('intval', explode(',', $string));

        return json_encode($array);
    }

    /**
     * Zwraca dane z pliku w postaci string
     *
     * @param $fullPathToFile - Dokładna ścieżka do pliku
     *
     * @return string
     */
    private function loadFile($fullPathToFile)
    {
        ob_start();
        include $fullPathToFile;
        return ob_get_clean();
    }

    private function saveFileJson($jsonData, $fileName)
    {
        $fullFilePath = $this->pathToFile($fileName, 'json') . '.json';
        file_put_contents($fullFilePath, $jsonData);
    }

    /**
     * Zwraca listę plików w folderze Files/cache
     *
     * @return array
     */
    private function getFilesList()
    {
        $scanDir = scandir(FilesDirector . '/cache/');
        $directory = array_slice($scanDir, 2);
        return $directory;
    }
}