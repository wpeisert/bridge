<?php

namespace App\Services\DealAnalyser;

use App\Models\Deal;

/*
 * Co my chcemy?
 *
 * 1. Analizujemy ręce parami: NS, WE
 * 1'. Analizujemy tylko NS
 * 2. Dla każdej strony (np. NS) losujemy m rąk przeciwników
 * 3. Dla każdego wylosowanego rozdania pobieramy dane:
 *    - dla każdego gracza (N, E, S, W) jako rozgrywająćego:
 *    - ile lew weźmie grając c, d, h, s, nt
 *    - zatem wynik każdego rozdania jest tablicą: 4 x 5
 * 4. Zatem mamy na koniec mamy tablicę: m(rozdania) x 4(rozgrywający) x 5(kolor)
 * 4'. Tworzymy tabelkę prawdopodobieństw wzięcia lew: 4(rozgrywający) x 5(kolor) x 13(liczba lew)
 * 4''. Z tabelki wyrzucamy wartości poniżej 1%
 * 4'''. W efekcie mamy tabelkę: 4(rozgrywający) x 5(kolor) => [13(liczba lew) => prawdopodobieństwo]
 * 5. Dla każdego możliwego kontraktu: pass + 4(rozgrywający) x 5(kolor) x 7(wysokość) x 2(bez kontry, z kontrą):
 *    - liczymy wartość kontraktu (z punktu widzenia pary NS)
 * 6. Przerabiamy to na listę krotek o długości: 1+4x5x7x2 lub 1+4x5x7x2
 * 7. Jeśli dla danego kontraktu wynik jest taki sam dla N i S (odp. E i W), wywalamy jedną z nich (S odp. W)
 * 8. Minimax:
 *   - NS znajduje najcenniejszy swój kontrakt; niższe kontrakty są odrzucane
 *   - WE znajduje najcenniejszy swój kontrakt; niższe kontrakty są odrzucane
 *   - kończy się, gdy nie można już nic odrzucić
 * LUB:
 * 8'. Minimax:
 *   - NS znajduje najcenniejsze swoje kontrakty w każdym kolorze i z każdej ręki; niższe niż najniższy z nich są odrzucane
 *   - WE znajduje najcenniejsze swoje kontrakty w każdym kolorze; niższe niż najniższy z nich są odrzucane
 *   - kończy się, gdy nie można już nic odrzucić
 * 9. KONIEC: mamy dwie listy dla
 */

interface DealAnalyserInterface
{
    public function setDeal(Deal $deal);

    /**
     * Runs full analysis for $rounds random opponents' hands.
     *
     * @param int $rounds
     */
    public function analyse(int $rounds = 10): void;


}
