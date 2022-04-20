<?php

namespace App\Repositories;

use App\Models\Bidding;
use App\Models\Training;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TrainingRepository implements TrainingRepositoryInterface
{
    public function getUserTrainings(int $userId, bool $active = true)
    {
        $trainingsBase = Training::query()
            ->where(function (Builder $query) use ($userId) {
                return $query->where('user_id_N', '=', $userId)
                    ->orWhere('user_id_E', '=', $userId)
                    ->orWhere('user_id_S', '=', $userId)
                    ->orWhere('user_id_W', '=', $userId);
                }
            );

        $trainings = $active ?
            $trainingsBase->whereHas('biddings', function (Builder $query) {
                    $query->where('status', '<>', 'finished');
                }
            )
            :
            $trainingsBase->whereDoesntHave('biddings', function (Builder $query) {
                    $query->where('status', '<>', 'finished');
                }
            );

        return $trainings->get();
    }

    public function splitUserTrainings(mixed $trainings)
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
}
