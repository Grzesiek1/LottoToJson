<?php
/**
 * Created by PhpStorm.
 * User: Grzegorz Chwiluk
 * Date: 2018-12-18
 * Time: 01:55
 */
require_once('head.php');

$sites = [
    'elgordo' => 'https://www.elgordo.com/results/euromillonariaen.asp',
    'lotto' => 'http://www.lotto.pl/lotto/wyniki-i-wygrane',
    'eurojackpot' => 'http://www.lotto.pl/eurojackpot/wyniki-i-wygrane'
];

/*
 * Wersja z konsoli cmd
 */
if (php_sapi_name() == "cli") {
    print "Aby 'pobrać' wciśnij 1, aby 'przetworzyć' wciśnij 2, aby 'zakończyć' wciśnij 3\nWybór potwierdź ENTER\n";

    while (true) {
        $key = fgetc(STDIN);
        if ($key == 1) {
            (new Downloader())->getPages($sites);
            print "Pobrano\n";
        } elseif ($key == 2) {
            (new Main())->init();
            print "Przetworzono\n";
        } elseif ($key == 3) {
            print "Zakończono\n";
            die;
        }
    }
}

/*
 * Wersja z przeglądarki
 */
// pobieranie stron do cache
(new Downloader())->getPages($sites);
// parsowanie stron i generowanie plikow json
(new Main())->init();
print 'Uruchomiono pobieranie i przetwarzanie. Zakończono.';
