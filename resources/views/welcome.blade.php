@extends('layouts.admin')

@section('header', 'AI Generator Ceramah')

@section('content')
<div class="space-y-8">
    <!-- Hero AI Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 rounded-3xl p-8 lg:p-12 text-white shadow-xl shadow-indigo-100">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
        
        <div class="relative grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-bold tracking-wider uppercase mb-6 border border-white/20">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                    Bertenaga Kecerdasan Buatan
                </div>
                <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight mb-6">
                    Buat Materi Ceramah <br>
                    <span class="text-indigo-200">Dalam Hitungan Detik</span>
                </h1>
                <p class="text-lg text-indigo-100 mb-8 leading-relaxed max-w-md">
                    Gunakan algoritma AI tercanggih untuk menghasilkan konten dakwah yang mendalam, terstruktur, dan relevan dengan audiens Anda.
                </p>
                <div class="flex flex-wrap gap-4">
                    <button class="px-6 py-3 bg-white text-indigo-700 font-bold rounded-xl hover:bg-slate-50 transition-all flex items-center gap-2 shadow-lg shadow-indigo-900/20">
                        <i data-lucide="zap" class="w-5 h-5"></i>
                        Mulai Generator
                    </button>
                    <button class="px-6 py-3 bg-white/10 backdrop-blur-md text-white font-bold rounded-xl border border-white/30 hover:bg-white/20 transition-all">
                        Pelajari Cara Kerja
                    </button>
                </div>
            </div>
            
            <div class="hidden lg:block">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 shadow-2xl">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 border-b border-white/10 pb-4">
                            <div class="w-3 h-3 rounded-full bg-rose-400"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-400"></div>
                            <span class="text-xs font-mono text-indigo-200 ml-2">ai-engine: v4.0-stable</span>
                        </div>
                        <div class="font-mono text-sm space-y-2">
                            <p class="text-emerald-300">>> Mengidentifikasi tema: "Keutamaan Sabar"</p>
                            <p class="text-indigo-200">>> Mencari referensi ayat dan hadist...</p>
                            <p class="text-indigo-200">>> Menyusun struktur pembukaan...</p>
                            <div class="h-2 w-full bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-400 w-3/4 animate-pulse"></div>
                            </div>
                            <p class="text-white pt-2 italic">"Sabar adalah cahaya yang menuntun di kala gelap..."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature Grid -->
    <div class="grid md:grid-cols-3 gap-6">
        <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm hover:border-indigo-300 transition-colors group">
            <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="book-open" class="w-6 h-6"></i>
            </div>
            <h3 class="font-bold text-slate-800 mb-2">Referensi Terpercaya</h3>
            <p class="text-sm text-slate-500">AI kami dilatih dengan ribuan kitab dan materi dakwah shahih untuk hasil yang akurat.</p>
        </div>

        <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm hover:border-indigo-300 transition-colors group">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="layout" class="w-6 h-6"></i>
            </div>
            <h3 class="font-bold text-slate-800 mb-2">Struktur Otomatis</h3>
            <p class="text-sm text-slate-500">Mulai dari Muqaddimah, Isi, hingga Penutup disusun secara sistematis dan rapi.</p>
        </div>

        <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm hover:border-indigo-300 transition-colors group">
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <i data-lucide="languages" class="w-6 h-6"></i>
            </div>
            <h3 class="font-bold text-slate-800 mb-2">Beragam Mood</h3>
            <p class="text-sm text-slate-500">Sesuaikan gaya bahasa: Formal, Santai, atau Menyentuh Hati sesuai target audiens.</p>
        </div>
    </div>

    <!-- Generator Interface Preview -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-bold text-slate-800">Coba Generator Sekarang</h3>
        </div>
        <div class="p-8">
            <div class="max-w-3xl mx-auto space-y-6">
                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tema Ceramah</label>
                        <input type="text" placeholder="Contoh: Manfaat Sedekah" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Durasi (Menit)</label>
                        <select class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                            <option>5 - 10 Menit</option>
                            <option>15 - 20 Menit</option>
                            <option>30+ Menit</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Target Audiens</label>
                    <div class="flex flex-wrap gap-3">
                        <button class="px-4 py-2 rounded-full border border-slate-200 text-sm font-medium hover:bg-indigo-50 hover:text-indigo-600 transition-all">Remaja/Millenial</button>
                        <button class="px-4 py-2 rounded-full border border-indigo-600 bg-indigo-50 text-indigo-600 text-sm font-medium">Umum/Jamaah Masjid</button>
                        <button class="px-4 py-2 rounded-full border border-slate-200 text-sm font-medium hover:bg-indigo-50 hover:text-indigo-600 transition-all">Anak-anak</button>
                    </div>
                </div>
                <button class="w-full py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-slate-800 transition-all flex items-center justify-center gap-3">
                    <i data-lucide="wand-2" class="w-5 h-5"></i>
                    Generate Draft Ceramah
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
