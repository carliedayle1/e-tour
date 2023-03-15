<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ auth()->user()->type == 'admin' ? 'Check':'' }} Travel Package
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col space-y-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <a href="{{ route('package.all') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
                            @if(auth()->user()->type == 'agency')
                            <a href="/packages/edit/{{ $travel_package->id }}" type="button" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">Edit</a>
                            @endif
                        </div>
                        

                        
                            @if($travel_package->status == 'inactive')
                            <span class="bg-yellow-100 text-yellow-800 text-2xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ strtoupper($travel_package->status) }}</span>
                            @else
                            <span class="bg-green-100 text-green-800 text-2xl font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ strtoupper($travel_package->status) }}</span>
                            @endif
                       
                    </div>
                    @if(auth()->user()->type == 'admin')
                    <div class="border rounded dark:border-white border-gray-900 shadow-lg p-6">
                        <form action="/packages/check/{{ $travel_package->id }}" method="POST" class="flex flex-col space-y-4">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mark travel package as:</label>
                                <select id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                name="status">
                                <option {{ $travel_package->status == 'active' ?  'disabled':''}}>Active</option>
                                <option {{ $travel_package->status == 'inactive' ?  'disabled':''}}>Inactive</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />

                            </div>
                            <div>
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" {{ $travel_package->featured ? 'checked':'' }} type="checkbox" value="{{ $travel_package->featured ? 'checked':'' }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" name="featured">
                                    <label for="default-checkbox" class="ml-2 text-md font-medium text-gray-900 dark:text-gray-300">Feature this travel package.</label>
                                    <x-input-error :messages="$errors->get('featured')" class="mt-2" />

                                </div>
                            </div>
                            <div>
                                <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>
                            </div>
                        </form>
                    </div>
                    @endif
                    
                    <div>                       
                            <div class="grid gap-6 mb-6 mt-6">
                                 <!-- Title -->
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" disabled class="block mt-1 w-full" type="text" name="title" :value="old('title', $travel_package->title)" />
                                </div>
                                <!-- Description -->
                                <div>
                                    <x-input-label for="description" :value="__('Description')" />
                                    <x-text-input id="description" disabled class="block mt-1 w-full" type="text" name="description" :value="old('description', $travel_package->description)" />
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
                                                disabled
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
                                                disabled
                                                value="{{ old('end_date', \Carbon\Carbon::parse($travel_package->timeslots()->orderBy('id', 'desc')->first()->date)->format('m/d/Y')) }}"
                                                 >
                                            </div>
                                    </div>
                                </div>
                                <!-- Time Schedule -->
                                <div>
                                    <span class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">Time Schedule</span>
                                    <div class="flex space-x-4 mt-2">
                                        <div>
                                            <x-input-label for="from_time" :value="__('From')" />
                                            <x-text-input 
                                            id="from_time" 
                                            disabled
                                            class="block mt-1 w-full" 
                                            type="time" 
                                            name="from_time" 
                                            :value="old('from_time', $travel_package->timeslots()->orderBy('id', 'desc')->first()->from_time)" />
                                        </div>
                                        <div>
                                            <x-input-label for="to_time" :value="__('To')" />
                                            <x-text-input 
                                            id="to_time" 
                                            disabled
                                            class="block mt-1 w-full" 
                                            type="time" 
                                            name="to_time" 
                                            :value="old('to_time', $travel_package->timeslots()->orderBy('id', 'desc')->first()->to_time)" />
                                        </div>
                                    </div>
                                </div>
                                <!-- Availability Slot -->
                                <div>
                                    <x-input-label for="slot" :value="__('Availability Slot (Slots per day)')" />
                                    <x-text-input id="slot" class="block mt-1 w-full" type="number" name="slot" :value="old('slot', $travel_package->timeslots()->latest()->first()->slots)" />
                                </div>
                            </div>                           

                    </div>

                    <!-- Locations -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center" >
                            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Locations</span>
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
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Travel Package Types -->
                    <div class="space-y-4 mt-10">
                        <div class="flex justify-between items-center" >
                            <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Travel Package Types</span>
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
                                    </tr>
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
