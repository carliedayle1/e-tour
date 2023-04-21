<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Location;
use App\Models\SubsPerk;
use App\Models\Timeslot;
use Illuminate\Http\Request;
use App\Models\TravelPackage;
use App\Models\TravelPackageType;
use Illuminate\Validation\Rules\File;
use App\Notifications\NewTravelPackage;
use App\Notifications\VerifiedTravelPackage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;

class TravelPackageController extends Controller
{
    public function index()
    {



        if(!auth()->user()->type == 'agency') {
            abort(403, 'Unauthorized Action');
        }

        if(auth()->user()->stripe_id == null){
            return to_route('subscriptions');
        }

        return view('packages.index', [
            'travelPackages' => TravelPackage::
            where('agency_id', auth()->user()->agency->id)
            ->latest()
            ->filter(request(['search']))
            ->paginate(6),
        ]);
    }

    public function display(TravelPackage $package)
    {
        return view('packages.display', [
            'travel_package' => $package
        ]);
    }

    public function create()
    {

        if(!auth()->user()->type == 'agency') {
            abort(403, 'Unauthorized Action');
        }

        if(auth()->user()->subsperk->package_counter <= 0){
            toast('You already used up your travel package instance.','error');
            return back();
        }

        return view('packages.create');
    }

    public function store(Request $request)
    {
            
        $this->validateTravelPackage($request);

        $featured = false;
        if(auth()->user()->subscription != 'basic'){
            $featured = true;
        }

        $travel_package = TravelPackage::create([
            'agency_id' => auth()->user()->agency?->id,
            'title' => $request['title'],
            'description' => $request['description'],
            'featured' => $featured
        ]);

        // Create and store timeslots
        $this->createTimeslots($request, $travel_package);
        
        // Create and store locations
        $this->createLocations($request, $travel_package);

        // Create and store package types
        $this->createPackageTypes($request, $travel_package);

        auth()->user()->subsperk()->update([
            'package_counter' => auth()->user()->subsperk->package_counter - 1
        ]);

        //Notify admin
        // $admins = User::where('type', 'admin')->get();
        // Notification::send($admins, new NewTravelPackage($travel_package, auth()->user()->agency));

        toast('Travel Package created successfully','success');
        return to_route('package.index');
        
    }

    public function edit(TravelPackage $package)
    {
        if(!auth()->user()->type == 'agency') {
            abort(403, 'Unauthorized Action');
        }

        return view('packages.edit', [
            'travel_package' => $package
        ]);
    }

    public function update(TravelPackage $package, Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:6',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'slot' => 'required|numeric|integer|min:1',
            'hours_days' => 'required',
        ], [
            'hours_days.required' => 'Average hours/days is required.',
        ]);

        $package->timeslots()->delete();

        $this->createTimeslots($request, $package);

        $package->update([
            'title' => $request['title'],
            'description' => $request['description'],
        ]);

        toast('Travel Package updated successfully','info');
        return back();
    }

    public function delete(TravelPackage $package)
    {
        $package->locations->each(function ($location){
            if($location->image != null){
                Storage::delete($location->image);
                unlink(storage_path('app/public/'. $location->image));
            }
        });

        $package->locations()->delete();
        $package->timeslots()->delete();
        $package->packageTypes()->delete();
        $package->delete();

        toast('Travel Package deleted successfully','warning');
        return back();

    }

    public function all(Request $request)
    {

        if(!auth()->user()->type == 'admin') {
            abort(403, 'Unauthorized Action');
        }
        return view('packages.all', [
            'travel_packages' => TravelPackage::latest()
            ->filter(request(['search']))
            ->paginate(6)
        ]);
    }

    public function status(TravelPackage $package, Request $request)
    {

        $request->validate([
            'status' => 'required|min:3',
        ]);

        $package->update([
            'status' => strtolower($request['status']),
            'featured' => isset($request['featured']) ?? false
        ]);

        $package->agency->user->notify(new VerifiedTravelPackage($package));

        toast('Status updated successfully','success');
        return back();
    }

    private function validateTravelPackage($request)
    {
       return $request->validate([
            'title' => 'required|min:3',
            'description' => 'required|min:6',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'slot' => 'required|numeric|integer|min:1',
            'hours_days' => 'required',
            'location_name' => 'required',
            'location_name.*' => 'required|min:3',
            'location_description' => 'required',
            'location_description.*' => 'required|min:6',
            'location_image' => 'nullable',
            'location_image.*' => ['nullable', File::image()],
            'packageType_title' => 'required',
            'packageType_title.*' => 'required|min:3',
            'packageType_fee' => 'required',
            'packageType_fee.*' => 'required|numeric|min:1',
            'packageType_persons' => 'required',
            'packageType_persons.*' => 'required|numeric|integer|min:1'
        ], [
            'hours_days.required' => 'Average hours/days is required.',
            'location_name.*.required' => 'Location name is required.',
            'location_name.*.min' => 'Location name must be at least 3 characters.',
            'location_description.*.required' => 'Location description is required.',
            'location_description.*.min' => 'Location description must be at least 6 characters.',
            'location_image.*.image' => 'Location image must be an image.',
            'packageType_title.*.required' => 'Title is required.',
            'packageType_title.*.min' => 'Title must be at least 3 characters.',
            'packageType_fee.*.required' => 'Fee is required.',
            'packageType_fee.*.numeric' => 'Fee must be a number',
            'packageType_fee.*.min' => 'Fee must be at least 1',
            'packageType_persons.*.required' => 'Person/heads is required.',
            'packageType_persons.*.numeric' => 'Person/heads must be a number',
            'packageType_persons.*.min' => 'Person/heads must be at least 1',
            'packageType_persons.*.integer' => 'Person/heads must be a whole number',
        ]);
    }

    private function createTimeslots($request, $travel_package)
    {
        $start_date = Carbon::parse($request['start_date']);
        $end_date = Carbon::parse($request['end_date']);
        $days = $start_date->range($end_date, 1, 'day');

        foreach ($days->toArray() as $date) {
            $schedule_dates[] = new Timeslot([
                'travel_package_id' => 1,
                'date' => $date->toFormattedDateString(),
                'slots' => $request['slot'],
                'hours_days' => $request['hours_days'],
            ]);
        }

        $travel_package->timeslots()->saveMany($schedule_dates);
    }

    private function createLocations($request, $travel_package)
    {
        foreach ($request['location_name'] as $i => $location) {

            $location_image = null;
            if(isset(request()->file('location_image')[$i])) {
                $location_image = request()->file('location_image')[$i]->store('tourist-spots', 'public');
            }

            $locations[] = new Location([
                'name' => $location,
                'description' => $request['location_description'][$i],
                'image' => $location_image,
            ]);
        }

        $travel_package->locations()->saveMany($locations);
    }

    private function createPackageTypes($request, $travel_package)  
    {
        foreach ($request['packageType_title'] as $i => $packageType) {

            $packageTypes[] = new TravelPackageType([
                'title' => $packageType,
                'fee' => $request['packageType_fee'][$i],
                'max_person' => $request['packageType_persons'][$i],
            ]);
        }

        $travel_package->packageTypes()->saveMany($packageTypes);
    }

}
