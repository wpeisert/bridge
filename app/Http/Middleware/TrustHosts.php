<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;
use Illuminate\Support\Facades\Log;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts()
    {
        Log::debug('TrustHosts::hosts',['hosts' => $this->allSubdomainsOfApplicationUrl()]);
        return [
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
