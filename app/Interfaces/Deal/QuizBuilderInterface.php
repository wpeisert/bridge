<?php

namespace App\Interfaces\Deal;

use App\Models\Quiz;

interface QuizBuilderInterface
{
    public function build(Quiz $quiz): int;
}
