<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo-name class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        
                    </a>
                    <span class="text-gray-900 text-lg  dark:text-white">E-TOUR</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Browse Travel Packages') }}
                    </x-nav-link>
                    <x-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')">
                        {{ __('Calendar') }}
                    </x-nav-link>
                    @endauth
                    @if(auth()->user()?->type == 'traveler')
                    <x-nav-link :href="route('package.compare')" :active="request()->routeIs('package.compare')">
                        {{ __('Compare Travel Packages') }}
                    </x-nav-link>
                    <x-nav-link :href="route('travel.plan')" :active="request()->routeIs('travel.plan')">
                        {{ __('Travel Plan and Bookings') }}
                    </x-nav-link>
                    <x-nav-link :href="route('itineraries')" :active="request()->routeIs('itineraries')">
                        {{ __('Create your own Itinerary') }}
                    </x-nav-link>
                    @endif
                    @if( auth()->user()?->type == 'agency')
                        <x-nav-link :href="route('package.index')" :active="request()->routeIs('package.index')">
                            {{ __('Travel Packages') }}
                        </x-nav-link>
                        <x-nav-link :href="route('package.compare')" :active="request()->routeIs('package.compare')">
                            {{ __('Compare Travel Packages') }}
                        </x-nav-link>
                        <x-nav-link :href="route('bookings')" :active="request()->routeIs('bookings')">
                            {{ __('Bookings') }}
                        </x-nav-link>
                    @endif
                    @if(auth()->user()?->type == 'admin')
                        <x-nav-link :href="route('package.all')" :active="request()->routeIs('package.all')">
                            {{ __('Check Travel Packages') }}
                        </x-nav-link>
                        <x-nav-link :href="route('users')" :active="request()->routeIs('users')">
                            {{ __('Users') }}
                        </x-nav-link>
                        <x-nav-link :href="route('subscription.plans')" :active="request()->routeIs('subscription.plans')">
                            {{ __('Subscription Plans') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.attractions')" :active="request()->routeIs('admin.attractions')">
                            {{ __('Attractions') }}
                        </x-nav-link>
                    @endif
                </div>
               
            </div>

            <!-- Settings Dropdown -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->type == 'agency' ? Auth::user()->agency->name : Auth::user()->name }}</div>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                            <div>
                                <span class="bg-pink-100 text-pink-800 text-xs font-medium ml-2 mr-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">{{ auth()->user()->unreadNotifications->count() }}</span>
                            </div>
                            @endif
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        
                    </x-slot>
                    
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('messaging')">
                            {{ __('Messaging') }}

                            @if(\App\Models\ChMessage::where('seen', false)->count() > 0)
                                <span class="bg-pink-100 text-pink-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">{{ \App\Models\ChMessage::where('seen', false)->count() }}</span>
                            @endif
                            
                        
                        </x-dropdown-link>
                        @if(auth()->user()?->type == 'agency' && auth()->user()?->stripe_id != null)
                        <x-dropdown-link :href="route('subscription.details')">
                            {{ __('Billing') }}
                        </x-dropdown-link>
                        @endif
                        <x-dropdown-link :href="route('notifications')">
                            {{ __('Notifications') }} 
                            @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="bg-pink-100 text-pink-800 text-xs font-medium ml-2 mr-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">{{ auth()->user()->unreadNotifications->count() }}</span>
                            @endif
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                   
                </x-dropdown>
            </div>
            @endauth
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                @if(auth()->user()?->unreadNotifications->count() > 0)
                    <div>
                        <span class="bg-pink-100 text-pink-800 text-xs font-medium ml-2 mr-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Browse Travel Packages') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')">
                {{ __('Calendar') }}
            </x-responsive-nav-link>
            @endauth
            @if(auth()->user()?->type == 'traveler')
            <x-responsive-nav-link :href="route('package.compare')" :active="request()->routeIs('package.compare')">
                {{ __('Compare Travel Packages') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('travel.plan')" :active="request()->routeIs('travel.plan')">
                {{ __('Travel Plan and Bookings') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('itineraries')" :active="request()->routeIs('itineraries')">
                {{ __('Create your own Itinerary') }}
            </x-responsive-nav-link>
            @endif
            @if(auth()->user()?->type == 'agency')
                <x-responsive-nav-link :href="route('package.index')" :active="request()->routeIs('package.index')">
                    {{ __('Travel Packages') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('package.compare')" :active="request()->routeIs('package.compare')">
                    {{ __('Compare Travel Packages') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('bookings')" :active="request()->routeIs('bookings')">
                    {{ __('Bookings') }}
                </x-responsive-nav-link>
            @endif
            @if(auth()->user()?->type == 'admin')
                <x-responsive-nav-link :href="route('package.all')" :active="request()->routeIs('package.all')">
                    {{ __('Check Travel Packages') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('package.all')" :active="request()->routeIs('package.all')">
                    {{ __('Users') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.attractions')" :active="request()->routeIs('admin.attractions')">
                    {{ __('Attractions') }}
                </x-responsive-nav-link>
            @endif
            
            
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('messaging')">
                    {{ __('Messaging') }}
                    @if(\App\Models\ChMessage::where('seen', false)->count() > 0)
                    <span class="bg-pink-100 text-pink-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">{{ \App\Models\ChMessage::where('seen', false)->count() }}</span>
                    @endif
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('notifications')">
                    {{ __('Notifications') }}
                    @if(auth()->user()?->unreadNotifications?->count() > 0)
                    <span class="bg-pink-100 text-pink-800 text-xs font-medium ml-2 mr-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">{{ auth()->user()?->unreadNotifications->count() }}</span>
                    @endif
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
