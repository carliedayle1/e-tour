<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Itinerary;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {

        if(auth()->user()->type === 'traveler'){
            $itineraries = Itinerary::where('user_id', auth()->user()->id)->get();
            $bookings = Booking::where('user_id', auth()->user()->id)->get();

            $events1 = $bookings->map(function ($item){
                return (object)[
                    'title' => $item->travelPackage->title,
                    'start' => Carbon::parse($item->timeslot->date)->toDateString(),
                    'end' => Carbon::parse($item->timeslot->date)->toDateString(),
                    'url' => '/travel-packages/view/' . $item->travelPackage->id
                ];
            })->toArray();
            

            $events2 = $itineraries->map(function ($item){
                return (object)[
                    'title' => $item->name,
                    'start' => Carbon::parse($item->start_date)->toDateString(),
                    'end' => Carbon::parse($item->end_date)->addDay()->toDateString(),
                    'url' => '/itineraries/edit/'. $item->id
                ];
            })->toArray();

            // dd($events2);

            $events = array_merge($events1, $events2);
        }

        if(auth()->user()->type === 'agency'){
            $bookings = Booking::where('agency_id', auth()->user()->agency->id)->get();

            $events = $bookings->map(function ($item){
                return (object)[
                    'title' => $item->travelPackage->title,
                    'start' => Carbon::parse($item->timeslot->date)->toDateString(),
                    'end' => Carbon::parse($item->timeslot->date)->toDateString(),
                    'url' => '/bookings'
                ];
            })->toArray();
        }

        if(auth()->user()->type === 'admin'){
            $itineraries = Itinerary::all();
            $bookings = Booking::all();

            $events1 = $bookings->map(function ($item){
                return (object)[
                    'title' => $item->travelPackage->title,
                    'start' => Carbon::parse($item->timeslot->date)->toDateString(),
                    'end' => Carbon::parse($item->timeslot->date)->toDateString(),
                    'url' => '/travel-packages/view/' . $item->travelPackage->id
                ];
            })->toArray();
            

            $events2 = $itineraries->map(function ($item){
                return (object)[
                    'title' => $item->name,
                    'start' => Carbon::parse($item->start_date)->toDateString(),
                    'end' => Carbon::parse($item->end_date)->addDay()->toDateString(),
                    'url' => '/itineraries/edit/'. $item->id
                ];
            })->toArray();

            $events = array_merge($events1, $events2);
        }
        

        // dd($events);

        return view('calendar.index', [
            'events' => $events
        ]);
    }
}
