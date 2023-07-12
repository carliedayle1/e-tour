<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Assign/Edit Itinerary Date') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col space-y-4">
                    <div>
                        <a href="{{ route('itineraries') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
                    </div>
                    
                    <div class="px-10">                       
                        <form action="/itineraries/customize/{{ $date->id }}" method="GET">
                            <div class="my-6">
                                <div class="my-3">
                                    <label for="name" class="block mb-2 text-md font-medium text-gray-900 dark:text-white">Itinerary Date</label>
                                    <input type="text" id="name" disabled value="{{ $date->actual_date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    
                                </div>

                                <div class="my-3">
                                    <h3 class="my-3 text-lg font-bold text-gray-900 dark:text-white">Select the address of the tourist attractions you want to add in your list</h3>

                                    <div class="flex flex-col gap-y-4">
                                        <div>
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
                                    </div>
                                </div>
                                <h3 class="my-3 text-sm font-bold text-gray-900 dark:text-white">Note: After you click the button below, a new form will show under the button to fill up your list of tourist attractions in the address you selected.</h3>

                            </div>
                            <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800">
                                <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                    Load Tourist Attractions
                                </span>
                              </button>
                        </form>
                    </div>
                    
                    @if($attractions->count() > 0)
                        <div class="px-12">
                            <h3 class="my-3 text-lg font-bold text-gray-900 dark:text-white">These tourist attractions are all located in 
                                <span class="font-semibold text-gray-900 underline dark:text-white decoration-green-500">{{ request()->query('city_text') }}</span>
                                <span class="font-semibold text-gray-900 underline dark:text-white decoration-sky-500">{{ request()->query('province_text') }}</span> 
                                <span class="font-semibold text-gray-900 underline dark:text-white decoration-indigo-500">{{ request()->query('region_text') }}</span> </h3>
                            <h4 class="my-3 text-md font-bold text-gray-900 dark:text-white">You can add up to 8 tourist attractions in a day.</h4>
                            
                            <form action="/itineraries/items/store" method="POST">
                                @csrf
                                <div class="my-4">
                                    <x-input-error :messages="$errors->get('attractions')" class="mt-1" />
                                </div>

                                <input type="hidden" name="itineraryDate" value="{{ $date->id }}">

                                <div x-data="locationHandler()">
                                    <div class="my-6">
                                    
                                        <label for="attraction1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tourist Attraction #1</label>
                                        <select 
                                        id="attraction1" 
                                        @change="handleAttraction1"
                                        name="attractions[]"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <option selected disabled>Choose a tourist attraction</option>
                                            @foreach($attractions as $attraction)
                                            <option value="{{ $attraction->id }}" latitude="{{ $attraction->latitude }}" longitude="{{ $attraction->longitude }}">{{ $attraction->title }}</option>
                                            @endforeach
                                        </select>
                                        
        
                                    </div>

                                    <h3 class="my-3 text-sm font-bold text-gray-900 dark:text-white" x-show="showDistance2">Total Distance Travel from #1 to #2 
                                        <span class="bg-yellow-100 ml-3 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300" x-text="distance(latitude1, longitude1, latitude2, longitude2) + ' KM'"></span>
                                    </h3>

                                    <div class="my-6">
                                        
                                        <label for="attraction2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tourist Attraction #2</label>
                                        <select @change="handleAttraction2" name="attractions[]" id="attraction2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <option selected disabled>Choose a tourist attraction</option>
                                            @foreach($attractions as $attraction)
                                            <option value="{{ $attraction->id }}" latitude="{{ $attraction->latitude }}" longitude="{{ $attraction->longitude }}">{{ $attraction->title }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>

                                    <h3 class="my-3 text-sm font-bold text-gray-900 dark:text-white" x-show="showDistance3">Total Distance Travel from #2 to #3 
                                        <span class="bg-yellow-100 ml-3 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300" x-text="distance(latitude2, longitude2, latitude3, longitude3) + ' KM'"></span>
                                    </h3>
                                    
                                    <div class="my-6">
                                        
                                        <label for="attraction3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tourist Attraction #3</label>
                                        <select @change="handleattraction3" name="attractions[]" id="attraction3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <option selected disabled>Choose a tourist attraction</option>
                                            @foreach($attractions as $attraction)
                                            <option value="{{ $attraction->id }}" latitude="{{ $attraction->latitude }}" longitude="{{ $attraction->longitude }}">{{ $attraction->title }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>

                                    <h3 class="my-3 text-sm font-bold text-gray-900 dark:text-white" x-show="showDistance4">Total Distance Travel from #3 to #4 
                                        <span class="bg-yellow-100 ml-3 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300" x-text="distance(latitude3, longitude3, latitude4, longitude4) + ' KM'"></span>
                                    </h3>
                                    
                                    <div class="my-6">
                                        
                                        <label for="attraction4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tourist Attraction #4</label>
                                        <select @change="handleattraction4" name="attractions[]" id="attraction4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <option selected disabled>Choose a tourist attraction</option>
                                            @foreach($attractions as $attraction)
                                            <option value="{{ $attraction->id }}" latitude="{{ $attraction->latitude }}" longitude="{{ $attraction->longitude }}">{{ $attraction->title }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>

                                    <h3 class="my-3 text-sm font-bold text-gray-900 dark:text-white" x-show="showDistance5">Total Distance Travel from #4 to #5 
                                        <span class="bg-yellow-100 ml-3 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300" x-text="distance(latitude4, longitude4, latitude5, longitude5) + ' KM'"></span>
                                    </h3>
                                    
                                    <div class="my-6">
                                        <label for="attraction5" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tourist Attraction #5</label>
                                        <select @change="handleattraction5" name="attractions[]" id="attraction5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <option selected disabled>Choose a tourist attraction</option>
                                            @foreach($attractions as $attraction)
                                            <option value="{{ $attraction->id }}" latitude="{{ $attraction->latitude }}" longitude="{{ $attraction->longitude }}">{{ $attraction->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <h3 class="my-3 text-sm font-bold text-gray-900 dark:text-white" x-show="showDistance6">Total Distance Travel from #5 to #6 
                                        <span class="bg-yellow-100 ml-3 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300" x-text="distance(latitude5, longitude5, latitude6, longitude6) + ' KM'"></span>
                                    </h3>
                                    
                                    <div class="my-6">
                                        <label for="attraction6" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tourist Attraction #6</label>
                                        <select @change="handleattraction6" name="attractions[]" id="attraction6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <option selected disabled>Choose a tourist attraction</option>
                                            @foreach($attractions as $attraction)
                                            <option value="{{ $attraction->id }}" latitude="{{ $attraction->latitude }}" longitude="{{ $attraction->longitude }}">{{ $attraction->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <h3 class="my-3 text-sm font-bold text-gray-900 dark:text-white" x-show="showDistance7">Total Distance Travel from #6 to #7 
                                        <span class="bg-yellow-100 ml-3 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300" x-text="distance(latitude6, longitude6, latitude7, longitude7) + ' KM'"></span>
                                    </h3>
                                    
                                    <div class="my-6">
                                        <label for="attraction7" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tourist Attraction #7</label>
                                        <select @change="handleattraction7" name="attractions[]" id="attraction7" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <option selected disabled>Choose a tourist attraction</option>
                                            @foreach($attractions as $attraction)
                                            <option value="{{ $attraction->id }}" latitude="{{ $attraction->latitude }}" longitude="{{ $attraction->longitude }}">{{ $attraction->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <h3 class="my-3 text-sm font-bold text-gray-900 dark:text-white" x-show="showDistance8">Total Distance Travel from #7 to #8 
                                        <span class="bg-yellow-100 ml-3 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300" x-text="distance(latitude7, longitude7, latitude8, longitude8) + ' KM'"></span>
                                    </h3>
                                    
                                    <div class="my-6">
                                        <label for="attraction8" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tourist Attraction #8</label>
                                        <select @change="handleattraction8" name="attractions[]" id="attraction8" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        >
                                            <option selected disabled>Choose a tourist attraction</option>
                                            @foreach($attractions as $attraction)
                                            <option value="{{ $attraction->id }}" latitude="{{ $attraction->latitude }}" longitude="{{ $attraction->longitude }}">{{ $attraction->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-500 to-pink-500 group-hover:from-purple-500 group-hover:to-pink-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800">
                                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                            Save
                                        </span>
                                      </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function locationHandler(){
                return {
                    latitude1: null,
                    longitude1: null,
                    latitude2: null,
                    longitude2: null,
                    latitude3: null,
                    longitude3: null,
                    latitude4: null,
                    longitude4: null,
                    latitude5: null,
                    longitude5: null,
                    latitude6: null,
                    longitude6: null,
                    latitude7: null,
                    longitude7: null,
                    latitude8: null,
                    longitude8: null,
                    showDistance2: false,
                    showDistance3: false,
                    showDistance4: false,
                    showDistance5: false,
                    showDistance6: false,
                    showDistance7: false,
                    showDistance8: false,
                    handleAttraction1() {
                        this.latitude1 = document.querySelector('#attraction1 option:checked').getAttribute('latitude');
                        this.longitude1 = document.querySelector('#attraction1 option:checked').getAttribute('longitude');
                    },
                    handleAttraction2() {
                        this.latitude2 = document.querySelector('#attraction2 option:checked').getAttribute('latitude');
                        this.longitude2 = document.querySelector('#attraction2 option:checked').getAttribute('longitude');
                        if(this.latitude1 !== null && this.longitude1 !== null){
                            this.showDistance2 = true;
                        }
                    },
                    handleattraction3() {
                        this.latitude3 = document.querySelector('#attraction3 option:checked').getAttribute('latitude');
                        this.longitude3 = document.querySelector('#attraction3 option:checked').getAttribute('longitude');
                        if(this.latitude2 !== null && this.longitude2 !== null){
                            this.showDistance3 = true;
                        }
                    },
                    handleattraction4() {
                        this.latitude4 = document.querySelector('#attraction4 option:checked').getAttribute('latitude');
                        this.longitude4 = document.querySelector('#attraction4 option:checked').getAttribute('longitude');
                        if(this.latitude3 !== null && this.longitude3 !== null){
                            this.showDistance4 = true;
                        }
                    },
                    handleattraction5() {
                        this.latitude5 = document.querySelector('#attraction5 option:checked').getAttribute('latitude');
                        this.longitude5 = document.querySelector('#attraction5 option:checked').getAttribute('longitude');
                        if(this.latitude4 !== null && this.longitude4 !== null){
                            this.showDistance5 = true;
                        }
                    },
                    handleattraction6() {
                        this.latitude6 = document.querySelector('#attraction6 option:checked').getAttribute('latitude');
                        this.longitude6 = document.querySelector('#attraction6 option:checked').getAttribute('longitude');
                        if(this.latitude5 !== null && this.longitude5 !== null){
                            this.showDistance6 = true;
                        }
                    },
                    handleattraction7() {
                        this.latitude7 = document.querySelector('#attraction7 option:checked').getAttribute('latitude');
                        this.longitude7 = document.querySelector('#attraction7 option:checked').getAttribute('longitude');
                        if(this.latitude6 !== null && this.longitude6 !== null){
                            this.showDistance7 = true;
                        }
                    },
                    handleattraction8() {
                        this.latitude8 = document.querySelector('#attraction8 option:checked').getAttribute('latitude');
                        this.longitude8 = document.querySelector('#attraction8 option:checked').getAttribute('longitude');
                        if(this.latitude7 !== null && this.longitude7 !== null){
                            this.showDistance8 = true;
                        }
                    },
                    distance(lat1, lon1, lat2, lon2) {
                        lat1 = parseFloat(lat1);
                        lon1 = parseFloat(lon1);
                        lat2 = parseFloat(lat2);
                        lon2 = parseFloat(lon2);
                        if ((lat1 == lat2) && (lon1 == lon2)) {
                            return 0;
                        }
                        else {
                            var radlat1 = Math.PI * lat1/180;
                            var radlat2 = Math.PI * lat2/180;
                            var theta = lon1-lon2;
                            var radtheta = Math.PI * theta/180;
                            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                            if (dist > 1) {
                                dist = 1;
                            }
                            dist = Math.acos(dist);
                            dist = dist * 180/Math.PI;
                            dist = dist * 60 * 1.1515;
                            dist = dist * 1.609344; 
                            return parseFloat(dist).toFixed(1);
                        }
                    }
                }
            }
        </script>
    @endpush
</x-app-layout>
