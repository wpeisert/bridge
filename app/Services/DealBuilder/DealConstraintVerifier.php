<?php

namespace App\Services\DealBuilder;

use App\BridgeCore\Tools;
use App\Services\DealDecorator\DealDecoratorFactoryInterface;
use App\Models\Deal;
use App\Models\DealConstraint;

class DealConstraintVerifier implements DealConstraintVerifierInterface
{
    public function __construct(private DealDecoratorFactoryInterface $dealDecoratorFactory) {}

    public function verify(Deal $deal, DealConstraint $dealConstraint): bool
    {
        $dealDecorator = $this->dealDecoratorFactory->decorate($deal);

        foreach (array_keys(Tools::getDealConstraintFields()) as $field) {
            $split = explode('_', $field);
            $directionPart = array_pop($split); // from, to
            $fieldName = implode('_', $split);
            $limitValue = $dealConstraint->$field;
            $actualValue = $dealDecorator->getValue($fieldName);
            if ($directionPart === 'from' && $limitValue > $actualValue) {
                return false;
            }
            if ($directionPart === 'to' && $limitValue < $actualValue) {
                return false;
            }
        }
        return true;
    }
}
