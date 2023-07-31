<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @if($user->type == 'agency')
                        @include('profile.partials.view-agency-information-form')
                    @else   
                        @include('profile.partials.view-profile-information-form')
                    @endif
                </div>
            </div>

            @if(auth()->user()->id === $user->id)
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.view-delete-user-form')
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
