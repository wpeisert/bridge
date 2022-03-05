<?php

namespace App\Models;

use App\Bridge\Tools;
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
            array_keys(Tools::getDealConstraintsFields()),
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
