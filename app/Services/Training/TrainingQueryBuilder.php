<?php

namespace App\Services\Training;

use App\Models\Training;
use Illuminate\Database\Eloquent\Builder;

class TrainingQueryBuilder implements TrainingQueryBuilderInterface
{
    public function getUserTrainingsActive(int $userId, bool $active = true): Builder
    {
        $trainingsBase = $this->getUserTrainings($userId);

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

        return $trainings;
    }

    public function getUserTrainings(int $userId): Builder
    {
        return Training::query()
            ->where(function (Builder $query) use ($userId) {
                return $query->where('user_id_N', '=', $userId)
                    ->orWhere('user_id_E', '=', $userId)
                    ->orWhere('user_id_S', '=', $userId)
                    ->orWhere('user_id_W', '=', $userId);
            }
        );
    }
}
