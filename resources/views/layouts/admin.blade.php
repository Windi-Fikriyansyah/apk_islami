<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="h-full overflow-hidden">
    <div x-data="{ sidebarOpen: true }" class="flex h-screen bg-slate-50 overflow-hidden">
        
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" 
             x-cloak
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 z-40 bg-slate-900/60 lg:hidden" aria-hidden="true"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full lg:translate-x-0 lg:w-0 lg:opacity-0'"
               class="fixed inset-y-0 left-0 z-50 transition-all duration-300 ease-in-out bg-white border-r border-slate-200 lg:static overflow-hidden">
            
            <div class="flex flex-col h-full w-64">
                <!-- Logo -->
                <div class="flex items-center justify-between h-16 px-6 border-b border-slate-100 shrink-0">
                    <a href="/" class="flex items-center gap-2 group whitespace-nowrap">
                        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-600 text-white group-hover:bg-indigo-700 transition-colors">
                            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-800">Ceramah<span class="text-indigo-600">App</span></span>
                    </a>
                    <button @click="sidebarOpen = false" class="lg:hidden p-1 text-slate-500 hover:text-slate-900">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                    <div class="pb-4 mb-4 border-b border-slate-100">
                        <p class="px-2 mb-2 text-xs font-semibold tracking-wider text-slate-400 uppercase">Menu Utama</p>
                        <a href="/" class="flex items-center gap-3 px-3 py-2 text-sm font-medium transition-all rounded-lg {{ request()->is('/') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <i data-lucide="home" class="w-4 h-4"></i>
                            Dashboard
                        </a>
                        
                        <a href="{{ route('pricing') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium transition-all rounded-lg {{ request()->is('pricing') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <i data-lucide="tag" class="w-4 h-4"></i>
                            Harga
                        </a>

                        @auth
                            <a href="{{ route('data.ceramah') }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium transition-all rounded-lg {{ request()->routeIs('data.ceramah') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                <i data-lucide="mic" class="w-4 h-4"></i>
                                Data Ceramah
                            </a>
                            <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm font-medium transition-all rounded-lg text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                                <i data-lucide="users" class="w-4 h-4"></i>
                                Penceramah
                            </a>
                        @endauth
                    </div>

                    
                </nav>

                <!-- User Profile Sidebar (Bottom) -->
                <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                    @auth
                        <div class="flex items-center gap-3">
                            <div class="flex-shrink-0 w-9 h-9 overflow-hidden rounded-full bg-indigo-100 border border-indigo-200">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff" alt="Avatar">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold truncate text-slate-800">{{ auth()->user()->name }}</p>
                                <p class="text-[10px] truncate text-slate-500 uppercase tracking-wider font-semibold">{{ auth()->user()->email }}</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="p-1 text-slate-400 hover:text-rose-600 transition-colors" title="Logout">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white text-xs font-bold rounded-lg hover:bg-indigo-700 transition-all shadow-sm">
                                <i data-lucide="log-in" class="w-3.5 h-3.5"></i>
                                Login
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
            <!-- Top Navbar -->
            <header class="flex items-center justify-between h-16 px-4 bg-white border-b border-slate-200 shrink-0 lg:px-8">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 -ml-2 text-slate-500 hover:text-slate-900 hover:bg-slate-50 rounded-lg transition-all">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <h1 class="text-lg font-semibold text-slate-800">@yield('header', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 bg-slate-100 rounded-full text-slate-500">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        <input type="text" placeholder="Search..." class="w-32 bg-transparent border-none text-sm focus:ring-0 placeholder-slate-400">
                    </div>
                    
                    @auth
                        <button class="relative p-2 text-slate-400 hover:text-slate-600 transition-colors">
                            <i data-lucide="bell" class="w-5 h-5"></i>
                            <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full ring-2 ring-white"></span>
                        </button>

                        <div class="w-px h-6 bg-slate-200 mx-1"></div>

                        <div class="flex items-center gap-3">
                            <div class="hidden sm:block text-right">
                                <p class="text-sm font-medium text-slate-800">{{ auth()->user()->name }}</p>
                                <p class="text-[10px] font-semibold text-indigo-600 uppercase tracking-tighter leading-none">Standard User</p>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-slate-200 border border-slate-300 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" class="w-full h-full object-cover" alt="">
                            </div>
                        </div>
                    @endauth
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-slate-50 p-4 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
