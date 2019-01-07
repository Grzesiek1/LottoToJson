<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2019-01-06
 * Time: 23:50
 */

class StringHelperTest extends PHPUnit\Framework\TestCase
{
    public function testCutString()
    {
        $string = '123testowy456ciag789znakow';
        $begin = '3testowy';
        $between = '456';
        $end = 'ciag789zna';
        if ($between === StringHelper::cutString($string, $begin, $end)) {
            $cutStringCorrect = true;
        } else {
            $cutStringCorrect = false;
        }
        $this->assertTrue($cutStringCorrect, 'Wycięto nieprawidłowy ciąg znaków');
    }
}