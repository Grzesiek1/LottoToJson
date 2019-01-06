<?php

/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2019-01-06
 * Time: 02:45
 */
class Elgordo extends aParser
{
    /**
     * @param string $pageSource - Kod źródłowy podstrony
     *
     * @return string - Wyniki losowań gier losowych w json
     */
    public function extract(string $pageSource)
    {
        // wyniki gier losowych
        $return = [];
        // wycinam liste z wynikami (kod strony, div zaczynający liste wyników, div kończący liste wyników)
        $pageSource = StringHelper::cutString($pageSource, '<div class="combi balls">', '<span class="txt-num">E2</span>');

        $doc = new \DOMDocument();
        $doc->loadHTML($pageSource);
        $div = $doc->getElementsByTagName("span");

        foreach ($div as $item) {
            $class = $item->getAttribute("class");
            if ($class !== 'txt-num') {
                $return[] = $item->nodeValue;
            }
        }

        return json_encode(implode(',', $return));
    }
}