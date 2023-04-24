<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
       
    </head>
    <body class="antialiased">
        <x-nav-guest />


        <div class="relative pt-24 flex flex-col sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

           
            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-6xl lg:py-16">
                    <h2 class="mb-6 text-xl font-semibold leading-none text-gray-900 md:text-4xl dark:text-white">{{ $travel_package->title }}</h2>
                    
                    <dl>
                        <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Details</dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $travel_package->description }}</dd>
                    </dl>
                    <dl class="flex items-center space-x-6">
                        <div>
                            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Package available until</dt>
                            <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $travel_package->timeslots()->latest()->first()->date }}</dd>
                        </div>
                        <div>
                            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Average Hours/Days</dt>
                            <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $travel_package->timeslots[0]->hours_days }}</dd>
                        </div>
                        <div>
                            <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Average slots per day</dt>
                            <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $travel_package->timeslots[0]->slots }}</dd>
                        </div>
                    </dl>
                    <div>
                        <h2 class="mb-6 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Destinations</h2>
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
                                                                        {{ $location->name }}
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

                    <div class="my-8">
                        <h2 class="mb-6 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Package Types</h2>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                            Package Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Fee
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                            Maximum Pax
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($travel_package->packageTypes as $packageType)
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            {{ $packageType->title }}
                                        </th>
                                        <td class="px-6 py-4">
                                            ₱{{ $packageType->fee }}
                                        </td>
                                        <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                            {{ $packageType->max_person }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="flex items-center space-x-4 mt-8">
                        <a href="/login" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            Book Now
                        </a>   
                    </div>
                </div>
              </section>


           


           
        </div>
    </body>

</html>




