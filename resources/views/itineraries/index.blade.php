<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Your Itineraries') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col space-y-4">
                    <div>
                        <button 
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'create-itinerary')"
                        type="button" 
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create Your Own Itinerary</button>
                    </div>

                    <x-modal name="create-itinerary" :show="$errors->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('itinerary.store') }}" class="p-6">
                            @csrf
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                {{ __('Create Your Own Itinerary') }}
                            </h2>

                            <p class="mt-1 mb-4 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Once the itinerary is created, you can customize and pick any of the tourist attractions you will visit in the days you set.') }}
                            </p>

                            <div class="my-6">
                                <div class="mb-6">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Itinerary Name</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="mb-6">
                                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="message" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here...">{{ old('description') != null ? old('description'):'' }}</textarea>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                               
                                <!-- Start and End Date -->
                                <div>
                                    <div>
                                    <span class="text-sm text-gray-800 dark:text-gray-200 leading-tight">Start Date and End Date</span>
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
                                                value="{{ old('start_date') }}"
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
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                                                placeholder="Select end date"
                                                value="{{ old('end_date') }}"
                                                    >
                                            </div>
                                        </div>
                                    <div>
                                        <x-input-error :messages="$errors->get('start_date')" class="mt-1" />
                                        <x-input-error :messages="$errors->get('end_date')" class="mt-1" />
                                    </div>
                                </div>

                            </div>
                           

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-primary-button class="ml-3">
                                    {{ __('Create Itinerary') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>

                    @if($itineraries->count() > 0)

                    <div class=" z-0">
                        <form action="/itineraries">   
                            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search itineraries.." name="search" required>
                                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                            </div>
                        </form>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-3">
                                        Description
                                    </th> --}}
                                    <th scope="col" class="px-6 py-3">
                                        Completion
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($itineraries as $itinerary)
                                
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $itinerary->name }}
                                    </th>
                                    {{-- <th class="px-6 py-4 text-ellipsis font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $itinerary->description }} 
                                    </th> --}}
                                    <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @if($itinerary->percentDateFilled() >= 100)
                                        <span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $itinerary->percentDateFilled() . ' %' }}</span>
                                        @else
                                        <span data-tooltip-target="tooltip-default" class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ $itinerary->percentDateFilled() . ' %' }}</span>
                                        <div id="tooltip-default" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                           {{ 'You have to fill ' . $itinerary->countDatesThatAreNotFilled() . ' day/s in your itinerary'}}
                                            <div class="tooltip-arrow" data-popper-arrow></div>
                                        </div>
                                        @endif
                                    </th>
                                    
                                    <td class="px-6 py-4 text-right ">
                                        <div class="flex justify-center space-x-4">
                                            <a href="/reports/itineraries/{{ $itinerary->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Export to PDF</a>
                                            <a href="/itineraries/edit/{{ $itinerary->id }}" class="font-medium text-green-600 dark:text-green-500 hover:underline">Edit</a>
                                            <button data-modal-target="deleteItinerary-{{ $itinerary->id }}" data-modal-toggle="deleteItinerary-{{ $itinerary->id }}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                                        </div>
                                        
                                        <!-- Delete travel package modal -->
                                        <div id="deleteItinerary-{{ $itinerary->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                            <div class="relative w-full h-full max-w-md md:h-auto">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="deleteItinerary-{{ $itinerary->id }}">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-6 text-center">
                                                        <form action="/itineraries/{{ $itinerary->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this itinerary?</h3>
                                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                                Yes, I'm sure
                                                            </button>
                                                            <button data-modal-hide="deleteItinerary-{{ $itinerary->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancel</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="mt-6 p-4">
                        {{$itineraries->links()}}
                    </div>
                    @else 
                    
                        <div class="block max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">You have no created itineraries at the moment..</h5>
                            
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>




