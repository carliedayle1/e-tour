<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Compare Travel Packages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col space-y-4">

                    <div>
                        <form action="{{ route('package.compare') }}">
                            <div>
                                <h3 class="mb-3 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Choose any tourist attraction</h3>
                            </div>
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                
                                    <select id="attraction1" name="attraction1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach($attractions as $attraction)
                                        <option value="{{ $attraction->id }}">{{ $attraction->title }}</option>
                                        @endforeach
    
                                    </select>
                                    <x-input-error :messages="$errors->get('attraction1')" class="mt-2" />
                                </div>
                                <div>                             
                                    
                                    <select id="attraction2" name="attraction2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach($attractions as $attraction)
                                        <option value="{{ $attraction->id }}">{{ $attraction->title }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('attraction2')" class="mt-2" />
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-500 to-pink-500 group-hover:from-purple-500 group-hover:to-pink-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800">
                                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                        Submit
                                    </span>
                                  </button>
                            </div>
                            
                        </form>
    
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            @if($attraction_1 != null)
                                <div>
                                    <div class="flex flex-col justify-center"> 
                                        <img class=" h-80 max-w-full object-cover object-center shadow-md rounded-md" src="{{ asset('/storage/'. $attraction_1->image) }}" alt="{{ $attraction_1->title }}">
                                    </div>
                
                                    <div class="flex flex-col items-center justify-center">
                                        <h1 class="mb-4 mt-8 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">{{ $attraction_1->title }}</h1>
                                        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl px-8  dark:text-gray-400">{{ $attraction_1->description }}</p>
                                    </div>
                
                                    <section class="bg-white dark:bg-gray-900 rounded-lg">
                                        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                                            <div class="space-y-8 md:grid md:grid-cols-1">
                                                <div class="flex flex-col justify-center items-center">
                                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                                          </svg>
                                                          
                                                    </div>
                                                    <h3 class="mb-2 text-lg font-bold dark:text-white">Location</h3>
                                                    <p class="text-gray-500 dark:text-gray-400 text-center truncate">{{ $attraction_1?->street }} {{ $attraction_1?->barangay_text }}, {{ $attraction_1->city_text }}, {{ $attraction_1->province_text }}</p>
                                                 
                                                </div>
                                                <div class="flex flex-col justify-center items-center">
                                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                          </svg>
                                                          
                                                          
                                                    </div>
                                                    <h3 class="mb-2 text-lg font-bold dark:text-white">Operating Days/Time</h3>
                                                    <p class="text-gray-500 dark:text-gray-400 text-center">{{ $attraction_1->open_time }}</p>
                                                </div>
                                                <div class="flex flex-col justify-center items-center">
                                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                          </svg>
                                                          
                                                    </div>
                                                    <h3 class="mb-2 text-lg font-bold dark:text-white">Average Visit Time</h3>
                                                    <p class="text-gray-500 dark:text-gray-400">{{ $attraction_1->time }} hour/s</p>
                                                </div>
                                              
                                                <div class="flex flex-col justify-center items-center">
                                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                                          </svg>
                                                          
                                                          
                                                    </div>
                                                    <h3 class="mb-2 text-lg font-bold dark:text-white">Fee</h3>
                                                    <p class="text-gray-500 dark:text-gray-400 text-center truncate">₱{{ $attraction_1->fee }}</p>
                                                 
                                                </div>
                
                                                </div>
                                        </div>
                                    </section>
                                </div>
                            @endif
                            @if($attraction_2 != null)
                                <div>
                                    <div class="flex flex-col justify-center"> 
                                        <img class=" h-80 max-w-full object-cover object-center shadow-md rounded-md" src="{{ asset('/storage/'. $attraction_2->image) }}" alt="{{ $attraction_2->title }}">
                                    </div>
                
                                    <div class="flex flex-col items-center justify-center">
                                        <h1 class="mb-4 mt-8 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">{{ $attraction_2->title }}</h1>
                                        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl px-8 dark:text-gray-400">{{ $attraction_2->description }}</p>
                                    </div>
                
                                    <section class="bg-white dark:bg-gray-900 rounded-lg">
                                        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                                            <div class="space-y-8 md:grid md:grid-cols-1">
                                                <div class="flex flex-col justify-center items-center">
                                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                                          </svg>
                                                          
                                                    </div>
                                                    <h3 class="mb-2 text-lg font-bold dark:text-white">Location</h3>
                                                    <p class="text-gray-500 dark:text-gray-400 text-center truncate">{{ $attraction_2?->street }} {{ $attraction_2?->barangay_text }}, {{ $attraction_2->city_text }}, {{ $attraction_2->province_text }}</p>
                                                 
                                                </div>
                                                <div class="flex flex-col justify-center items-center">
                                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                          </svg>
                                                          
                                                          
                                                    </div>
                                                    <h3 class="mb-2 text-lg font-bold dark:text-white">Operating Days/Time</h3>
                                                    <p class="text-gray-500 dark:text-gray-400 text-center">{{ $attraction_2->open_time }}</p>
                                                </div>
                                                <div class="flex flex-col justify-center items-center">
                                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                          </svg>
                                                          
                                                    </div>
                                                    <h3 class="mb-2 text-lg font-bold dark:text-white">Average Visit Time</h3>
                                                    <p class="text-gray-500 dark:text-gray-400">{{ $attraction_2->time }} hour/s</p>
                                                </div>
                                              
                                                <div class="flex flex-col justify-center items-center">
                                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                                          </svg>
                                                          
                                                          
                                                    </div>
                                                    <h3 class="mb-2 text-lg font-bold dark:text-white">Fee</h3>
                                                    <p class="text-gray-500 dark:text-gray-400 text-center truncate">₱{{ $attraction_2->fee }}</p>
                                                 
                                                </div>
                
                                                </div>
                                        </div>
                                    </section>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div>
                        <form action="{{ route('package.compare') }}">
                            <div>
                                <h3 class="mb-3 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Choose any travel package</h3>
                            </div>
                            <div class="grid gap-6 mb-6 md:grid-cols-2">
                                <div>
                                
                                    <select id="package1" name="package1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach($travel_packages as $travel_package)
                                        <option value="{{ $travel_package->id }}">{{ $travel_package->title }}</option>
                                        @endforeach
    
                                    </select>
                                    <x-input-error :messages="$errors->get('package1')" class="mt-2" />
                                </div>
                                <div>                             
                                    
                                    <select id="package2" name="package2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        @foreach($travel_packages as $travel_package)
                                        <option value="{{ $travel_package->id }}">{{ $travel_package->title }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('package2')" class="mt-2" />
                                </div>
                            </div>
                            <div>
                                <x-input-error :messages="$errors->get('same')" class="my-4" />
                            </div>
                            <div>
                                <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                        Submit
                                    </span>
                                  </button>
                            </div>
                            
                        </form>
    
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            @if($package_1 != null)
                            <div>
                                <section class="bg-white dark:bg-gray-900">
                                    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-12">
                                        <h2 class="mb-4 text-xl font-semibold leading-none text-gray-900 md:text-4xl dark:text-white">{{ $package_1->title }}</h2>
                                        <div>
                                            <div class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Description</div>
                                            <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $package_1->description }}</div>
                                        </div>
                                        <dl class="flex items-center space-x-6">
                                            <div>
                                                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Package available until</dt>
                                                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $package_1->timeslots()->latest()->first()->date }}</dd>
                                            </div>
                                            <div>
                                                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Average Hours/Days</dt>
                                                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $package_1->timeslots[0]->hours_days }}</dd>
                                            </div>
                                            <div>
                                                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Average slots per day</dt>
                                                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $package_1->timeslots[0]->slots }}</dd>
                                            </div>
                                        </dl>
                                        <div>
                                            <h2 class="mb-6 text-xl font-semibold leading-none text-gray-900 md:text-xl dark:text-white">Destinations</h2>
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
                                                        @foreach($package_1->locations as $location)
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
                                                        @foreach($package_1->packageTypes as $packageType)
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
                                    </div>
                                  </section>
                            </div>
                            @endif
                            @if($package_2 != null)
                            <div>
                                <section class="bg-white dark:bg-gray-900">
                                    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-12">
                                        <h2 class="mb-4 text-xl font-semibold leading-none text-gray-900 md:text-4xl dark:text-white">{{ $package_2->title }}</h2>
                                        <div>
                                            <div class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Description</div>
                                            <div class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $package_2->description }}</div>
                                        </div>
                                        <dl class="flex items-center space-x-6">
                                            <div>
                                                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Package available until</dt>
                                                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $package_2->timeslots()->latest()->first()->date }}</dd>
                                            </div>
                                            <div>
                                                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Average Hours/Days</dt>
                                                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $package_2->timeslots[0]->hours_days }}</dd>
                                            </div>
                                            <div>
                                                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Average slots per day</dt>
                                                <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">{{ $package_2->timeslots[0]->slots }}</dd>
                                            </div>
                                        </dl>
                                        <div>
                                            <h2 class="mb-6 text-xl font-semibold leading-none text-gray-900 md:text-xl dark:text-white">Destinations</h2>
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
                                                        @foreach($package_2->locations as $location)
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
                                                        @foreach($package_2->packageTypes as $packageType)
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
                                    </div>
                                  </section>
                            </div>
                            @endif
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




