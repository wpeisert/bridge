<?php

namespace App\Services\Quiz;

use App\Events\DealCreatedEvent;
use App\Exceptions\DealBuilderLimitReachedException;
use App\Services\DealBuilder\DealBuilderInterface;
use App\Models\Quiz;
use Illuminate\Support\Facades\Log;

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
                DealCreatedEvent::dispatch($deal);
                $quiz->deals()->attach($deal);
                ++$createdCount;
            } catch (DealBuilderLimitReachedException $e) {
                Log::debug('dealBuilder', ['msg' => $e->getMessage()]);
            }
        }

        return $createdCount;
    }
}
