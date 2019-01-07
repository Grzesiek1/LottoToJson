<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2019-01-06
 * Time: 19:08
 */

class LottoTest extends PHPUnit\Framework\TestCase
{
    /**
     * @var object Lotto
     */
    public $objLotto;

    public function setUp()
    {
        $this->objLotto = new Lotto();
    }

    public function testSetGameDate()
    {
        $date = '05-01-19'; // data do porównania
        $classContainDate = 'contentData';
        $stringWithDate = 'losowanie nr 620105-01-19, sobota';

        /**
         * Wywołanie prywatnej metody Lotto::setGameDate()
         * Analogia do: $this->objLotto->setGameDate($classContainDate, $stringWithDate);
         */
        $reflectionClass = new \ReflectionClass($this->objLotto);
        $reflectionMethod = $reflectionClass->getMethod('setGameDate');
        $reflectionMethod->setAccessible(true);
        $reflectionMethod->invokeArgs($this->objLotto, [$classContainDate, $stringWithDate]);

        /**
         * Podgląd statycznych w klasie po powyżej operacji
         */
        $staticProperties = $reflectionClass->getStaticProperties();

        if ($date === $staticProperties['memory']['gameDate']) {
            $correctDate = true;
        } else {
            $correctDate = false;
        }
        $this->assertTrue($correctDate, 'Niepoprawnie zdekodowana data');
    }
}