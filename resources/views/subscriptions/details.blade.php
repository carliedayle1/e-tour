

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subscription Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="my-6">
                    {{-- <a href="{{ route('subscription.create') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create Subscription Plan</a> --}}
                    <p class="mt-1 text-md text-gray-900 dark:text-gray-100">
                        Your subscriptions are auto renewed by the system. If you wish to disable this, you can cancel the subscription and can still do the transactions until your billing period ends.
                    </p>
                </div>

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

                @if($subscriptions->count() > 0)

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
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Subscription started at
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Subscription ended at
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $sub)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $sub->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $sub->plan->billing_period }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $sub->stripe_status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        ₱{{ ($sub->plan->price/100) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $sub->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $sub->ends_at != null ? $sub->ends_at->format('M d, Y'): ''  }}
                                    </td>
                                    <td class="px-6 py-4">
                                       @if($sub->ends_at == null)
                                        <button type="submit"  x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'cancel-{{ $sub->id }}')" class="font-medium text-red-600 dark:text-red-500 hover:underline">Cancel Subscription</button>
                                       
                                        <x-modal name="cancel-{{ $sub->id }}" :show="$errors->isNotEmpty()" focusable>
                                            <form method="post" action="/subscription/cancel/{{ strtolower($sub->name) }}" class="p-6">
                                                @csrf
                                    
                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Are you sure you want to cancel your subscription?') }}
                                                </h2>

                                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                                    Your current subscription plan is <span class="text-md">{{ strtoupper($sub->name) }}.</span>
                                                </p>
                                    
                                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                                    {{ __('Once the subscription is cancelled, you can still perform all the perks until the end of your billing period.') }}
                                                </p>
                                    
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Back') }}
                                                    </x-secondary-button>
                                    
                                                    <x-danger-button class="ml-3">
                                                        {{ __('Cancel Subscription') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                        @else
                                        <button type="submit"  x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'resume-{{ $sub->id }}')" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Resume Subscription</button>
                                       
                                        <x-modal name="resume-{{ $sub->id }}" :show="$errors->isNotEmpty()" focusable>
                                            <form method="post" action="/subscription/resume/{{ strtolower($sub->name) }}" class="p-6">
                                                @csrf
                                    
                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Are you sure you want to resume this subscription?') }}
                                                </h2>

                                                <p class="mt-1 text-lg text-gray-900 dark:text-gray-100">
                                                    This current subscription plan is <span class="text-md">{{ strtoupper($sub->name) }}.</span>
                                                </p>
                                    
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">
                                                        {{ __('Back') }}
                                                    </x-secondary-button>
                                    
                                                    <x-danger-button class="ml-3">
                                                        {{ __('Resume Subscription') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else 
                <div class="block max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                    <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">You are not subscribed in any plans at the moment..</h5>
                </div>
                @endif

            </div>


        </div>
    </div>

</x-app-layout>


