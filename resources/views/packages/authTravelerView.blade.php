<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Travel Package') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
            <div>
                <a href="javascript:history.back()" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
            </div>
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
                                
                                @if(auth()->user()->type == 'traveler')
                                <button type="button"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'book-travel-package')"
                                class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    Book Now
                                </button>  
                                @endif 
                               
               
                                <x-modal name="book-travel-package" :show="$errors->isNotEmpty()" focusable>
                                    <form method="post" action="{{ route('package.book') }}" class="p-6">
                                        @csrf
                            
                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ __('Complete your booking details') }}
                                        </h2>
                                        
                                        <hr>
                                        <div class="my-6">
                                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a date</label>
                                            <select name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            @foreach($timeslots as $timeslot)
                                              <option value="{{ $timeslot->id }}">{{ $timeslot->date }}</option>
                                            @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                        </div>
                                        <div class="my-6">
                                            <label for="packageType" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a package type</label>
                                            <select name="packageType" id="packageType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            @foreach($travel_package->packageTypes as $packageType)
                                              <option value="{{ $packageType->id }}">{{ $packageType->title }}</option>
                                            @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('packageType')" class="mt-2" />
                                        </div>
                                        <div>
                                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message to the travel agency.</label>
                                            <textarea name="message" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                                        </div>
                            
                                        <div class="mt-6 flex justify-end">
                                            <x-primary-button>
                                                {{ __('Save') }}
                                            </x-primary-button>
                                            <x-secondary-button class="ml-3" x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-secondary-button>
                            
                                        </div>
                                    </form>
                                </x-modal>
                            </div>

                            @if($travel_package->feedbacks->count() > 0)
                            <div class="my-8">
                                <section class="bg-white dark:bg-gray-900 py-8 lg:py-16">
                                    <div class="max-w-2xl mx-auto px-4">
                                        <div class="flex space-x-4 content-center">

                                            <div class="flex justify-between items-center">
                                              <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Feedback</h2>
                                            </div>
                                     
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= intval($travel_package->feedbacks->avg('stars')))
                                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                    @else 
                                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                    @endif
                                                @endfor
                                                
                                                
                                                <p class="ml-2 text-sm font-medium text-gray-500 dark:text-gray-400">{{ $travel_package->feedbacks->avg('stars') }} out of 5</p>
                                                <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full dark:bg-gray-400"></span>
                                                <a href="#" class="text-sm font-medium text-gray-900 underline hover:no-underline dark:text-white">{{ $travel_package->feedbacks->count() }} reviews</a>
                                            </div>

                                        </div>
                                        @if($booking?->user?->id == auth()->user()->id && $booking?->reviewed == false)
                                        <form class="mb-6" action="/bookings/feedback" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $travel_package->id }}" name="travel_package_id" >
                                            <input type="hidden" value="{{ $booking->id }}" name="booking_id" >
                                            <div class="my-6">
    
                                                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Please select a rating</label>
                                                <select id="countries" name="stars" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                  <option value="1">1 Star</option>
                                                  <option value="2">2 Stars</option>
                                                  <option value="3">3 Stars</option>
                                                  <option value="4">4 Stars</option>
                                                  <option value="5">5 Stars</option>
                                                </select>
                                                
    
                                            </div>
                                            
                                              <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                                  <label for="comment" class="sr-only">Your comment</label>
                                                  <textarea id="comment" rows="6" name="message"
                                                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                                      placeholder="Write a comment..." required></textarea>
                                              </div>
                                              <button type="submit"
                                                  class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                                  Post feedback
                                              </button>
                                        </form>
                                        @endif
                                    @foreach($travel_package->feedbacks as $feedback)
                                        <article class="p-6 mb-6 text-base bg-white rounded-lg dark:bg-gray-900">
                                            <footer class="flex justify-between items-center mb-2">
                                                <div class="flex items-center">
                                                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">{{ $feedback->user->name }}</p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $feedback->created_at->diffForHumans() }}</p>
                                                </div>
                                                @if($feedback->user->id == auth()->user()->id)
                                                <button id="dropdownComment1Button" data-dropdown-toggle="dropdownComment1"
                                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                                    type="button">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                        </path>
                                                    </svg>
                                                    <span class="sr-only">Comment settings</span>
                                                </button>
                                               
                                                <!-- Dropdown menu -->
                                                <div id="dropdownComment1"
                                                    class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                        aria-labelledby="dropdownMenuIconHorizontalButton">
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                        </li>
                                                       
                                                    </ul>
                                                </div>
                                                @endif
                                            </footer>
                                            <p class="text-gray-500 dark:text-gray-400">{{ $feedback->message }}</p>
                                            
                                        </article>
                                    @endforeach
                                    </div>
                                  </section>
                            </div>                          
                            @else 
                            <div class="my-8">
                                <section class="bg-white dark:bg-gray-900 py-8 lg:py-16">
                                    <div class="max-w-2xl mx-auto px-4">
                                        <div class="flex flex-col space-x-4 space-y-4 content-center">

                                            <div class="flex justify-between items-center">
                                              <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Feedback</h2>
                                            </div>
                                            @if($booking?->user?->id == auth()->user()->id && $booking?->reviewed == false)
                                            <form class="mb-6" action="/bookings/feedback" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $travel_package->id }}" name="travel_package_id" >
                                                <input type="hidden" value="{{ $booking->id }}" name="booking_id" >
                                                <div class="my-6">
        
                                                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Please select a rating</label>
                                                    <select id="countries" name="stars" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                      <option value="1">1 Star</option>
                                                      <option value="2">2 Stars</option>
                                                      <option value="3">3 Stars</option>
                                                      <option value="4">4 Stars</option>
                                                      <option value="5">5 Stars</option>
                                                    </select>
                                                    
        
                                                </div>
                                                
                                                  <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                                      <label for="comment" class="sr-only">Your comment</label>
                                                      <textarea id="comment" rows="6" name="message"
                                                          class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                                          placeholder="Write a comment..." required></textarea>
                                                  </div>
                                                  <button type="submit"
                                                      class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                                      Post feedback
                                                  </button>
                                            </form>
                                            @endif
                                            
                                            <div class="block max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                                <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">No posted feedbacks at the moment..</h5>
                                                
                                            </div>
                                              
                                          
                                        </div>
                                    
                                    </div>
                                  </section>
                            </div>
                            
                            @endif
        

                        </div>
                    </section>

           
        </div>
    </div>

</x-app-layout>
