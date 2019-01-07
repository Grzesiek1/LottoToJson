<?php

/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2019-01-06
 * Time: 02:45
 */
class Lotto extends aParser
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
        $pageSource = StringHelper::cutString($pageSource, '<div class="pageContent">', '<div class="page_bottom"></div>');

        $doc = new \DOMDocument();
        $doc->loadHTML($pageSource);
        $div = $doc->getElementsByTagName("div");

        foreach ($div as $item) {
            $class = $item->getAttribute("class");

            $this->setGameDate($class, $item->nodeValue); // Ustawienie daty gry
            $this->setGameType($class); // Ustawienie typu gry
            $game = $this->getMemory('game'); // Aktualna gra
            $dateGame = $this->getMemory('gameDate'); // Aktualna data gry

            /*
             * Zapis wyników do tablicy dla ostatnio ustalonego typu i daty gry
             */
            if (strpos($class, 'number text-center') !== false && $game !== false && $dateGame !== false) {
                $ball = $this->getMemory('ball'); // Aktualna kula

                if ($ball === false) {
                    $ball = 1; // Brak zapisów w pamięci dla danej gry, zaczynamy od pierwszej kuli
                } else {
                    $ball++; // kolejna kula w grze
                }
                $this->setMemory('ball', $ball);
                $result[] = $item->nodeValue; // Dodajemy kolejny wynik dla danej gry

                if ($ball === self::BALLS_IN_GAME[$game]) {
                    // Zebrano wszystkie kule w danym typie gry losowej.
                    // Dopisujemy wyniki do tabeli końcowej
                    // Czyścimy pamięć podręczną dla aktualnej gry (czyścimy typ gry, date gry, numer kuli)
                    $return[$game][$dateGame] = implode(',', $result);
                    unset($result);
                    $this->clearMemory();
                }
            }
        }

        return json_encode($return);
    }

    /**
     * Ustalenie daty gry i zapis do pamięci - tylko jeśli pamięć pusta
     *
     * @param string $className  - Nazwa klasy
     * @param string $classValue - Zawartość klasy
     */
    protected function setGameDate(string $className, string $classValue)
    {
        if ($this->getMemory('gameDate') === false){ //nizdefiniowana data gry
            if ($className === 'contentData') {
                preg_match("/\d{6}-\d{2}-\d{2}/", $classValue, $date);
                $date = substr($date[0], 4);
                $this->setMemory('gameDate', $date);
            }
        }
    }

    /**
     * Ustalenie typu gry i zapis do pamięci - tylko jeśli pamięć pusta
     *
     * @param string $className - Nazwa klasy
     */
    protected function setGameType(string $className)
    {
        if ($this->getMemory('game') === false) { //niezdefiniowany typ gry
            if ('resultsItem lotto dymek_kulki' === $className) {
                $this->setMemory('game', 'lotto');
            } elseif ('resultsItem lottoPlus dymek_kulki' === $className) {
                $this->setMemory('game', 'lottoPlus');
            } elseif ('resultsItem lottoSzansa' == $className) {
                $this->setMemory('game', 'lottoSzansa');
            }
        }
    }
}