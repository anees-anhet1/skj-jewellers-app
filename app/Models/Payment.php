<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'user_plan_id',
        'amount',
        'transaction_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userPlan()
    {
        return $this->belongsTo(UserPlan::class);
    }
}
