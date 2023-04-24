

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subscription Plans') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                {{-- <div>
                    <a href="{{ route('subscription.create') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create Subscription Plan</a>
                </div> --}}

                {{-- <div>
                    <form action="{{ route('single.charge') }}" method="POST" id="subscribe-form">
                        <div class="mb-6">
                            <label for="card-holder" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                            <input type="number" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <div class="mb-6">
                            <label for="card-holder" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Card Holder Name</label>
                            <input type="text" id="card-holder-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        @csrf
                        <div class="form-row">
                            <label for="card-element" class=" mb-2 text-sm font-medium text-gray-900 dark:text-white">Credit or debit card</label>
                            <div id="card-element" class="form-control">
                            </div>
                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <div class="stripe-errors"></div>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                            @endforeach
                        </div>
                        @endif
                        <div class="mt-4">
                           
                            <button type="button" id="card-button" data-secret="{{ $intent->client_secret }}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</button>
                        </div>
                        
                    </form>
                </div> --}}

                @if($plans->count() > 0)

                <div class="my-4">
                    <section class="bg-white dark:bg-gray-900">
                        <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
                            <dl class="grid max-w-screen-md gap-8 mx-auto text-gray-900 sm:grid-cols-3 dark:text-white">
                                <div class="flex flex-col items-center justify-center">
                                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $subscriptions_count }}</dt>
                                    <dd class="font-light text-gray-500 dark:text-gray-400">Active Subscriptions</dd>
                                </div>
                                <div class="flex flex-col items-center justify-center">
                                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $packages_count }}</dt>
                                    <dd class="font-light text-gray-500 dark:text-gray-400">Travel Packages Created</dd>
                                </div>
                                <div class="flex flex-col items-center justify-center">
                                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold">{{ $users_count }}</dt>
                                    <dd class="font-light text-gray-500 dark:text-gray-400">Subscribed Users</dd>
                                </div>
                            </dl>
                        </div>
                      </section>
                </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Subscription Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Billing Period
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-3">
                                        Billing Interval
                                    </th> --}}
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    {{-- <th scope="col" class="px-6 py-3">
                                        Action
                                    </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plans as $plan)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $plan->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $plan->billing_period }}
                                    </td>
                                    {{-- <td class="px-6 py-4">
                                        {{ $plan->interval_count }}
                                    </td> --}}
                                    <td class="px-6 py-4">
                                        ₱{{ ($plan->price/100) }}
                                    </td>
                                    {{-- <td class="px-6 py-4">
                                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else 
                <div class="block max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">No subscriptions at the moment..</h5>
                </div>
                @endif

            </div>


        </div>
    </div>

</x-app-layout>


