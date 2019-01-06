<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2019-01-05
 * Time: 20:17
 */

class StringHelper
{
    /**
     * Wycina z podanego ciągu znaki od-do
     *
     * @param string $source - Ciąg znaków (np. kod html)
     * @param string $form   - Ciąg od którego wyciąć znaki
     * @param string $to     - Ciąg do którego wyciąć znaki
     *
     * @return string - Ciąg znaków znajdujący się pomiędzy podanymi ciągami
     */
    public static function cutString(string $source, string $form, string $to): string
    {
        // od którego znaku wyciąć (numer znaku)
        $cutFrom = strpos($source, $form) + strlen($form);
        // ile znaków wyciąć (liczba znaków)
        $cutTo = strpos($source, $to) - $cutFrom;

        return substr($source, $cutFrom, $cutTo);
    }
}