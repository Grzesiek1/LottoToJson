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
    const BallsInGame = [
        'lotto' => 6,
        'lottoPlus' => 6,
        'lottoSzansa' => 7,
        'euroJackpot' => 7,
    ];

    /**
     * @var string - Typ gry
     */
    protected static $type;

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
        self::$type[$var] = $val;
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
        if (isset(self::$type[$var])) {
            return self::$type[$var];
        } else {
            return false;
        }
    }

    /**
     * Usuwa wartości z pamięci
     */
    protected function clearMemory()
    {
        self::$type = [];
    }
}