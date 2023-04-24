<?php

namespace App\Models;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TravelPackage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('status', 'like', '%' . request('search') . '%')
                ->orWhereRelation('packageTypes', 'title', 'like', '%' . request('search') . '%')
                ->orWhereRelation('locations', 'name', 'like', '%' . request('search') . '%')
                ->orWhereRelation('packageTypes', 'description', 'like', '%' . request('search') . '%')
                ->orWhereRelation('timeslots', 'date', 'like', '%' . request('search') . '%');
        }
    }

    public function scopePackageType($query, array $filters)
    {
        if($filters['search'] ?? false) {
            $query->whereRelation('packageTypes', 'title', 'like', '%' . request('search') . '%')->get();
        }
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function timeslots()
    {
        return $this->hasMany(Timeslot::class);
    }

    public function lastTimeslot()
    {
        return $this->hasMany(Timeslot::class)->latest()->limit(1);
    }

    public function packageTypes()
    {
        return $this->hasMany(TravelPackageType::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
}
