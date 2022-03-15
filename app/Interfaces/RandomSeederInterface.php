<?php

namespace App\Interfaces;

interface RandomSeederInterface
{
    public function seed(int $seed = 0);
}
