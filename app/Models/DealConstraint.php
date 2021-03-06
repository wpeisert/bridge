<?php

namespace App\Models;

use App\BridgeCore\Constants;
use App\BridgeCore\Tools;
use Illuminate\Database\Eloquent\Model;

class DealConstraint extends Model
{
    protected $fillable = [
        'name', 'description', 'vulnerable_NS', 'vulnerable_WE', 'dealer'
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
            array_keys(Tools::getDealConstraintFields()),
            function($carry, $item) {
                $carry[] = $item;
                return $carry;
            },
            []
        );
        $this->fillable = array_merge($this->fillable, $fieldNames);

        parent::__construct($attributes);
    }

    public function getVulnerableNsHumanAttribute()
    {
        return Constants::DEAL_CONSTRAINTS_VULNERABLE[intval($this->vulnerable_NS)];
    }

    public function getVulnerableWeHumanAttribute()
    {
        return Constants::DEAL_CONSTRAINTS_VULNERABLE[intval($this->vulnerable_WE)];
    }

    public function getConstraintsHumanAttribute()
    {
        $constraints = [];
        foreach (Tools::getDealConstraintFields() as $name => $field) {
            if ($field['defaultValue'] !== $this->$name) {
                $constraints[] = ['name' => Tools::parseDealConstraintFieldName($name), 'value' => $this->$name];
            }
        }
        return $constraints;
    }

    public function getSelectOptionTextAttribute()
    {
        return $this->name . ' ' . $this->description;
    }
}
