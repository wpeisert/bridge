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
        $fieldNames = array_reduce(
            self::getFields(),
            function($carry, $item) {
                $carry[] = $item['name'];
                return $carry;
            },
            []
        );
        $this->fillable = array_merge($this->fillable, $fieldNames);

        parent::__construct($attributes);
    }

    public static function getFields()
    {
        $fields = [];

        for ($iter = 0; $iter < BridgeConstants::PLAYERS_COUNT; ++$iter) {
            $fields[] = ['name' => 'PC_' . ($iter) . '_from', 'defaultValue' => 0];
            $fields[] = ['name' => 'PC_' . ($iter) . '_to', 'defaultValue' => 40];
        }

        $fields[] = ['name' => 'PC_02_from', 'defaultValue' => 0];
        $fields[] = ['name' => 'PC_02_to', 'defaultValue' => 40];

        foreach (BridgeConstants::DEAL_CONSTRAINTS_COLORS as $color) {
            for ($iter = 0; $iter < BridgeConstants::PLAYERS_COUNT; ++$iter) {
                $fields[] = ['name' => $color . '_' . ($iter) . '_from', 'defaultValue' => 0];
                $fields[] = ['name' => $color . '_' . ($iter) . '_to', 'defaultValue' => 13];
            }
        }

        return $fields;
    }
}
