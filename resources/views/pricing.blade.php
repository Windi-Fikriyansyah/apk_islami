@extends('layouts.admin')

@section('header', 'Pilih Paket Layanan')

@section('content')
<div class="py-8 space-y-12">
    <!-- Header Section -->
    <div class="text-center space-y-4 max-w-3xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-tight">Investasi Ilmu Untuk <span class="text-indigo-600">Masa Depan Akhirat</span></h2>
        <p class="text-slate-500 text-lg">Pilih paket yang sesuai dengan kebutuhan dakwah dan pembelajaran Anda. Sekali bayar, manfaat selamanya.</p>
    </div>

    <!-- Pricing Cards Grid -->
    <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        
        <!-- PAKET STANDAR -->
        <div class="relative group">
            <div class="h-full bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 p-8 lg:p-10 flex flex-col transition-all hover:scale-[1.02] hover:shadow-2xl">
                <div class="space-y-6 flex-1">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                            <i data-lucide="shield-check" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">PAKET STANDAR</h3>
                            <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest">Paling Praktis</p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-500 leading-relaxed">Pilihan tepat untuk pengguna yang ingin mulai menggunakan fitur utama Islamic Masterpiece secara praktis dan efisien.</p>

                    <div class="py-6 border-y border-slate-50">
                        <div class="flex items-baseline gap-1">
                            <span class="text-2xl font-bold text-slate-900">Rp</span>
                            <span class="text-5xl font-black text-slate-900 tracking-tighter">99.000</span>
                        </div>
                        <p class="text-sm font-semibold text-slate-400 mt-2">Bayar sekali • Akses selamanya</p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <h4 class="text-xs font-black text-slate-900 uppercase tracking-widest mb-4">Fitur Utama</h4>
                            <ul class="space-y-4">
                                <li class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0 w-5 h-5 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                                        <i data-lucide="check" class="w-3 h-3"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">Tanya Jawab Islam</p>
                                        <p class="text-xs text-slate-500">Dapatkan jawaban berbagai pertanyaan Islam berdasarkan Al-Qur’an, hadis sahih, dan penjelasan ulama.</p>
                                    </div>
                                </li>
                                <li class="flex items-start gap-3">
                                    <div class="mt-1 flex-shrink-0 w-5 h-5 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center">
                                        <i data-lucide="check" class="w-3 h-3"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">Support Standar</p>
                                        <p class="text-xs text-slate-500">Bantuan penggunaan aplikasi jika mengalami kendala atau membutuhkan panduan.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="bg-indigo-50/50 rounded-2xl p-5 border border-indigo-100/50">
                            <h4 class="text-xs font-black text-indigo-600 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <i data-lucide="gift" class="w-3 h-3"></i> BONUS EKSKLUSIF
                            </h4>
                            <ul class="space-y-3">
                                <li class="text-xs text-slate-700 flex gap-2">
                                    <span class="flex-shrink-0">🎁</span>
                                    <span>Video Tutorial Islamic Masterpiece (Panduan lengkap menggunakan fitur aplikasi)</span>
                                </li>
                                <li class="text-xs text-slate-700 flex gap-2">
                                    <span class="flex-shrink-0">🎁</span>
                                    <span>Akses Grup Eksklusif</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('checkout.detail', ['plan' => 'standar']) }}" class="block text-center w-full py-4 px-6 bg-slate-900 text-white font-bold rounded-2xl hover:bg-slate-800 transition-all shadow-lg active:scale-[0.98]">
                        PILIH PAKET STANDAR
                    </a>
                    <div class="mt-4 flex flex-wrap justify-center gap-x-4 gap-y-2">
                        <span class="text-[10px] font-bold text-slate-400 flex items-center gap-1">
                            <i data-lucide="check-circle-2" class="w-3 h-3 text-emerald-500"></i> Hemat Biaya
                        </span>
                        <span class="text-[10px] font-bold text-slate-400 flex items-center gap-1">
                            <i data-lucide="check-circle-2" class="w-3 h-3 text-emerald-500"></i> Untuk Pemula
                        </span>
                        <span class="text-[10px] font-bold text-slate-400 flex items-center gap-1">
                            <i data-lucide="check-circle-2" class="w-3 h-3 text-emerald-500"></i> Sekali Bayar
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAKET PREMIUM -->
        <div class="relative group">
            <!-- Best Value Tag -->
            <div class="absolute -top-4 left-1/2 -translate-x-1/2 z-20">
                <span class="bg-gradient-to-r from-amber-400 to-orange-500 text-white text-[10px] font-black px-4 py-1.5 rounded-full shadow-lg uppercase tracking-[0.2em] ring-4 ring-white">Paling Populer</span>
            </div>

            <div class="h-full bg-slate-900 rounded-[2.5rem] border border-slate-800 shadow-2xl p-8 lg:p-10 flex flex-col transition-all hover:scale-[1.02] relative overflow-hidden">
                <!-- Decor -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 bg-indigo-500/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-32 h-32 bg-orange-500/10 rounded-full blur-3xl"></div>
                
                <div class="space-y-6 flex-1 relative z-10">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                            <i data-lucide="crown" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">PAKET PREMIUM</h3>
                            <p class="text-[10px] font-bold text-amber-400 uppercase tracking-widest">Fitur Terlengkap</p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-400 leading-relaxed">Akses Selamanya • Fitur Terlengkap • Prioritas Utama untuk mendukung dakwah Anda.</p>

                    <div class="py-6 border-y border-slate-800">
                        <div class="flex items-baseline gap-1 text-white">
                            <span class="text-2xl font-bold">Rp</span>
                            <span class="text-5xl font-black tracking-tighter">150.000</span>
                        </div>
                        <p class="text-sm font-semibold text-slate-500 mt-2">Sekali bayar • Akses seumur hidup</p>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <h4 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-4">Fitur Lengkap Tanpa Batas</h4>
                            <ul class="grid grid-cols-2 gap-3">
                                <li class="flex items-center gap-2 text-[11px] text-slate-300 font-medium">
                                    <span class="text-emerald-400 text-lg leading-none">✓</span> Tanya Jawab Islam
                                </li>
                                <li class="flex items-center gap-2 text-[11px] text-slate-300 font-medium">
                                    <span class="text-emerald-400 text-lg leading-none">✓</span> Materi Dakwah Otomatis
                                </li>
                                <li class="flex items-center gap-2 text-[11px] text-slate-300 font-medium">
                                    <span class="text-emerald-400 text-lg leading-none">✓</span> Kisah Adab Islami
                                </li>
                                <li class="flex items-center gap-2 text-[11px] text-slate-300 font-medium">
                                    <span class="text-emerald-400 text-lg leading-none">✓</span> Konsultasi Islami
                                </li>
                                <li class="flex items-center gap-2 text-[11px] text-slate-300 font-medium">
                                    <span class="text-emerald-400 text-lg leading-none">✓</span> Audio Qur'an
                                    </li>
                                <li class="flex items-center gap-2 text-[11px] text-slate-300 font-medium">
                                    <span class="text-emerald-400 text-lg leading-none">✓</span> Perpustakaan Islami
                                </li>
                            </ul>
                            <p class="mt-4 flex items-start gap-2 text-[11px] text-slate-400">
                                <span class="text-amber-400">★</span> 
                                <span><strong>Priority Support:</strong> Bantuan prioritas kapanpun Anda membutuhkan panduan.</span>
                            </p>
                        </div>

                        <div class="bg-white/5 rounded-2xl p-5 border border-white/10">
                            <h4 class="text-xs font-black text-amber-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                                <i data-lucide="sparkles" class="w-3 h-3"></i> BONUS PREMIUM (GRATIS)
                            </h4>
                            <ul class="space-y-3">
                                <li class="text-xs text-slate-300 flex gap-2">
                                    <span class="flex-shrink-0">🎁</span>
                                    <span>Video Tutorial aplikasi Islamic Masterpiece (Panduan lengkap untuk memaksimalkan semua fitur aplikasi)</span>
                                </li>
                                <li class="text-xs text-slate-300 flex gap-2">
                                    <span class="flex-shrink-0">🎁</span>
                                    <span>Akses Grup Premium (WhatsApp) Bergabung dengan komunitas pengguna untuk berbagi ilmu, pengalaman, dan informasi terbaru.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mt-10 relative z-10">
                    <a href="{{ route('checkout.detail', ['plan' => 'premium']) }}" class="block text-center w-full py-4 px-6 bg-gradient-to-r from-amber-400 to-orange-500 text-white font-black rounded-2xl hover:brightness-110 transition-all shadow-lg shadow-orange-500/20 active:scale-[0.98]">
                        PILIH PAKET PREMIUM
                    </a>
                    <p class="mt-4 text-[10px] text-center font-bold text-slate-500 tracking-wide">Cocok untuk Ustadz, Santri, & Guru</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Additional Trust Badges -->
    <div class="pt-8 text-center sm:flex sm:items-center sm:justify-center sm:gap-12 opacity-50 space-y-4 sm:space-y-0">
        <div class="flex items-center justify-center gap-2 grayscale group hover:grayscale-0 transition-all">
            <i data-lucide="infinity" class="w-5 h-5"></i>
            <span class="text-xs font-bold uppercase tracking-widest">Akses Selamanya</span>
        </div>
        <div class="flex items-center justify-center gap-2 grayscale group hover:grayscale-0 transition-all">
            <i data-lucide="shield-check" class="w-5 h-5"></i>
            <span class="text-xs font-bold uppercase tracking-widest">Transaksi Aman</span>
        </div>
        <div class="flex items-center justify-center gap-2 grayscale group hover:grayscale-0 transition-all">
            <i data-lucide="message-square" class="w-5 h-5"></i>
            <span class="text-xs font-bold uppercase tracking-widest">Support Cepat</span>
        </div>
    </div>
</div>
@endsection
