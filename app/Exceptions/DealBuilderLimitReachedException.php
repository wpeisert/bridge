<?php

namespace App\Exceptions;

class DealBuilderLimitReachedException extends \Exception
{
    public function __construct(int $dealConstraintId)
    {
        $limit = intval(config('bridge.deal_builder_trials_limit'));
        $message = sprintf(
            'DealBuilder limit exceeded, for dealConstraint ID: %d limit: %d',
            $dealConstraintId,
            $limit
        );
        parent::__construct($message);
    }
}
