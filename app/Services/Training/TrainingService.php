<?php

namespace App\Services\Training;

use App\Models\Bidding;
use Illuminate\Support\Facades\Auth;

class TrainingService implements TrainingServiceInterface
{
    public function splitUserTrainings(array $trainings): array
    {
        $newTrainings = [];
        foreach ($trainings as $training) {
            /** @var Bidding $bidding */
            $biddings = ['finished' => [], 'you' => [], 'other' => []];
            foreach ($training->biddings as $bidding) {
                if ($bidding->is_finished) {
                    $biddings['finished'][] = $bidding;
                } elseif ($bidding->current_user_id === Auth::id()) {
                    $biddings['you'][] = $bidding;
                } else {
                    $biddings['other'][] = $bidding;
                }
            }
            $newTrainings[] = ['training' => $training, 'biddings' => $biddings];
        }

        return $newTrainings;
    }

    public function getNextBiddingInTraining(Bidding $bidding): Bidding
    {
        $was = false;
        foreach ($bidding->training->biddings as $bidd) {
            if (!$was) {
                if ($bidd->id === $bidding->id) {
                    $was = true;
                }
                continue;
            }
            return $bidd;
        }
        return $bidding->training->biddings[0];
    }
}
