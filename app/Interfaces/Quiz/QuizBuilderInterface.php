<?php

namespace App\Interfaces\Quiz;

use App\Models\Quiz;

interface QuizBuilderInterface
{
    public function build(Quiz $quiz): int;
}
