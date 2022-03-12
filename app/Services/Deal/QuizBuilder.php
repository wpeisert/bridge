<?php

namespace App\Services\Deal;

use App\Exceptions\DealBuilderLimitReachedException;
use App\Interfaces\Deal\DealBuilderInterface;
use App\Interfaces\Deal\QuizBuilderInterface;
use App\Models\Quiz;

class QuizBuilder implements QuizBuilderInterface
{
    public function __construct(private DealBuilderInterface $dealBuilder) {}

    public function build(Quiz $quiz): int
    {
        $limit = $quiz->deals_count - $quiz->existing_deals_count;
        $createdCount = 0;
        for ($iter = 0; $iter < $limit; ++$iter) {
            try {
                $deal = $this->dealBuilder->build($quiz->deal_constraint);
                $deal->save();
                $quiz->deals()->attach($deal);
                ++$createdCount;
            } catch (DealBuilderLimitReachedException $e) {
                // silent
            }
        }

        return $createdCount;
    }
}
