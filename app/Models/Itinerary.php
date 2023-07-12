<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhereRelation('dates', 'actual_date', 'like', '%' . request('search') . '%');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dates()
    {
        return $this->hasMany(ItineraryDate::class);
    }

    public function items()
    {
        return $this->hasManyThrough(ItineraryItem::class, ItineraryDate::class);
    }

    public function checkIfDatesAreFilled()
    {
        return $this->dates->contains(function ($item){
            return $item->filled === true;
        });
    }

    public function countDatesThatAreNotFilled()
    {
        return $this->dates->where('filled', false)->count();
    }

    public function countDatesThatAreFilled()
    {
        return $this->dates->where('filled', true)->count();
    }

    public function percentDateFilled()
    {
        return number_format((float)(($this->countDatesThatAreFilled()/$this->dates->count())*100), 0, '.', '');
    }

}
