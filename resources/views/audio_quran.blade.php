@extends('layouts.admin')

@section('header', 'Audio Qur\'an')

@section('content')
<div class="max-w-6xl mx-auto space-y-10 py-6">
    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-violet-700 rounded-[2.5rem] p-10 text-white relative overflow-hidden shadow-2xl">
        <div class="relative z-10 space-y-4 max-w-2xl">
            <h2 class="text-3xl md:text-5xl font-black tracking-tight leading-tight">Mendengar Al-Qur'an <br><span class="text-blue-200">Menyejukkan Hati</span></h2>
            <p class="text-blue-50/80 text-lg font-medium leading-relaxed">Akses koleksi murottal Al-Qur'an lengkap dari berbagai Qari' terkemuka dunia di Google Drive secara gratis.</p>
        </div>
        <div class="absolute right-0 top-0 -mr-20 -mt-20 w-96 h-96 bg-white/10 rounded-full blur-[100px]"></div>
        <i data-lucide="music" class="absolute right-12 bottom-12 w-40 h-40 text-white/10 rotate-12"></i>
    </div>

    <!-- Features / Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- Audio Card 1 -->
        <div class="group bg-white rounded-[2rem] border border-slate-100 p-8 hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -mr-16 -mt-16 opacity-50 group-hover:scale-110 transition-transform"></div>
            
            <div class="relative z-10 space-y-6">
                <div class="w-14 h-14 rounded-2xl bg-blue-500 text-white flex items-center justify-center shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform duration-500">
                    <i data-lucide="headphones" class="w-7 h-7"></i>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Murottal Lengkap 30 Juz</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Koleksi audio Al-Qur'an lengkap dari surah Al-Fatihah hingga An-Nas dalam kualitas jernih.</p>
                </div>
                
                <a href="https://drive.google.com/drive/folders/YOUR_ID_HERE" target="_blank" class="inline-flex items-center gap-2 text-blue-600 font-bold text-sm tracking-wide bg-blue-50 px-6 py-3 rounded-xl hover:bg-blue-600 hover:text-white transition-all w-full justify-center">
                    <i data-lucide="external-link" class="w-4 h-4"></i> Akses Google Drive
                </a>
            </div>
        </div>

        <!-- Audio Card 2 -->
        <div class="group bg-white rounded-[2rem] border border-slate-100 p-8 hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full -mr-16 -mt-16 opacity-50 group-hover:scale-110 transition-transform"></div>
            
            <div class="relative z-10 space-y-6">
                <div class="w-14 h-14 rounded-2xl bg-indigo-500 text-white flex items-center justify-center shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform duration-500">
                    <i data-lucide="users" class="w-7 h-7"></i>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Qari' Terkenal Dunia</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Mushari Rashid Al-Afasy, Saad Al-Ghamdi, Abdur Rahman As-Sudais, dan lainnya.</p>
                </div>
                
                <a href="https://drive.google.com/drive/folders/YOUR_ID_HERE" target="_blank" class="inline-flex items-center gap-2 text-indigo-600 font-bold text-sm tracking-wide bg-indigo-50 px-6 py-3 rounded-xl hover:bg-indigo-600 hover:text-white transition-all w-full justify-center">
                    <i data-lucide="external-link" class="w-4 h-4"></i> Pilih Syekh Terkenal
                </a>
            </div>
        </div>

        <!-- Audio Card 3 -->
        <div class="group bg-white rounded-[2rem] border border-slate-100 p-8 hover:shadow-2xl hover:shadow-violet-500/10 transition-all duration-300 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-violet-50 rounded-full -mr-16 -mt-16 opacity-50 group-hover:scale-110 transition-transform"></div>
            
            <div class="relative z-10 space-y-6">
                <div class="w-14 h-14 rounded-2xl bg-violet-500 text-white flex items-center justify-center shadow-lg shadow-violet-500/20 group-hover:scale-110 transition-transform duration-500">
                    <i data-lucide="mic-2" class="w-7 h-7"></i>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Qur'an & Terjemahan Audio</h3>
                    <p class="text-sm text-slate-500 leading-relaxed font-medium">Mendengarkan bacaan Al-Qur'an sekaligus memahami artinya dalam Bahasa Indonesia.</p>
                </div>
                
                <a href="https://drive.google.com/drive/folders/YOUR_ID_HERE" target="_blank" class="inline-flex items-center gap-2 text-violet-600 font-bold text-sm tracking-wide bg-violet-50 px-6 py-3 rounded-xl hover:bg-violet-600 hover:text-white transition-all w-full justify-center">
                    <i data-lucide="external-link" class="w-4 h-4"></i> Akses Dengan Terjemahan
                </a>
            </div>
        </div>

    </div>

    <!-- Quote / Badge -->
    <div class="bg-slate-900 rounded-[2rem] p-8 text-center text-white relative overflow-hidden mt-12">
        <div class="relative z-10 space-y-2">
            <p class="text-blue-400 font-black text-xs uppercase tracking-[0.3em]">Nasihat Qurani</p>
            <h3 class="text-2xl font-bold italic">"Ketahuilah, dengan mengingat Allah hati menjadi tenteram."</h3>
            <p class="text-slate-400 text-sm font-medium">(QS. Ar-Ra'd: 28)</p>
        </div>
        <!-- Abstract Decor -->
        <div class="absolute left-0 bottom-0 w-40 h-40 bg-blue-500/10 blur-3xl rounded-full"></div>
    </div>
</div>
@endsection
