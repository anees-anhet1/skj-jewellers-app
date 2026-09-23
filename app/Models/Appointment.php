<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
     use HasFactory;

    protected $fillable = ['name', 'phone', 'email', 'store', 'appointment_date', 'message'];

}
