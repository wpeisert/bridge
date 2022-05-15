<?php

namespace App\Services\Random;

class RandomSeeder implements RandomSeederInterface
{
    public function seed(int $seed = 0)
    {
        if (!$seed) {
            $seed = $this->makeSeed();
        }

        srand($seed);
    }

    private function makeSeed(): int
    {
        list($usec, $sec) = explode(' ', microtime());
        return $sec + $usec * 1000000;
    }
}
