<?php

namespace App\Services\Random;

interface RandomSeederInterface
{
    public function seed(int $seed = 0);
}
