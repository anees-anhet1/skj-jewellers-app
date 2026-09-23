<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'weight',
        'description',
        'image',
        'is_featured'
    ];
}
