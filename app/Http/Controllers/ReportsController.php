<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Itinerary;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function itinerary(Itinerary $itinerary)
    {
        
        $data = [
            'itinerary' => $itinerary
        ];
        $pdf = Pdf::loadView('reports.itinerary', $data);

        return $pdf->download($itinerary->name .'.pdf');
        // return $pdf->stream();

    }

    public function booking(Booking $booking)
    {
        $data = [
            'booking' => $booking
        ];
        $pdf = Pdf::loadView('reports.booking', $data);

        return $pdf->download($booking->travelPackage->title .'.pdf');

        
    }

    // public function allBookings()
    // {
    //     $bookings = Booking::where('agency_id', auth()->user()->agency->id)->latest()->get();

    //     $data = [
    //         'bookings' => $bookings
    //     ];

    //     $pdf = Pdf::loadView('reports.allBookings', $data);

    //     return $pdf->stream('allbookings.pdf');
    // }
}
