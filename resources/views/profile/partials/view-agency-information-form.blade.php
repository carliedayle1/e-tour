<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Agency Information') }}
        </h2>

        {{-- <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your agency's information.") }}
        </p> --}}
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('agency.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Owner Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" readonly  />
        </div>

        <div>
            <x-input-label for="agency" :value="__('Agency Name')" />
            <x-text-input id="agency" name="agency" type="text" class="mt-1 block w-full" :value="old('agency', $user?->agency?->name)" required autofocus autocomplete="agency" readonly />
        </div>

        <div>
            <x-input-label for="description" :value="__('About Us')" />
            <x-textarea-input id="description" class="block mt-1 w-full" name="description" :value="old('description', $user?->agency?->description)" required autofocus autocomplete="description" readonly />
        </div>
       

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" readonly />

        </div>

        <div class="mt-4">

            @if(!$user->hasVerifiedEmail())
             <span class="bg-yellow-100 text-yellow-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Unverified</span>
            @else 
            <span class="bg-green-100 text-green-800 text-lg font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Verified</span>
            @endif
         </div>
    </form>
</section>
