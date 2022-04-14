<?php

namespace App\Services\DealConstraint;

interface DealConstraintDecoratorInterface
{
    public function isDealerDefined(): bool;
    public function getDealer(): string;

    public function isNsVulnerableDefined(): bool;
    public function isNsVulnerable(): bool;

    public function isWeVulnerableDefined(): bool;
    public function isWeVulnerable(): bool;
}
