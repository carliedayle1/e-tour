<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function travelPackages()
    {
        return $this->hasMany(TravelPackage::class);
    }
}
