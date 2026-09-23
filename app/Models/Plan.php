<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'short_description',
        'duration_months',
        'minimum_amount'
    ];
}
