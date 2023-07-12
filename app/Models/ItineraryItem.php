<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function date()
    {
        return $this->belongsTo(ItineraryDate::class);
    }
    
    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }
}
