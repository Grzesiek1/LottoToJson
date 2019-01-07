<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2018-12-18
 * Time: 01:58
 */

abstract class aParser implements iParser
{
    /**
     * @var array - Ile liczb posiada dany typ gry
     */
    const BALLS_IN_GAME = [
        'lotto' => 6,
        'lottoPlus' => 6,
        'lottoSzansa' => 7,
        'euroJackpot' => 7,
    ];

    /**
     * @var string - Zmienna pomocnicza dla metod od pamięci (aParser::setMemory(), aParser::getMemory(), aParser::clearMemory())
     */
    protected static $memory;

    /**
     * @var object FileHelper
     */
    protected $objFileHelper;

    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $this->objFileHelper = new FileHelper;
    }

    /**
     * Zapisuje wartość do pamięci
     *
     * @param string $var - Nazwa zmiennej
     * @param mixed  $val - Wartość zmiennej
     */
    protected function setMemory(string $var, $val)
    {
        self::$memory[$var] = $val;
    }

    /**
     * Odczytuje wartość z pamięci
     *
     * @param string $var - Nazwa zmiennej
     *
     * @return mixed
     */
    protected function getMemory(string $var)
    {
        if (isset(self::$memory[$var])) {
            return self::$memory[$var];
        } else {
            return false;
        }
    }

    /**
     * Usuwa wartości z pamięci
     */
    protected function clearMemory()
    {
        self::$memory = [];
    }
}