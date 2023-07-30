<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Travel Package') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col space-y-4">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('package.index') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
                        
                        @if($travel_package->status == 'inactive')
                        <span class="bg-yellow-100 text-yellow-800 text-2xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ strtoupper($travel_package->status) }}</span>
                        @else
                        <span class="bg-green-100 text-green-800 text-2xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ strtoupper($travel_package->status) }}</span>
                        @endif
                       
                    </div>
                    
                    <div>                       
                        <form action="/packages/{{ $travel_package->id }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="grid gap-6 mb-6">
                                 <!-- Title -->
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $travel_package->title)" />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <!-- Description -->
                                <div>
                                    <x-input-label for="description" :value="__('Description')" />
                                    <x-textarea-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description', $travel_package->description)" />
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>
                                <!-- Start and End Date -->
                                <div>
                                    <div>
                                        <span class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">Start Date and End Date</span>
                                    </div>
                                    <div date-rangepicker class="flex items-center w-full" id="dateRangePickerId">
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                </div>
                                                <input 
                                                name="start_date" 
                                                type="text" 
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                                placeholder="Select start date" 
                                                value="{{ old('start', \Carbon\Carbon::parse($travel_package->timeslots()->orderBy('id', 'asc')->first()->date)->format('m/d/Y')) }}"
                                                 >
                                            </div>
                                            <span class="mx-4 text-gray-500">to</span>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                                </div>
                                                <input 
                                                name="end_date" 
                                                type="text" 
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select end date"
                                                value="{{ old('end_date', \Carbon\Carbon::parse($travel_package->timeslots()->orderBy('id', 'desc')->first()->date)->format('m/d/Y')) }}"
                                                 >
                                            </div>
                                    </div>
                                    <div>
                                        <x-input-error :messages="$errors->get('start_date')" class="mt-1" />
                                        <x-input-error :messages="$errors->get('end_date')" class="mt-1" />
                                    </div>
                                </div>
                                <!-- Average hours/days -->
                                <div>
                                    <x-input-label for="hours_days" name="hours_days" :value="__('Average Hours or Days')" />
                                    <x-text-input id="hours_days" class="block mt-1 w-full" type="text" name="hours_days" :value="old('hours_days', $travel_package->timeslots()->latest()->first()->hours_days)" />
                                    <x-input-error :messages="$errors->get('hours_days')" class="mt-2" />
                                </div>
                                <!-- Availability Slot -->
                                <div>
                                    <x-input-label for="slot" :value="__('Availability Slot (Slots per day)')" />
                                    <x-text-input id="slot" class="block mt-1 w-full" type="number" name="slot" :value="old('slot', $travel_package->timeslots()->latest()->first()->slots)" />
                                    <x-input-error :messages="$errors->get('slot')" class="mt-2" />
                                </div>
                            </div>                           

                           <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 uppercase transition ease-in-out duration-150">Edit Travel Package</button>
                        </form>

                    </div>

                    <!-- Locations -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center" >
                            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Locations</span>
                            <button type="button" data-modal-toggle="addLocationModal" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900"
                            x-data=>Add Location</button>

                            <!-- Add Modal -->
                            <div id="addLocationModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                        <!-- Modal header -->
                                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Add Location
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addLocationModal">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form action="/locations/store/{{ $travel_package->id }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="flex flex-col gap-4 mb-4">
                                                <div>
                                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                    <input 
                                                    type="text" 
                                                    name="location_name" 
                                                    id="name" 
                                                    value="{{ old('location_name') }}" 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <x-input-error :messages="$errors->get('location_name')" class="mt-2" />
                                                </div>
                                                <div>
                                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                                    <textarea id="description" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Write a description..."
                                                    name="location_description">{{ old('location_description') }}</textarea>      
                                                    <x-input-error :messages="$errors->get('location_description')" class="mt-2" />             
                                                </div>
                                                <div>                                                           
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Image</label>
                                                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="location_image" name="location_image" type="file">
                                                    <x-input-error :messages="$errors->get('location_image')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                    Add
                                                </button>
                                            
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <x-input-error :messages="$errors->get('location_name')" class="mt-2" />
                            <x-input-error :messages="$errors->get('location_description')" class="mt-2" />
                            <x-input-error :messages="$errors->get('location_image')" class="mt-2" />
                            <x-input-error :messages="$errors->get('edit_location_name')" class="mt-2" />
                            <x-input-error :messages="$errors->get('edit_location_description')" class="mt-2" />
                            <x-input-error :messages="$errors->get('edit_location_image')" class="mt-2" />
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Image
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($travel_package->locations as $location)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $location->name }}
                                        </th>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $location->description }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($location->image != null)                                           
                                            <img data-modal-target="defaultModal-{{ $location->id }}" data-modal-toggle="defaultModal-{{ $location->id }}" class="h-auto max-w-[100px]" src="{{ asset('/storage/'. $location->image) }}" alt="{{ $location->name }}">
                                                <!-- Image modal -->
                                                    <div id="defaultModal-{{ $location->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                                                            <!-- Modal content -->
                                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                <!-- Modal header -->
                                                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                        Image
                                                                    </h3>
                                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal-{{ $location->id }}">
                                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>
                                                                </div>
                                                                <!-- Modal body -->
                                                                <div class="p-6 space-y-6">
                                                                    <img class="h-auto max-w-full" src="{{ asset('/storage/'. $location->image) }}" alt="{{ $location->name }}">
                                                                </div>
                                                              
                                                            </div>
                                                        </div>
                                                    </div>
                                            @else 
                                                <span class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    No Image Available
                                                </span>
                                            @endif
                                        </td>                                     
                                        <td class="py-4 text-right">
                                            <div class="flex space-x-6 pr-3">
                                                <button id="updateProductButton" data-modal-toggle="updateLocationModal-{{ $location->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                                @if($travel_package->locations->count() > 1)
                                                <button data-modal-target="deleteLocationModal-{{ $location->id }}" data-modal-toggle="deleteLocationModal-{{ $location->id }}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                                @endif
                                            </div>
                                           
                                        </td>
                                    </tr>

                                    <!-- Update Modal -->
                                    <div id="updateLocationModal-{{ $location->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                <!-- Modal header -->
                                                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Update Location
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateLocationModal-{{ $location->id }}">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <form action="/locations/{{ $location->id }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="flex flex-col gap-4 mb-4">
                                                        <div>
                                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                            <input 
                                                            type="text" 
                                                            name="edit_location_name" 
                                                            id="name" 
                                                            value="{{ old('edit_location_name', $location->name) }}" 
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <x-input-error :messages="$errors->get('edit_location_name')" class="mt-2" />
                                                        </div>
                                                        <div>
                                                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                                            <textarea id="description" rows="5" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                                            placeholder="Write a description..."
                                                            name="edit_location_description">{{ old('edit_location_description', $location->description) }}</textarea>  
                                                            <x-input-error :messages="$errors->get('edit_location_description')" class="mt-2" />                  
                                                        </div>
                                                        <div>   
                                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Image</label>
                                                            @if($location->image != null)
                                                                <img 
                                                                src="{{ asset('storage/'. $location->image) }}" 
                                                                alt="{{ $location->name }}"
                                                                class="h-auto max-w-[100px] mb-3 justify-content-center"
                                                                >
                                                            @endif
                                                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" name="edit_location_image">
                                                            <x-input-error :messages="$errors->get('edit_location_image')" class="mt-2" />
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center space-x-4">
                                                        <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                            Update
                                                        </button>
                                                    
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div id="deleteLocationModal-{{ $location->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                        <div class="relative w-full h-full max-w-md md:h-auto">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="deleteLocationModal-{{ $location->id }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-6 text-center">
                                                    <form action="/locations/{{ $location->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this location?</h3>
                                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Yes, I'm sure
                                                        </button>
                                                        <button data-modal-hide="deleteLocationModal-{{ $location->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Travel Package Types -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center" >
                            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Travel Package Types</span>
                            <button type="button" data-modal-toggle="addPackageTypeModal" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Add Travel Package Type</button>

                            <!-- Add Modal -->
                            <div id="addPackageTypeModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                        <!-- Modal header -->
                                        <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Add Travel Package Type
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="addPackageTypeModal">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form action="/packageTypes/store/{{ $travel_package->id }}" method="POST">
                                            @csrf
                                            <div class="flex flex-col gap-4 mb-4">
                                                <div>
                                                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                                    <input 
                                                    type="text" 
                                                    name="packageType_title" 
                                                    id="title" 
                                                    value="{{ old('packageType_title') }}" 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <x-input-error :messages="$errors->get('packageType_title')" class="mt-2" />
                                                </div>
                                                <div>
                                                    <label for="fee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fee</label>
                                                    <input 
                                                    type="number" 
                                                    name="packageType_fee"
                                                    step="0.01" 
                                                    id="fee" 
                                                    value="{{ old('packageType_fee') }}" 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <x-input-error :messages="$errors->get('packageType_fee')" class="mt-2" />
                                                </div>
                                                <div>
                                                    <label for="max_persons" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Max Person/Heads</label>
                                                    <input 
                                                    type="number" 
                                                    name="packageType_max_person" 
                                                    id="max_persons" 
                                                    value="{{ old('packageType_max_person') }}" 
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <x-input-error :messages="$errors->get('packageType_title')" class="packageType_max_person" />
                                                </div>

                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                    Add
                                                </button>
                                            
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <x-input-error :messages="$errors->get('packageType_title')" class="mt-2" />
                            <x-input-error :messages="$errors->get('packageType_fee')" class="mt-2" />
                            <x-input-error :messages="$errors->get('packageType_max_person')" class="mt-2" />
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Title
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Fee
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Max Person/Heads
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($travel_package->packageTypes as $packageType)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $packageType->title }}
                                        </th>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            Php {{ number_format((float)$packageType->fee, 2, '.', ''); }}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $packageType->max_person }}
                                        </td>                                     
                                        <td class="py-4 text-right">
                                            <div class="flex space-x-6 pr-3">
                                                <button data-modal-toggle="updatePackageTypeModal-{{ $packageType->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
                                                @if($travel_package->packageTypes->count() > 1)
                                                <button data-modal-toggle="deletePackageTypeModal-{{ $packageType->id }}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                                @endif
                                            </div>
                                            
                                        </td>
                                    </tr>

                                    <!-- Update Modal -->
                                    <div id="updatePackageTypeModal-{{ $packageType->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                                        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                <!-- Modal header -->
                                                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                        Update Travel Package
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updatePackageTypeModal-{{ $packageType->id }}">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <form action="/packageTypes/{{ $packageType->id }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="flex flex-col gap-4 mb-4">
                                                        <div>
                                                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                                            <input 
                                                            type="text" 
                                                            name="edit_packageType_title" 
                                                            id="title" 
                                                            value="{{ old('edit_packageType_title', $packageType->title) }}" 
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <x-input-error :messages="$errors->get('edit_packageType_title')" class="mt-2" />
                                                        </div>
                                                        <div>
                                                            <label for="fee" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fee</label>
                                                            <input 
                                                            type="number" 
                                                            name="edit_packageType_fee"
                                                            step="0.01" 
                                                            id="fee" 
                                                            value="{{ old('edit_packageType_fee', $packageType->fee) }}" 
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <x-input-error :messages="$errors->get('edit_packageType_fee')" class="mt-2" />
                                                        </div>
                                                        <div>
                                                            <label for="max_persons" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Max Person/Heads</label>
                                                            <input 
                                                            type="number" 
                                                            name="edit_packageType_max_person" 
                                                            id="max_persons" 
                                                            value="{{ old('edit_packageType_max_person',$packageType->max_person) }}" 
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                            <x-input-error :messages="$errors->get('edit_packageType_title')" class="packageType_max_person" />
                                                        </div>
        
                                                    </div>
                                                    <div class="flex items-center space-x-4">
                                                        <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                            Add
                                                        </button>
                                                    
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div id="deletePackageTypeModal-{{ $packageType->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                        <div class="relative w-full h-full max-w-md md:h-auto">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="deletePackageTypeModal-{{ $packageType->id }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-6 text-center">
                                                    <form action="/packageTypes/{{ $packageType->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this travel package type?</h3>
                                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Yes, I'm sure
                                                        </button>
                                                        <button data-modal-hide="deletePackageTypeModal-{{ $packageType->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>

</x-app-layout>
