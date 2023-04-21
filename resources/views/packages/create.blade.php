<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Travel Packages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col space-y-4">
                    <div>
                        <a href="{{ route('package.index') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
                    </div>
                    
                    <div>                       
                        <form action="{{ route('package.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid gap-6 mb-6">
                                 <!-- Title -->
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>
                                <!-- Description -->
                                <div>
                                    <x-input-label for="description" :value="__('Description')" />
                                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" />
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
                                <!-- Average hours/days -->
                                <div>
                                    <x-input-label for="hours_days" :value="__('Average Hours or Days')" />
                                    <x-text-input id="hours_days" class="block mt-1 w-full" type="text" name="hours_days" :value="old('hours_days')" />
                                    <x-input-error :messages="$errors->get('hours_days')" class="mt-2" />
                                </div>
                                <!-- Availability Slot -->
                                <div>
                                    <x-input-label for="slot" :value="__('Availability Slot (Slots per day)')" />
                                    <x-text-input id="slot" class="block mt-1 w-full" type="number" name="slot" :value="old('slot')" />
                                    <x-input-error :messages="$errors->get('slot')" class="mt-2" />
                                </div>
                            </div>
                                <!-- Locations -->
                            <div class="grid gap-4 mb-6" x-data="locationHandler()">                               
                                <div class="flex justify-between items-center" >
                                    <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Locations</span>
                                    <button type="button" id="add" @click="addNewLocation" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Add Location</button>
                                </div>
                                
                                <div>                                   
                                    @if($errors->has('location_name.*'))
                                    <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                        @foreach ($errors->get('location_name.*') as $messages)
                                            @foreach($messages as $message)
                                                <li>{{ $message }}</li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                    @endif
                                    @if($errors->has('location_description.*'))
                                    <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                        @foreach ($errors->get('location_description.*') as $messages)
                                            @foreach($messages as $message)
                                                <li>{{ $message }}</li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                    @endif
                                    @if($errors->has('location_image.*'))
                                    <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                        @foreach ($errors->get('location_image.*') as $messages)
                                            @foreach($messages as $message)
                                                <li>{{ $message }}</li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                               <div class="grid gap-4 lg:grid-cols-3" id="location" >

                                    <template x-for="field in fields" :key="index">
                                        <div class="space-y-3 border rounded p-5 shadow-md border-gray-500 dark:border-gray-200">
                                            <div>
                                                <x-input-label for="name" :value="__('Name')" />
                                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="location_name[]" />
                                            </div>
                                            <div>
                                                <x-input-label for="description" :value="__('Description')" />
                                                <x-textarea-input id="description" class="block mt-1 w-full" name="location_description[]" />
                                            </div>
                                            <div>                                       
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Image</label>
                                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" name="location_image[]">
                                            </div> 
                                            <div class="flex" >                                             
                                                <button type="button" @click="removeLocation" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete Location</button>
                                             
                                            </div>
                                        </div>  
                                    </template>
                                                              
                               </div>

                               <!-- Travel Package Types -->
                               
                           </div>
                                <!-- Travel Package Types -->
                           <div class="grid gap-4 mb-6" x-data="packageTypeHandler()">                               
                            <div class="flex justify-between items-center" >
                                <span class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Travel Package Types</span>
                                <button type="button" id="add" @click="addNewType" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Add Package Type</button>
                            </div>
                            
                            <div>                                   
                                @if($errors->has('packageType_title.*'))
                                <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                    @foreach ($errors->get('packageType_title.*') as $messages)
                                        @foreach($messages as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    @endforeach
                                </ul>
                                @endif
                                @if($errors->has('packageType_fee.*'))
                                <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                    @foreach ($errors->get('packageType_fee.*') as $messages)
                                        @foreach($messages as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    @endforeach
                                </ul>
                                @endif
                                @if($errors->has('packageType_persons.*'))
                                <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                    @foreach ($errors->get('packageType_persons.*') as $messages)
                                        @foreach($messages as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                           <div class="grid gap-4 lg:grid-cols-3" id="location" >

                                <template x-for="field in fields" :key="index">
                                    <div class="space-y-3 border rounded p-5 shadow-md border-gray-500 dark:border-gray-200">
                                        <div>
                                            <x-input-label for="title" :value="__('Type Title')" />
                                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="packageType_title[]" />
                                        </div>
                                        <div>
                                            <x-input-label for="fee" :value="__('Fee')" />
                                            <x-text-input id="fee" class="block mt-1 w-full" type="number" step="0.01" name="packageType_fee[]" />
                                        </div>
                                        <div>
                                            <x-input-label for="max_person" :value="__('Maximum Person/Heads')" />
                                            <x-text-input id="max_person" class="block mt-1 w-full" type="number" step="0.01" name="packageType_persons[]" />
                                        </div>


                                        <div class="flex" >                                             
                                            <button type="button" @click="removeType" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete Package Type</button>
                                         
                                        </div>
                                    </div>  
                                </template>
                                                          
                           </div>

                           
                           
                       </div>
                           

                           <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 uppercase transition ease-in-out duration-150">Create Travel Package</button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function locationHandler(){
                return {
                    fields: 1,
                    addNewLocation() {
                        ++this.fields;
                    },
                    removeLocation() {
                        --this.fields;
                    }
                }
            }
            function packageTypeHandler(){
                return {
                    fields: 1,
                    addNewType() {
                        ++this.fields;
                    },
                    removeType() {
                        --this.fields;
                    }
                }
            }
        </script>
    @endpush

</x-app-layout>
