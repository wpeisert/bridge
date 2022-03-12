<?php

return [

    /*
    |--------------------------------------------------------------------------
    | DEAL BUILDER TRIALS LIMIT
    |--------------------------------------------------------------------------
    |
    | When generating deals with constraints, use this number to limit trials
    | as it's not clear whether constraints are even possible to fulfill.
    |
    */

    'deal_builder_trials_limit' => env('DEAL_BUILDER_TRIALS_LIMIT', 1000),
];
