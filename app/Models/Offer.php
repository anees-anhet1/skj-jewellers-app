<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'discount', 'valid_till'];

    protected $casts = [
        'valid_till' => 'date',
    ];
}