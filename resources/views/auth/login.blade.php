<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login Islamic Masterpiece</title>

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
    </style>
</head>
<body class="h-full antialiased bg-slate-50 flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        

        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 lg:p-10 relative overflow-hidden">
            <!-- Background Decor -->
            <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 bg-indigo-50 rounded-full"></div>
            
            <div class="relative">
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Selamat Datang</h2>
                    <p class="text-slate-500">Silakan masuk ke akun Anda</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-emerald-600 bg-emerald-50 p-3 rounded-xl border border-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                   class="block w-full pl-12 pr-4 py-3.5 bg-slate-50 border {{ $errors->has('email') ? 'border-rose-400 focus:ring-rose-500' : 'border-slate-200 focus:ring-indigo-500' }} rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:border-transparent transition-all"
                                   placeholder="admin@example.com">
                        </div>
                        @if ($errors->has('email'))
                            <p class="mt-2 text-sm text-rose-600 font-medium">{{ $errors->first('email') }}</p>
                        @endif
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-bold text-slate-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">Lupa Password?</a>
                            @endif
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                            </div>
                            <input type="password" id="password" name="password" required autocomplete="current-password"
                                   class="block w-full pl-12 pr-4 py-3.5 bg-slate-50 border {{ $errors->has('password') ? 'border-rose-400 focus:ring-rose-500' : 'border-slate-200 focus:ring-indigo-500' }} rounded-2xl text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:border-transparent transition-all"
                                   placeholder="••••••••">
                        </div>
                        @if ($errors->has('password'))
                            <p class="mt-2 text-sm text-rose-600 font-medium">{{ $errors->first('password') }}</p>
                        @endif
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox" id="remember_me" name="remember" class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500 transition-all cursor-pointer">
                        <label for="remember_me" class="ml-2 block text-sm text-slate-600 cursor-pointer select-none">Ingat saya untuk 30 hari</label>
                    </div>

                    <button type="submit" 
                            class="w-full py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 flex items-center justify-center gap-2 group active:scale-[0.98]">
                        Masuk Sekarang
                        <i data-lucide="log-in" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Back to Home Link -->
        <div class="mt-8 text-center">
            <a href="/" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-indigo-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
