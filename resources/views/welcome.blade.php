@extends('layouts.admin')

@section('header', 'Islamic Masterpiece')

@section('content')
<div class="space-y-8">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 rounded-3xl p-8 lg:p-12 text-white shadow-xl shadow-indigo-100">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-4xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-bold tracking-wider uppercase mb-6 border border-white/20">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                Islamic Masterpiece
            </div>
            <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight mb-8">
                Asisten Islami <span class="text-indigo-200">Cerdas & Terpercaya</span>
            </h1>
            <div class="space-y-6 text-indigo-50 leading-relaxed text-lg">
                <p>
                    Islamic Masterpiece adalah aplikasi asisten Islami yang membantu pengguna memahami dan mengamalkan ajaran Islam dengan mudah. Aplikasi ini menyediakan jawaban dan materi keislaman yang merujuk pada Al-Qur’an, hadis sahih, serta penjelasan ulama dari kitab-kitab mu’tabar, disajikan secara jelas, terarah, dan mudah dipahami oleh berbagai kalangan.
                </p>
                <p>
                    Tidak hanya menjawab pertanyaan agama, Islamic Masterpiece juga membantu pengguna dalam menyiapkan materi dakwah, mempelajari adab Islami, mendapatkan nasihat kehidupan, mendengarkan Al-Qur’an, serta mengakses berbagai kitab dan literatur Islam dalam satu aplikasi praktis.
                </p>
                <p>
                    Dengan pendekatan yang sistematis dan ramah pengguna, Islamic Masterpiece menjadi aplikasi pendamping bagi ustadz, santri, guru, dan masyarakat umum dalam belajar, berdakwah, dan memperdalam pemahaman Islam.
                </p>
            </div>
            <div class="mt-10 flex flex-wrap gap-4">
                @guest
                <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-indigo-700 font-bold rounded-xl hover:bg-slate-50 transition-all flex items-center gap-2 shadow-lg shadow-indigo-900/20">
                    Mulai Sekarang
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
                @else
                <a href="{{ route('data.ceramah') }}" class="px-8 py-4 bg-white text-indigo-700 font-bold rounded-xl hover:bg-slate-50 transition-all flex items-center gap-2 shadow-lg shadow-indigo-900/20">
                    Buka Fitur Utama
                    <i data-lucide="zap" class="w-5 h-5"></i>
                </a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="space-y-6">
        <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
            <span class="w-8 h-1 bg-indigo-600 rounded-full"></span>
            Fitur Islamic Masterpiece
        </h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Feature 1 -->
            <div class="p-8 bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all group">
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 font-bold text-xl">1</div>
                <h3 class="text-xl font-bold text-slate-800 mb-3 tracking-tight">Tanya Jawab Islam</h3>
                <p class="text-slate-500 text-sm leading-relaxed font-medium">Menjawab berbagai pertanyaan seputar aqidah, ibadah, muamalah, dan kehidupan berdasarkan Al-Qur’an, hadis sahih, dan penjelasan ulama.</p>
            </div>

            <!-- Feature 2 -->
            <div class="p-8 bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all group border-t-4 border-t-indigo-500">
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 font-bold text-xl">2</div>
                <h3 class="text-xl font-bold text-slate-800 mb-3 tracking-tight">Materi Dakwah Otomatis</h3>
                <p class="text-slate-500 text-sm leading-relaxed font-medium">Membantu membuat materi kultum, ceramah, dan khutbah secara cepat dan terstruktur.</p>
            </div>

            <!-- Feature 3 -->
            <div class="p-8 bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all group">
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 font-bold text-xl">3</div>
                <h3 class="text-xl font-bold text-slate-800 mb-3 tracking-tight">Kisah Adab Islami</h3>
                <p class="text-slate-500 text-sm leading-relaxed font-medium">Menyajikan dan membuat cerita tentang adab dan akhlak Islami yang mudah dipahami.</p>
            </div>

            <!-- Feature 4 -->
            <div class="p-8 bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all group">
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 font-bold text-xl">4</div>
                <h3 class="text-xl font-bold text-slate-800 mb-3 tracking-tight">Konsultasi Islami</h3>
                <p class="text-slate-500 text-sm leading-relaxed font-medium">Ruang refleksi dan konsultasi untuk mendapatkan nasihat kehidupan berdasarkan nilai-nilai Islam.</p>
            </div>

            <!-- Feature 5 -->
            <div class="p-8 bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all group border-t-4 border-t-indigo-500">
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 font-bold text-xl">5</div>
                <h3 class="text-xl font-bold text-slate-800 mb-3 tracking-tight">Audio Qur'an</h3>
                <p class="text-slate-500 text-sm leading-relaxed font-medium">Mendengarkan bacaan Al-Qur’an (murattal) dengan mudah kapan saja.</p>
            </div>

            <!-- Feature 6 -->
            <div class="p-8 bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all group">
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500 font-bold text-xl">6</div>
                <h3 class="text-xl font-bold text-slate-800 mb-3 tracking-tight">Perpustakaan Islam</h3>
                <p class="text-slate-500 text-sm leading-relaxed font-medium">Koleksi kitab dan buku Islam dalam format digital (PDF) yang dapat dibaca langsung dalam aplikasi.</p>
            </div>
        </div>
    </div>

    <!-- Final Section -->
    <div class="bg-slate-900 rounded-3xl p-10 lg:p-16 text-white text-center space-y-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_50%_50%,rgba(79,70,229,0.1),transparent)]"></div>
        <div class="relative z-10 max-w-4xl mx-auto space-y-6">
            <p class="text-indigo-300 font-bold text-sm uppercase tracking-widest">Penutup</p>
            <p class="text-lg md:text-xl text-slate-300 leading-relaxed font-medium">
                Dengan berbagai fitur yang tersedia, Islamic Masterpiece hadir sebagai aplikasi yang memudahkan umat Islam dalam belajar, memahami, dan menyampaikan ajaran Islam secara praktis dalam satu platform. Melalui rujukan Al-Qur’an, hadis sahih, dan kitab-kitab ulama mu’tabar, aplikasi ini diharapkan menjadi pendamping yang bermanfaat bagi ustadz, santri, guru, maupun masyarakat umum dalam memperdalam ilmu, menyiapkan materi dakwah, serta mengamalkan nilai-nilai Islam dalam kehidupan sehari-hari.
            </p>
        </div>
    </div>
</div>
@endsection
