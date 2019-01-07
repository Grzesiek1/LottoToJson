<?php

/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2019-01-06
 * Time: 03:02
 */
class Main
{
    /**
     * Lista dostępnych parserów
     */
    const PARSERS_LIST = ['Elgordo', 'EuroJackPot', 'Lotto'];

    /**
     * @var string - Nazwa parsera
     */
    private $parser;

    /**
     * @var object FileHelper
     */
    private $objFileHelper;

    /**
     * Main constructor.
     */
    public function __construct()
    {
        $this->objFileHelper = new FileHelper;
    }

    /**
     * Wydobywa numery z wynikami z plików cache i zapisuje te wyniki do plików json
     */
    public function init()
    {
        foreach ($this->objFileHelper->getFilesList() as $file) {
            $fullPathToFile = $this->objFileHelper->pathToFile($file);
            $source = $this->objFileHelper->loadFile($fullPathToFile);

            try {// zabezpieczenie przed rzuceniem fatala (i zblokowaniem skryptu) w przypadku braku parsera dla danego typu strony
                switch ($file) {
                    case 'elgordo':
                        $this->setParser('Elgordo');
                        break;
                    case 'eurojackpot':
                        $this->setParser('EuroJackPot');
                        break;
                    case 'lotto':
                        $this->setParser('Lotto');
                        break;
                }

                $parser = $this->getParser();
                if (!empty($parser) && !empty($source)) {
                    $objParser = new $parser(); // tworzenie instancji parsera dla danego typu strony
                    $jsonData = $objParser->extract($source);

                    if (!empty($jsonData)) {
                        $this->objFileHelper->saveFileJson($jsonData, $file);
                    }
                }

            } catch (exception $e) {
                print $e;
            }
        }
    }

    /**
     * Ustawia nazwe parsera
     *
     * @param string $parser - Nazwa parsera
     * @throws Exception
     */
    private function setParser(string $parser)
    {
        if (in_array($parser, self::PARSERS_LIST)) {
            $this->parser = $parser;
        } else {
            throw new Exception('Incorrect parser class');
        }
    }

    /**
     * Zwraca nazwe parsera
     *
     * @return string - Nazwa parsera
     */
    private function getParser(): string
    {
        return $this->parser ? $this->parser : '';
    }
}