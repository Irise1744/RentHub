<nav x-data="{ open: false }"
     x-bind:class="{'w-64': $store.sidebar.open, 'w-20': !$store.sidebar.open}"
     class="bg-white border-r border-gray-200 h-screen flex flex-col flex-shrink-0 transition-all duration-300 ease-in-out hidden lg:flex"
     :style="{ width: $store.sidebar.open ? '16rem' : '5rem' }">

    @php
        $isAdmin = Auth::user()?->is_admin;
        $primaryRoute = $isAdmin ? route('admin.dashboard') : route('home');
        $primaryActive = $isAdmin ? request()->routeIs('admin.dashboard') : request()->routeIs('home');
        $primaryLabel = $isAdmin ? 'Dashboard' : 'Home';
    @endphp

    <!-- Logo Section -->
    <div class="p-4 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <a href="{{ $primaryRoute }}" class="flex items-center space-x-3 overflow-hidden">
                <x-application-logo class="block h-8 w-auto fill-current text-gray-800 flex-shrink-0" />
                <span x-show="$store.sidebar.open"
                      x-transition.opacity.duration.300ms
                      class="text-xl font-semibold text-gray-800 whitespace-nowrap">
                    {{ config('app.name', 'Laravel') }}
                </span>
            </a>

            <button @click="$store.sidebar.toggle()"
                    class="p-1.5 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 overflow-y-auto py-4 sidebar-scroll">
        <div class="px-3 space-y-1">

            <!-- Dashboard -->
            <a href="{{ $primaryRoute }}"
               class="group flex items-center px-3 py-2.5 rounded-lg transition-colors
               {{ $primaryActive ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2 7-7 7 7"/>
                </svg>
                <span x-show="$store.sidebar.open" class="ml-3">{{ $primaryLabel }}</span>
            </a>

            @unless($isAdmin)
                <!-- Browse products (users) -->
                <a href="{{ route('products.index') }}"
                   class="group flex items-center px-3 py-2.5 rounded-lg transition-colors
                   {{ request()->routeIs('products.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h3l1 3h8l1-3h3a1 1 0 011 1v2H3V4z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 16h14l-1.5 5h-11zM7 16V9m10 7V9" />
                    </svg>
                    <span x-show="$store.sidebar.open" class="ml-3">Browse</span>
                </a>

                <!-- My List (users) -->
                <a href="{{ route('users.my-listings') }}"
                   class="group flex items-center px-3 py-2.5 rounded-lg transition-colors
                   {{ request()->routeIs('users.my-listings') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                    <span x-show="$store.sidebar.open" class="ml-3">My List</span>
                </a>
            @endunless

            @if($isAdmin)
                <!-- Users (admin only) -->
                <a href="{{ route('users.index') }}"
                   class="group flex items-center px-3 py-2.5 rounded-lg transition-colors
                   {{ request()->routeIs('users.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4a4 4 0 100 8 4 4 0 000-8zM6 20a6 6 0 0112 0"/>
                    </svg>
                    <span x-show="$store.sidebar.open" class="ml-3">Users</span>
                </a>
            @endif

        </div>
    </div>

    <!-- User Profile -->
    <div class="border-t border-gray-200 p-4">
        <div class="flex items-center space-x-3">
            <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center font-semibold text-gray-700">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div x-show="$store.sidebar.open" class="flex-1">
                <div class="text-sm font-medium">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
            </div>
        </div>
    </div>

    <!-- 🔴 LOGOUT BUTTON -->
    <div class="border-t border-gray-200 p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="group flex items-center w-full px-3 py-2.5 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>

                <span x-show="$store.sidebar.open" class="ml-3">
                    Logout
                </span>
            </button>
        </form>
    </div>

</nav>
