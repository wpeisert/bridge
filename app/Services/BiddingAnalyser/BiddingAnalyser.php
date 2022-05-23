<?php

namespace App\Services\BiddingAnalyser;

use App\BridgeCore\Constants;
use App\Models\Bidding;
use App\Services\Contract\Contract;
use App\Services\DealAnalyser\ProbabilityCalculator\TricksProbabilities;
use App\Services\Imp\ImpService;

class BiddingAnalyser
{
    public function __construct(private ImpService $impService) {}

    public function getBiddingAnalysisHtml(Bidding $bidding): string
    {
        $actualContract = Contract::createFromHash($bidding->contract);

        $trickProbsStr = [];
        $minimaxContracts = [];
        $expectedValues = [];
        foreach (Constants::SIDES as $side) {
            $fieldname = 'tricks_probabilities_' . $side;
            $serializedProbabilities = $bidding->deal->$fieldname;
            $tricksProbabilities = TricksProbabilities::createFromSerialized($serializedProbabilities);
            $trickProbsStr[$side] = "Trick probabilities $side: \n" . $tricksProbabilities->getHtml() . "\n";

            $fieldname = 'minimax_contract_' . $side;
            $minimaxContract = Contract::createFromHash($bidding->deal->$fieldname);
            $minimaxContracts[$side] = $minimaxContract;

            $fieldname = 'minimax_ev_' . $side;
            $ev = floatval($bidding->deal->$fieldname);
            $expectedValues[$side] = $ev;
        }

        return ''
            . '<b>Final contract:</b> ' . $actualContract->getAsString() . '<hr />'
            . 'Minimax NS: ' . $minimaxContracts['NS']->getAsString() . ' value: ' . $expectedValues['NS'] . "\n"
            . 'Result NS: ' . $bidding->result_NS . ' <b>(' . ($bidding->result_NS - $expectedValues['NS'])
            . ', IMP:' . $this->impService->getImp($bidding->result_NS - $expectedValues['NS']) . ')</b>' . "\n"
            . '<hr />'
            . 'Minimax WE: ' . $minimaxContracts['WE']->getAsString() . ' value: ' . $expectedValues['WE'] . "\n"
            . 'Result WE: ' . $bidding->result_WE . ' <b>(' . ($bidding->result_WE - $expectedValues['WE'])
            . ', IMP:' . $this->impService->getImp($bidding->result_WE - $expectedValues['WE']) . ')</b>' . "\n"
            . '<hr>'
            . $trickProbsStr['NS']
            . '<hr>'
            . $trickProbsStr['WE']
       ;
    }
}
