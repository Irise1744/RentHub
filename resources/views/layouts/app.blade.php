<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js if not already included in app.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <style>
            /* Hide scrollbar for Chrome, Safari and Opera */
            .sidebar-scroll::-webkit-scrollbar {
                display: none;
            }
            
            /* Hide scrollbar for IE, Edge and Firefox */
            .sidebar-scroll {
                -ms-overflow-style: none;  /* IE and Edge */
                scrollbar-width: none;  /* Firefox */
            }
            
            /* Hide Alpine elements before initialization */
            [x-cloak] { 
                display: none !important; 
            }
            
            /* Smooth transitions */
            .transition-all {
                transition-property: all;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        @php $isAdmin = Auth::user()?->is_admin; @endphp

        @if($isAdmin)
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside class="sticky top-0 h-screen z-50">
                @include('layouts.navigation') {{-- Admin/sidebar navigation --}}
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-h-screen">
                <!-- Optional Top Bar for Mobile -->
                <header class="sticky top-0 z-40 bg-white border-b border-gray-200 lg:hidden">
                    <div class="px-4 py-3">
                        <div class="flex items-center justify-between">
                            <!-- Mobile Menu Toggle -->
                            <button @click="mobileMenuOpen = !mobileMenuOpen" 
                                    x-data="{ mobileMenuOpen: false }"
                                    class="p-2 rounded-md text-gray-500 hover:text-gray-600 hover:bg-gray-100 focus:outline-none">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" 
                                          class="inline-flex"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" 
                                          class="hidden"
                                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            
                            @php
                                $isAdmin = Auth::user()?->is_admin;
                                $primaryRoute = $isAdmin ? route('admin.dashboard') : route('home');
                                $primaryActive = $isAdmin ? request()->routeIs('admin.dashboard') : request()->routeIs('home');
                                $primaryLabel = $isAdmin ? __('Dashboard') : __('Home');
                            @endphp

                            <!-- Mobile Logo -->
                            <a href="{{ $primaryRoute }}" class="flex items-center">
                                @if (file_exists(public_path('logo.png')) || file_exists(public_path('logo.svg')))
                                    <x-application-logo class="block h-8 w-auto fill-current text-gray-800" />
                                @else
                                    <div class="h-8 w-8 bg-gray-800 rounded flex items-center justify-center text-white font-bold">
                                        {{ substr(config('app.name', 'L'), 0, 1) }}
                                    </div>
                                @endif
                                <span class="ml-2 text-lg font-semibold text-gray-800">{{ config('app.name', 'Laravel') }}</span>
                            </a>
                            
                            <!-- Mobile User Menu -->
                            <div class="relative">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                            <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-semibold">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </div>
                                        </button>
                                    </x-slot>
                                    
                                    <x-slot name="content">
                                        <div class="px-4 py-3 border-b border-gray-100">
                                            <div class="font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                                        </div>
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')" 
                                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Mobile Navigation Menu -->
                    <div x-show="mobileMenuOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2"
                         class="bg-white border-t border-gray-200 px-4 py-3 space-y-1 lg:hidden"
                         x-cloak>
                        <a href="{{ $primaryRoute }}" 
                           class="block px-3 py-2 rounded-lg {{ $primaryActive ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            {{ $primaryLabel }}
                        </a>

                        @unless($isAdmin)
                            <a href="{{ route('products.index') }}" 
                               class="block px-3 py-2 rounded-lg {{ request()->routeIs('products.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                {{ __('Browse') }}
                            </a>

                            <a href="{{ route('users.my-listings') }}" 
                               class="block px-3 py-2 rounded-lg {{ request()->routeIs('users.my-listings') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                {{ __('My List') }}
                            </a>
                        @endunless

                        @if($isAdmin)
                            <a href="{{ route('users.index') }}" 
                               class="block px-3 py-2 rounded-lg {{ request()->routeIs('users.*') ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                {{ __('Users') }}
                            </a>
                        @endif
                    </div>
                </header>

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white shadow">
                        <div class="max-w-full mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1 p-4 sm:p-6 lg:p-8">
                    {{ $slot }}
                </main>

                <!-- Optional Footer -->
                @isset($footer)
                    <footer class="bg-white border-t border-gray-200 py-4 px-6 mt-auto">
                        {{ $footer }}
                    </footer>
                @else
                    <footer class="bg-white border-t border-gray-200 py-4 px-6 mt-auto">
                        <div class="text-center text-gray-500 text-sm">
                            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                        </div>
                    </footer>
                @endisset
            </div>
        </div>
        @else
        <div class="min-h-screen bg-gray-50 flex flex-col">
            <x-user-nav />

            @isset($header)
                <header class="bg-white border-b border-gray-200 shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1 py-6 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>

            @isset($footer)
                <footer class="bg-white border-t border-gray-200 py-4 px-6 mt-auto">
                    {{ $footer }}
                </footer>
            @else
                <footer class="bg-white border-t border-gray-200 py-4 px-6 mt-auto">
                    <div class="text-center text-gray-500 text-sm">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
                    </div>
                </footer>
            @endisset
        </div>
        @endif

        <script>
            // Store sidebar state in localStorage
            document.addEventListener('alpine:init', () => {
                // Initialize with saved state or default to true (expanded)
                const savedState = localStorage.getItem('sidebarOpen');
                const initialState = savedState !== null ? savedState === 'true' : true;
                
                Alpine.store('sidebar', {
                    open: initialState,
                    
                    toggle() {
                        this.open = !this.open;
                        localStorage.setItem('sidebarOpen', this.open);
                    }
                });
            });
        </script>
    </body>
</html>