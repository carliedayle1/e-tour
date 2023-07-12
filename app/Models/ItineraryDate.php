<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItineraryDate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }

    public function items()
    {
        return $this->hasMany(ItineraryItem::class);
    }

    public function checkIfDatesAreFilled()
    {
        return $this->items->count();
    }
}
