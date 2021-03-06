<?php

namespace App\Services\DealAnalyser\DoubleDummy;

use App\Services\Hands\Hands;
use App\Services\Hands\HandsService;
use Illuminate\Support\Facades\Log;

class DoubleDummyCalculator
{
    public function __construct(private HandsService $handsService) {}

    /**
     * @param Hands[] $handsArray
     * @return DoubleDummyResult[]
     */
    public function calculate(array $handsArray): array
    {
        $prefix = 'cd ' . base_path() . '/bin/ && LD_LIBRARY_PATH=. ./ddcalculate ';
        $arguments = $this->prepareArguments($handsArray);
        $cmd = $prefix . $arguments;
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
            $arguments .= '"' . $this->handsService->getHandsAsPBN($hands) . '"' . ' ';
        }

        return trim($arguments);
    }
}
