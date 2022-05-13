<?php

namespace App\Services\DealAnalyser\DoubleDummy;

use App\Services\Hands\Hands;
use Illuminate\Support\Facades\Log;

class DoubleDummyCalculator
{
    /**
     * @param Hands[] $handsArray
     * @return DoubleDummyResult[]
     */
    public function calculate(array $handsArray): array
    {
        $prefix = 'cd bin && LD_LIBRARY_PATH=. ./ddcalculate ';
        $arguments = $this->prepareArguments($handsArray);
        $cmd = $prefix . $arguments;
        $output = [];
        $resultCode = '---';
        exec($cmd, $output, $resultCode);
        Log::debug('ddcalculate',
            [
                'cmd' => $cmd,
                'res' => print_r($output, true),
                'code' => $resultCode,
            ]
        );
        $ddResults = [];
        foreach ($output as $result) {
            if (!trim($result)) {
                continue;
            }
            $ddResults[] = new DoubleDummyResult($result);
        }
        if (count($handsArray) !== count($ddResults)) {
            throw new \Exception("Wrong output size. Input size: " . count($handsArray) . ". Output size: " . count($ddResults));
        }
        return $ddResults;
    }

    private function prepareArguments(array $handsArray): string
    {
        $arguments = '';
        /** @var Hands $hands */
        foreach ($handsArray as $hands) {
            $arguments .= '"' . $hands->getHandsAsPBN() . '"' . ' ';
        }

        return trim($arguments);
    }
}
