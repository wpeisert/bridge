<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'deals_count', 'deal_constraint_id'
    ];

    public function deals()
    {
        return $this->belongsToMany(Deal::class)->withTimestamps();
    }

    public function getExistingDealsCountAttribute()
    {
        return count($this->deals()->get());
    }

    public function dealConstraint()
    {
        return $this->belongsTo(DealConstraint::class);
    }

    public function getDealConstraintAttribute()
    {
        return $this->dealConstraint()->first();
    }
}
