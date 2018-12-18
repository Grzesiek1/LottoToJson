<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2018-12-18
 * Time: 01:58
 */

class Parser extends Main
{
    public function extractNumbers()
    {
        foreach ($this->getFilesList() as $file) {
            $fullPathToFile = $this->pathToCacheFile($file);
            $arr[$file] = $this->loadFile($fullPathToFile);
        }
        return $arr;
    }

    public function loadFile($pathFile)
    {
        ob_start();
        include $pathFile;
        return ob_get_clean();
    }

    public function getFilesList()
    {
        $scanDir = scandir(cacheFiles);
        $directory = array_slice($scanDir, 2);
        return $directory;
    }
}