<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;


class AttractionController extends Controller
{


    public function index() 
    {
        if(auth()->user()->type !== 'admin') {
            abort(403, 'Unauthorized Action');
        }
        return view('attractions.index', [
            'attractions' => Attraction::latest()
            ->filter(request(['search']))
            ->paginate(6),
        ]);
    }

    public function create()
    {
        if(auth()->user()->type !== 'admin') {
            abort(403, 'Unauthorized Action');
        }
        return view('attractions.create');
    }

    public function store(Request $request){

        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:6',
            'time' => 'required|numeric',
            'fee' => 'required|numeric',
            'region' => 'required|numeric',
            'region_text' => 'required|string',
            'province' => 'required|numeric',
            'province_text' => 'required|string',
            'city' => 'required|numeric',
            'city_text' => 'required|string',
            'barangay' => 'nullable|numeric',
            'barangay_text' => 'nullable|string',
            'street' => 'nullable|string',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'open_time' => 'required|string',
            'image' => ['required', File::image()]
        ]);

        if(request()->file('image') !== null) {
            $validated['image'] = request()->file('image')->store('tourist-attractions', 'public');
        }

        Attraction::create($validated);

        toast('Tourist Attraction created!','success');
        return to_route('admin.attractions');
    }

    public function show(Attraction $attraction){

        return view('attractions.show', [
            'attraction' => $attraction
        ]);
    }

    public function edit(Attraction $attraction){
        if(auth()->user()->type !== 'admin') {
            abort(403, 'Unauthorized Action');
        }
        return view('attractions.edit', [
            'attraction' => $attraction
        ]);
    }

    public function update(Attraction $attraction, Request $request){

        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:6',
            'time' => 'required|numeric',
            'fee' => 'required|numeric',
            'region' => 'nullable|numeric',
            'region_text' => 'nullable|string',
            'province' => 'nullable|numeric',
            'province_text' => 'nullable|string',
            'city' => 'nullable|numeric',
            'city_text' => 'nullable|string',
            'barangay' => 'nullable|numeric',
            'barangay_text' => 'nullable|string',
            'street' => 'nullable|string',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'open_time' => 'required|string',
            'image' => ['nullable', File::image()]
        ]);

        if(request()->file('image') !== null) {
            $validated['image'] = request()->file('image')->store('tourist-attractions', 'public');
        }

        $attraction->update(array_filter($validated));
        toast('Tourist Attraction updated!','success');
        return to_route('admin.attractions');
    }

    public function delete(Attraction $attraction){
        $attraction->delete();

        toast('Tourist Attraction deleted!','warning');
        return to_route('admin.attractions');
    }
}
