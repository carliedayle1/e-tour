<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Check Travel Packages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col space-y-4">

                    @if($travel_packages->count() > 0)

                    <div>
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
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Package Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Package Types
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Available Dates
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Locations
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($travel_packages as $travelPackage)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $travelPackage->title }}
                                    </th>
                                    <td class="px-6 py-4">
                                        @foreach($travelPackage->packageTypes as $type)
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $type->title }}</span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $travelPackage->timeslots()->orderBy('id', 'asc')->first()->date  }} -
                                        {{ $travelPackage->timeslots()->orderBy('id', 'desc')->first()->date }}
                                    </td>
                                    <td class="px-6 py-4 flex">
                                        @foreach($travelPackage->locations as $location)
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                          </svg>                                          
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($travelPackage->status == 'inactive')
                                            <span class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ strtoupper($travelPackage->status) }}</span>
                                        @else 
                                            <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ strtoupper($travelPackage->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right ">
                                        <div class="flex justify-center space-x-4">
                                            <a href="/packages/{{ $travelPackage->id }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                                        </div>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="mt-6 p-4">
                        {{$travel_packages->links()}}
                    </div>
                    @else 
                    
                        <div class="block max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">No travel packages at the moment..</h5>
                            
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>




