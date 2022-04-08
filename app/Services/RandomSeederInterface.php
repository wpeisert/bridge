<?php

namespace App\Services;

interface RandomSeederInterface
{
    public function seed(int $seed = 0);
}
