<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function scopeFilter($query, array $filters) {
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('region_text', 'like', '%' . request('search') . '%')
                ->orWhere('province_text', 'like', '%' . request('search') . '%')
                ->orWhere('city_text', 'like', '%' . request('search') . '%')
                ->orWhere('barangay_text', 'like', '%' . request('search') . '%')
                ->orWhere('street', 'like', '%' . request('search') . '%');
        }
    }

}
