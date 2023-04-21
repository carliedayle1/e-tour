

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('You haven\'t got any subscription yet to create a travel package. Subscribe to our plans below.') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div>
                    <a href="{{ route('subscriptions') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Back</a>
                </div>

            </div> --}}

            <div class="my-4">
                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                        <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Travel Agency Subscription</h2>
                            {{-- <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p> --}}
                        </div>
                        <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                            <!-- Pricing Card -->
                            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                                <h3 class="mb-4 text-2xl font-semibold">{{ $basic->name }}</h3>
                                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Best option for starting travel agencies.</p>
                                <div class="flex justify-center items-baseline my-8">
                                    <span class="mr-2 text-5xl font-extrabold">₱{{ $basic->price/100 }}</span>
                                    <span class="text-gray-500 dark:text-gray-400">/month</span>
                                </div>
                                <!-- List -->
                                <ul role="list" class="mb-8 space-y-4 text-left">
                                    <li class="flex items-center space-x-3">
                                        <!-- Icon -->
                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        <span>Create up to 5 travel packages</span>
                                    </li>

                                </ul>
                                <a href="/subscriptions/{{ strtolower($basic->name) }}" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">Get started</a>
                            </div>
                            <!-- Pricing Card -->
                            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                                <h3 class="mb-4 text-2xl font-semibold">{{ $plus->name }}</h3>
                                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Best for travel agencies that has a wide array of travel packages</p>
                                <div class="flex justify-center items-baseline my-8">
                                    <span class="mr-2 text-5xl font-extrabold">₱{{ $plus->price/100 }}</span>
                                    <span class="text-gray-500 dark:text-gray-400" dark:text-gray-400>/month</span>
                                </div>
                                <!-- List -->
                                <ul role="list" class="mb-8 space-y-4 text-left">
                                    <li class="flex items-center space-x-3">
                                        <!-- Icon -->
                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        <span>Create up to 10 travel packages</span>
                                    </li>

                                    <li class="flex items-center space-x-3">
                                        <!-- Icon -->
                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        <span>Featured Travel Packages</span>
                                    </li>
                                </ul>
                                <a href="/subscriptions/{{ strtolower($plus->name) }}" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">Get started</a>
                            </div>
                            <!-- Pricing Card -->
                            <div class="flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                                <h3 class="mb-4 text-2xl font-semibold">{{ $premium->name }}</h3>
                                <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Best for large travel agencies that caters to plenty of travelers.</p>
                                <div class="flex justify-center items-baseline my-8">
                                    <span class="mr-2 text-5xl font-extrabold">₱{{ $premium->price/100 }}</span>
                                    <span class="text-gray-500 dark:text-gray-400">/month</span>
                                </div>
                                <!-- List -->
                                <ul role="list" class="mb-8 space-y-4 text-left">
                                    <li class="flex items-center space-x-3">
                                        <!-- Icon -->
                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        <span>Create up to 30 travel packages</span>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <!-- Icon -->
                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        <span>Featured Travel Packages</span>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <!-- Icon -->
                                        <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                        <span>Special blog post</span>
                                    </li>
                                    
                                </ul>
                                <a href="/subscriptions/{{ strtolower($premium->name) }}" class="text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white  dark:focus:ring-primary-900">Get started</a>
                            </div>
                        </div>
                    </div>
                  </section>
            </div>

        </div>
    </div>
</x-app-layout>


