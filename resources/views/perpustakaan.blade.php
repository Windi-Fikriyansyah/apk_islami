@extends('layouts.admin')

@section('header', 'Perpustakaan Islami')

@section('content')
<div class="max-w-7xl mx-auto space-y-12">
    <!-- Hero Header -->
    <div class="bg-gradient-to-br from-amber-600 via-orange-600 to-rose-700 rounded-[3rem] p-12 text-white relative overflow-hidden shadow-2xl">
        <div class="relative z-10 max-w-2xl space-y-4">
            <h2 class="text-4xl md:text-6xl font-black italic tracking-tighter leading-none">Cahaya Ilmu <br><span class="text-amber-200">Perpustakaan Digital</span></h2>
            <p class="text-amber-50/80 text-lg font-medium tracking-wide">Jelajahi ribuan kitab kuning, buku elektronik (E-book) Islami, artikel, dan kajian mendalam para ulama salaf dan khalaf di Google Drive secara tak terbatas.</p>
        </div>
        <div class="absolute right-0 top-0 -mr-24 -mt-24 w-[500px] h-[500px] bg-white/10 rounded-full blur-[120px]"></div>
        <i data-lucide="library" class="absolute right-12 bottom-12 w-48 h-48 text-white/5 rotate-12 transition-transform hover:scale-110 duration-700"></i>
    </div>

    <!-- Category Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        
        <!-- Category Card: Kitab Kuning -->
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm hover:shadow-2xl hover:shadow-amber-500/10 transition-all duration-500 relative overflow-hidden flex flex-col justify-between h-full">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-full -mr-16 -mt-16 opacity-50 group-hover:scale-110 transition-transform"></div>
            
            <div class="relative z-10 space-y-8">
                <div class="w-16 h-16 rounded-3xl bg-amber-500 text-white flex items-center justify-center shadow-lg shadow-amber-500/30 group-hover:rotate-12 transition-transform duration-500">
                    <i data-lucide="book" class="w-8 h-8"></i>
                </div>
                
                <div class="space-y-3">
                    <h3 class="text-2xl font-black text-slate-900 leading-none">Kitab Kuning</h3>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed">Koleksi kitab Turats, Fiqh 4 Madzhab, Tauhid, Akhlaq, dan Hadits klasik dalam format PDF.</p>
                </div>
                
                <a href="https://drive.google.com/drive/folders/YOUR_ID_HERE" target="_blank" class="flex items-center justify-center gap-2 w-full py-4 bg-amber-50 text-amber-700 font-black text-xs uppercase tracking-widest rounded-2xl group-hover:bg-amber-500 group-hover:text-white transition-all">
                    <i data-lucide="folder-open" class="w-4 h-4"></i> Buka Perpustakaan
                </a>
            </div>
        </div>

        <!-- Category Card: Tafsir & Hadits -->
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm hover:shadow-2xl hover:shadow-orange-500/10 transition-all duration-500 relative overflow-hidden flex flex-col justify-between h-full">
            <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-full -mr-16 -mt-16 opacity-50 group-hover:scale-110 transition-transform"></div>
            
            <div class="relative z-10 space-y-8">
                <div class="w-16 h-16 rounded-3xl bg-orange-600 text-white flex items-center justify-center shadow-lg shadow-orange-500/30 group-hover:rotate-12 transition-transform duration-500">
                    <i data-lucide="bookmark" class="w-8 h-8"></i>
                </div>
                
                <div class="space-y-3">
                    <h3 class="text-2xl font-black text-slate-900 leading-none">Tafsir & Hadits</h3>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed">Referesi utama kitab Tafsir (Ibnu Katsir, Jalalain, dll) dan Kutubus Sittah Hadits Nabawi.</p>
                </div>
                
                <a href="https://drive.google.com/drive/folders/YOUR_ID_HERE" target="_blank" class="flex items-center justify-center gap-2 w-full py-4 bg-orange-50 text-orange-700 font-black text-xs uppercase tracking-widest rounded-2xl group-hover:bg-orange-600 group-hover:text-white transition-all">
                    <i data-lucide="folder-open" class="w-4 h-4"></i> Pilih Referensi
                </a>
            </div>
        </div>

        <!-- Category Card: Buku Modern -->
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm hover:shadow-2xl hover:shadow-rose-500/10 transition-all duration-500 relative overflow-hidden flex flex-col justify-between h-full">
            <div class="absolute top-0 right-0 w-32 h-32 bg-rose-50 rounded-full -mr-16 -mt-16 opacity-50 group-hover:scale-110 transition-transform"></div>
            
            <div class="relative z-10 space-y-8">
                <div class="w-16 h-16 rounded-3xl bg-rose-500 text-white flex items-center justify-center shadow-lg shadow-rose-500/30 group-hover:rotate-12 transition-transform duration-500">
                    <i data-lucide="book-open" class="w-8 h-8"></i>
                </div>
                
                <div class="space-y-3">
                    <h3 class="text-2xl font-black text-slate-900 leading-none">E-Book Modern</h3>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed">Buku-buku islami kontemporer, majalah, kajian sosiologi islam, dan sejarah peradaban.</p>
                </div>
                
                <a href="https://drive.google.com/drive/folders/YOUR_ID_HERE" target="_blank" class="flex items-center justify-center gap-2 w-full py-4 bg-rose-50 text-rose-700 font-black text-xs uppercase tracking-widest rounded-2xl group-hover:bg-rose-500 group-hover:text-white transition-all">
                    <i data-lucide="folder-open" class="w-4 h-4"></i> Lihat Koleksi
                </a>
            </div>
        </div>

        <!-- Category Card: Media Dakwah -->
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 p-8 shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-500 relative overflow-hidden flex flex-col justify-between h-full">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full -mr-16 -mt-16 opacity-50 group-hover:scale-110 transition-transform"></div>
            
            <div class="relative z-10 space-y-8">
                <div class="w-16 h-16 rounded-3xl bg-indigo-600 text-white flex items-center justify-center shadow-lg shadow-indigo-500/30 group-hover:rotate-12 transition-transform duration-500">
                    <i data-lucide="video" class="w-8 h-8"></i>
                </div>
                
                <div class="space-y-3">
                    <h3 class="text-2xl font-black text-slate-900 leading-none">Materi Dakwah</h3>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed">Kumpulan template PPT dakwah, video edukasi, pamflet kajian, dan aset visual dakwah.</p>
                </div>
                
                <a href="https://drive.google.com/drive/folders/YOUR_ID_HERE" target="_blank" class="flex items-center justify-center gap-2 w-full py-4 bg-indigo-50 text-indigo-700 font-black text-xs uppercase tracking-widest rounded-2xl group-hover:bg-indigo-600 group-hover:text-white transition-all">
                    <i data-lucide="folder-open" class="w-4 h-4"></i> Download Aset
                </a>
            </div>
        </div>

    </div>

    <!-- Info Section -->
    <div class="flex flex-col lg:flex-row gap-8 items-center bg-slate-50 p-10 rounded-[2.5rem] border border-slate-100 relative overflow-hidden">
        <div class="w-20 h-20 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 shadow-xl shadow-amber-500/10">
            <i data-lucide="info" class="w-10 h-10"></i>
        </div>
        <div class="flex-1 space-y-1 text-center lg:text-left">
            <h4 class="text-xl font-bold text-slate-900">Petunjuk Penggunaan Gratis</h4>
            <p class="text-slate-500 font-medium text-sm leading-relaxed">Seluruh materi dalam perpustakaan digital ini bebas diakses melalui Google Drive. Anda disarankan untuk mengunduh (copy) koleksi yang dibutuhkan untuk dipelajari secara mandiri demi kemaslahatan umat.</p>
        </div>
        <div class="flex gap-4">
            <span class="flex items-center gap-2 text-[10px] font-black text-slate-400 border border-slate-200 px-4 py-2 rounded-full uppercase tracking-widest"><i data-lucide="lock" class="w-3 h-3"></i> Google Drive Cloud</span>
        </div>
    </div>
</div>
@endsection
