<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2019-01-06
 * Time: 19:08
 */

class DownloaderTest extends PHPUnit\Framework\TestCase
{
    /**
     * @var object Downloader
     */
    private $objDownloader;

    /**
     * @var array
     */
    const EXAMPLE_FILE = ['test' => 'http://google.com'];

    /**
     * @var object FileHelper
     */
    private $objFileHelper;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->objDownloader = new Downloader();
        $this->objFileHelper = new FileHelper();
        $this->objDownloader->getPages(self::EXAMPLE_FILE);
    }

    public function testGetPages()
    {
        // sprawdzenie czy plik powstał
        $pathTestFile = $this->objFileHelper->PathToFile('test');
        $existFile = file_exists($pathTestFile);
        $this->assertTrue($existFile, 'Nie utworzono pliku');

        // sprawdzenie czy posiada rozmiar przynajmniej 1000 bytow (czy pobrano dano czy utworzono np pusty plik)
        $pathTestFile = $this->objFileHelper->PathToFile('test');
        if (filesize ($pathTestFile) > 1000){
            $fileSizeAccept = true;
        } else {
            $fileSizeAccept = false;
        }
        $this->assertTrue($fileSizeAccept, 'Plik poniżej 1000 bytów');
    }

    public function __destruct()
    {
        unlink($this->objFileHelper->PathToFile('test')); // usuniecie pliku testowego cache
    }
}