<?php

namespace App\Interfaces\Deal;

use App\Models\Deal;
use App\Models\DealConstraint;

interface DealConstraintsProviderInterface
{
    public function isDealerDefined(DealConstraint $dealConstraint): bool;
    public function getDealer(DealConstraint $dealConstraint): int;

    public function isVulnerableDefined(DealConstraint $dealConstraint): bool;
    public function isNsVulnerable(DealConstraint $dealConstraint): bool;
    public function isWeVulnerable(DealConstraint $dealConstraint): bool;
}
