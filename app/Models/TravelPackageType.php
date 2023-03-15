<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPackageType extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function travelPackage()
    {
        return $this->belongsTo(TravelPackage::class);
    }
}
