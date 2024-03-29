<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Travel Plan and Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col space-y-4">

                @if($bookings->count() > 0)

                {{-- <div>
                    <a href="{{ route('package.index') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">View Calendar</a>
                </div> --}}

                {{-- <div>
                    <form action="/packages">   
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search travel packages.." name="search" required>
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>
                    </form>
                </div> --}}
                
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Travel Package Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Scheduled Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Average Days/Hours
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Fee
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                    
                                        <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                          
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <a href="/travel-packages/view/{{ $booking->travelPackage->id }}" class="cursor-pointer">
                                                {{ $booking->travelPackage->title }}
                                                </a>
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $booking->timeslot->date }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $booking->timeslot->hours_days }}
                                            </td>
                                            <td class="px-6 py-4">
                                                ₱{{ $booking->travelPackageType->fee }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ strtoupper($booking->status) }}
                                            </td>
                                            <td class="flex px-6 py-4 gap-x-4">
                                                @if(strtoupper(trim($booking?->status)) != "CANCELLED" || $booking->status === null)
                                                <a href="/travel-packages/view/{{ $booking->travelPackage->id }}" class="font-medium text-green-600 dark:text-green-500 hover:underline">View Package</a>
                                              
                                                    <button type="button" 
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'cancel-booking-{{ $booking->id }}')"
                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Cancel Booking</button>
                                               
                                                <x-modal name="cancel-booking-{{ $booking->id }}" :show="$errors->isNotEmpty()" focusable>
                                                    <form method="post" action="/booking/cancel/{{ $booking->id }}" class="p-6">
                                                        @csrf
                                            
                                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                            {{ __('Are you sure you want to cancel your booking?') }}
                                                        </h2>
                                            
                                            
                                                        <div class="mt-6 flex justify-end">
                                                            <x-danger-button class="mr-3">
                                                                {{ __('Yes') }}
                                                            </x-danger-button>
                                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                                {{ __('Back') }}
                                                            </x-secondary-button>
                                            

                                                        </div>
                                                    </form>
                                                </x-modal>
                                               
                                                <a href="/reports/bookings/{{ $booking->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Export to PDF</a>
                                                @endif
                                            </td>
                                       
                                        </tr>
                                   
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                @else 
                <div class="block max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">No scheduled bookings at the moment..</h5>
                    
                </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




