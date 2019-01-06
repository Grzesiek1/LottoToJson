<?php

/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2019-01-06
 * Time: 02:45
 */
class EuroJackPot extends Lotto
{
    /**
     * @param string $pageSource - Kod źródłowy podstrony
     *
     * @return string - Wyniki losowań gier losowych w json
     */
    public function extract(string $pageSource)
    {
        return parent::extract($pageSource);
    }

    /**
     * Ustalenie daty gry i zapis do pamięci
     *
     * @param string $className  - Nazwa klasy
     * @param string $classValue - Zawartość klasy
     */
    protected function setGameDate(string $className, string $classValue)
    {
        if ($className === 'contentData') {
            preg_match("/\d{4}-\d{2}-\d{2}/", $classValue, $date);
            $date = substr($date[0], 2);
            $this->setMemory('gameDate', $date);
        }
    }

    /**
     * Ustalenie typu gry i zapis do pamięci
     *
     * @param string $class
     */
    protected function setGameType(string $class)
    {
        if ('resultsItem euroJackpot dymek_kulki' === $class) {
            $this->setMemory('game', 'euroJackpot');
        }
    }
}