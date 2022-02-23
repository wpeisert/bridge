<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'vulnerable_02', 'vulnerable_13'
    ];

    protected $casts = [
        'vulnerable_02' => 'integer',
        'vulnerable_13' => 'integer',
    ];
}
