<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\Itinerary;
use App\Models\ItineraryDate;
use App\Models\ItineraryItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{
    public function index()
    {
        return view('itineraries.index', [
            'itineraries' => Itinerary::
            where('user_id', auth()->user()->id)
            ->latest()
            ->filter(request(['search']))
            ->paginate(6)
        ]);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $validated['user_id'] = auth()->user()->id;

        $itinerary = Itinerary::create($validated);

        $start_date = Carbon::parse($validated['start_date']);
        $end_date = Carbon::parse($validated['end_date']);
        $days = $start_date->range($end_date, 1, 'day');


        foreach ($days->toArray() as $date) {
            $itinerary_dates[] = new ItineraryDate([
                'itinerary_id' => $itinerary->id,
                'actual_date' => $date->toFormattedDateString(),
            ]);
        }

        $itinerary->dates()->saveMany($itinerary_dates);

        toast('Itinerary created successfully!','success');
        return back();
    }

    public function edit(Itinerary $itinerary)
    {
        if(auth()->user()->type === 'agency'){
            abort(403, 'Unauthorized Action');
        }
        
        return view('itineraries.edit', [
            'itinerary' => $itinerary
        ]);
    }

    public function customize(ItineraryDate $itineraryDate, Request $request)
    {
        // if($date->itinerary->user->id !== auth()->user()->id){
        //     abort(403, 'Unauthorized Action');
        // }

        if($request->query->count()){
            $query = Attraction::query();

            if($request->query('region_text')){
                $query->where('region_text', $request->query('region_text'));
            }

            if($request->query('province_text')){
                $query->where('province_text', $request->query('province_text'));
            }

            if($request->query('city_text')){
                $query->where('city_text', $request->query('city_text'));
            }

            $attractions = $query->get();
        }


        if(isset($attractions) && $attractions->count() === 0){
            toast('No tourist attractions listed on that address!','warning');
        }
        
        return view('itineraries.customize', [
            'date' => $itineraryDate,
            'attractions' => $attractions ?? collect([])
        ]);
    }

    public function storeItems(Request $request)
    {
        $validated = $request->validate([
            'attractions' => 'required',
            'itineraryDate' => 'required'
        ], [
            'attractions.required' => 'You must have at least 1 tourist attraction.'
        ]);

        $attractions = Attraction::whereIn('id', $validated['attractions'])->get();
        
        $date = ItineraryDate::where('id', $validated['itineraryDate'])->first();

        $total_travel_fees = $attractions->sum('fee');
        $total_travel_distance = 0;

        $array = $attractions->toArray();
        for($i = 0; $i < count($array); $i++){

            $itineraryItems[] = new ItineraryItem([
                'itinerary_date_id' => $date->id,
                'attraction_id' => $array[$i]['id'],
            ]);

            if($i+1 !== count($array)){
                $total_travel_distance += $this->distance($array[$i]['latitude'], $array[$i]['longitude'], $array[$i+1]['latitude'], $array[$i+1]['longitude']);
            }
        }

        $date->items()->saveMany($itineraryItems);
        $date->update([
            'filled' => true,
            'total_travel_fees' => $total_travel_fees,
            'total_travel_distance' => $total_travel_distance
        ]);

        toast('Tourist Attractions added on the list!','success');
        return redirect()->route('itinerary.edit', [
            'itinerary' => $date->itinerary->id
        ]);

    }

    public function distance($lat1, $lon1, $lat2, $lon2) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return 0;
        }
        else {
          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
            
          return number_format((float)($miles * 1.609344), 2, '.', '');
        }
      }
}
