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
            array_keys(BridgeConstants::getDealConstraintsFields()),
            function($carry, $item) {
                $carry[] = $item;
                return $carry;
            },
            []
        );
        $this->fillable = array_merge($this->fillable, $fieldNames);

        parent::__construct($attributes);
    }
}
