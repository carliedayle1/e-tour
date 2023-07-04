<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Tourist Attractions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col space-y-4">
                    <div>
                        <a href="{{ route('admin.attractions') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
                    </div>
                    
                    <div>                       
                        <form action="/attractions/update/{{ $attraction->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="grid gap-6 mb-6">
                                 <!-- Title -->
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $attraction->title)" />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <!-- Description -->
                                <div>
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the description here...">{{ old('title', $attraction->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <!-- Image -->

                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="image">Image</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="image" name="image" type="file">

                                <!-- Operating days/time -->
                                <div>
                                    <x-input-label for="open_time" :value="__('Operating Days/Time')" />
                                    <x-text-input id="open_time" class="block mt-1 w-full" type="text" name="open_time" :value="old('open_time')" />
                                    <x-input-error :messages="$errors->get('open_time', $attraction->open_time)" class="mt-2" />
                                </div>

                                <!-- Average Visit Time -->
                                <div>
                                    <x-input-label for="time" :value="__('Average Visit Time (Hours)')" />
                                    <x-text-input id="time" class="block mt-1 w-full" type="number" name="time" :value="old('time', $attraction->time)" />
                                    <x-input-error :messages="$errors->get('time')" class="mt-2" />
                                </div>
                                <!-- Fee -->
                                <div>
                                    <x-input-label for="fee" :value="__('Fee')" />
                                    <x-text-input id="fee" class="block mt-1 w-full" type="number" name="fee" :value="old('fee', $attraction->fee)" />
                                    <x-input-error :messages="$errors->get('fee')" class="mt-2" />
                                </div>
                                <!-- Address -->
                                <div>
                                    <div class="mb-4">
                                        <span class="font-medium text-md text-gray-800 dark:text-gray-200 leading-tight">Complete Address</span>
                                        
                                    </div>
                                    <div class="mb-4">
                                        <span class="bg-yellow-100 text-yellow-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Note: Leave the region, province, city and barangay inputs as blank if you want to retain the previous values</span>
                                    </div>
                                    
                                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Region</label>
                                        <select id="region" name="region" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        </select>
                                        <input type="hidden" name="region_text" id="region-text">
                                    <div>
                                        <x-input-error :messages="$errors->get('region')" class="mt-1" />
                                    </div>
                                </div>

                                <div>
                                    
                                    <label for="province" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Province</label>
                                    <select id="province" name="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </select>
                                    <input type="hidden" name="province_text" id="province-text">
                                  
                                    <div>
                                        <x-input-error :messages="$errors->get('province')" class="mt-1" />
                                    </div>
                                </div>

                                <div>
                                    
                                    <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                                    <select id="city" name="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </select>
                                    <input type="hidden" name="city_text" id="city-text">
                                  
                                    <div>
                                        <x-input-error :messages="$errors->get('city')" class="mt-1" />
                                    </div>
                                </div>

                                <div>
                                    
                                    <label for="barangay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barangay</label>
                                    <select id="barangay" name="barangay" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </select>
                                    <input type="hidden" name="barangay_text" id="barangay-text">
                                  
                                    <div>
                                        <x-input-error :messages="$errors->get('barangay')" class="mt-1" />
                                    </div>
                                </div>
                                 <!-- Street -->
                                 <div>
                                    <x-input-label for="street" :value="__('Street')" />
                                    <x-text-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street', $attraction->street)" />
                                    <x-input-error :messages="$errors->get('street')" class="mt-2" />
                                </div>

                                 <!-- Coordinates -->
                                 <div>
                                    <x-input-label for="longitude" :value="__('Longitude')" />
                                    <x-text-input id="longitude" class="block mt-1 w-full" type="text" name="longitude" :value="old('longitude', $attraction->longitude)" />
                                    <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="latitude" :value="__('Latitude')" />
                                    <x-text-input id="latitude" class="block mt-1 w-full" type="text" name="latitude" :value="old('latitude', $attraction->latitude)" />
                                    <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                                </div>
                            </div>
                           <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 uppercase transition ease-in-out duration-150">Edit Tourist Attraction</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
