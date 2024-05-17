<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 fixed z-50 top-0 right-0 left-0">
    <!-- Primary Navigation Menu -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                {{-- <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('logo/freecodecamp.svg') }}" />
                    </a>
                </div>

                <!-- Navigation Links --> --}}
                <div class="flex items-center  gap-x-3">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('post.index') }}">
                            <img src="{{ asset('/logo/freecodecamp.svg') }}" alt="logo" class="h-9 w-9 object-contain shrink-0"  />
                        </a>
                    </div>
                    <div class="border h-7 border-neutral-300"></div>
                    <h2 class="font-semibold text-lg text-gray-800">FreeCodegram</h2>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 sm:gap-x-1 ">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->username }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.show', auth()->user())">
                                {{ __('Profile') }}
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
                @endauth

                @if (!Auth::user())
                <a href="{{ route('login') }}" class="bg-sky-500 rounded-md font-semibold text-white hover:bg-sky-600 transition px-2 py-[2px] text-sm text-center">Log In</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class=" rounded-md font-semibold text-sky-500 hover:bg-gray-100 transition px-2 py-[2px] text-sm text-center">Sign up</a>
                    @endif
                @endif
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 px-2  space-y-1 flex flex-col  ">
            {{-- <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link> --}}
            @if (!Auth::user())
            <a href="{{ route('login') }}" class="bg-sky-500 rounded-md font-semibold text-white hover:bg-sky-600 transition p-2  text-sm text-center">Log In</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class=" rounded-md font-semibold text-sky-500 hover:bg-gray-100 transition p-2 text-sm text-center">Sign up</a>
                @endif
            @endif
        </div>

        <!-- Responsive Settings Options -->
        @auth
           <div class="pt-4 pb-1 border-t border-gray-200">
            {{-- <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div> --}}

            <div class="pt-2 pb-3 px-2 space-y-1">
                {{-- <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link> --}}

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                    class="w-full bg-white rounded-md font-semibold text-gray-900 hover:bg-neutral-100 transition p-2  text-sm text-center"
                    href={{"route('logout')"}}
                    onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div> 
        @endauth
        
    </div>
</nav>
