<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Agency Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your agency's information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('agency.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="agency" :value="__('Agency Name')" />
            <x-text-input id="agency" name="agency" type="text" class="mt-1 block w-full" :value="old('agency', $user?->agency?->name)" required autofocus autocomplete="agency" />
            <x-input-error class="mt-2" :messages="$errors->get('agency')" />
        </div>

        <div>
            <x-input-label for="description" :value="__('Certificate of Business')" />
            <iframe src="{{ asset('/storage/'. $user?->agency?->certificate) }}" frameborder="0" width="100%" class="w-full h-60"></iframe>
        </div>

        <!-- Certificate of Business -->
        <div class="mt-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Change Business Certificate</label>
            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" name="certificate">
            
            <x-input-error :messages="$errors->get('certificate')" class="mt-2" />
        </div>


        <div>
            <x-input-label for="description" :value="__('Agency Description')" />
            <x-textarea-input id="description" class="block mt-1 w-full" name="description" :value="old('description', $user?->agency?->description)" required autofocus autocomplete="description" />
            <x-input-error class="mt-2" :messages="$errors->get('description')"  />
        </div>
       

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

        </div>
    </form>
</section>
