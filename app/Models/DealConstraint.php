<?php

namespace App\Models;

use App\Dictionaries\BridgeConstants;
use Illuminate\Database\Eloquent\Model;

class DealConstraint extends Model
{
    protected $fillable = [
        'name', 'description', 'vulnerable', 'dealer'
    ];

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge($this->fillable, self::getFieldsNames());

        parent::__construct($attributes);
    }

    public static function getFieldsNames()
    {
        $fieldNames = [];

        for ($iter = 0; $iter < BridgeConstants::PLAYERS_COUNT; ++$iter) {
            $fieldNames[] = 'PC_' . ($iter) . '_from';
            $fieldNames[] = 'PC_' . ($iter) . '_to';
        }

        $fieldNames[] = 'PC_02_from';
        $fieldNames[] = 'PC_02_to';

        foreach (BridgeConstants::DEAL_CONSTRAINTS_COLORS as $color) {
            for ($iter = 0; $iter < BridgeConstants::PLAYERS_COUNT; ++$iter) {
                $fieldNames[] = $color . '_' . ($iter) . '_from';
                $fieldNames[] = $color . '_' . ($iter) . '_to';
            }
        }

        return $fieldNames;
    }
}
