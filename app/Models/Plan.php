<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Subscription;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subscription() 
    {
        return $this->hasMany(Subscription::class, 'plan_id');
    }
}
