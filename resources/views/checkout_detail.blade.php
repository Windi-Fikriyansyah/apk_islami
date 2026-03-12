@extends('layouts.admin')

@section('header', 'Detail Pembelian')

@section('content')
<div class="max-w-3xl mx-auto space-y-8">
    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl overflow-hidden">
        <div class="bg-slate-900 p-8 text-white relative">
            <div class="absolute right-0 top-0 w-32 h-32 bg-indigo-500/20 rounded-full blur-3xl"></div>
            <h2 class="text-2xl font-black relative z-10">{{ $plan_name }}</h2>
            <p class="text-slate-400 mt-2 relative z-10 text-sm">Lengkapi data diri Anda untuk melanjutkan proses pembayaran.</p>
        </div>

        <div class="p-8">
            <form action="{{ route('checkout.methods') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="plan" value="{{ $plan }}">
                
                <div>
                    <label class="block text-[11px] font-black text-slate-400 mb-2 uppercase tracking-widest">Nama Lengkap</label>
                    <input type="text" name="customer_name" required placeholder="Masukkan nama lengkap Anda..." class="w-full px-5 py-4 bg-slate-50 border-0 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all text-sm text-slate-700 font-bold placeholder-slate-400">
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-400 mb-2 uppercase tracking-widest">Alamat Email</label>
                    <input type="email" name="customer_email" required placeholder="email@contoh.com" class="w-full px-5 py-4 bg-slate-50 border-0 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all text-sm text-slate-700 font-bold placeholder-slate-400">
                    <p class="text-[10px] text-slate-400 mt-2">*Akses login akan dikirimkan ke email ini.</p>
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-400 mb-2 uppercase tracking-widest">Nomor WhatsApp</label>
                    <input type="text" name="customer_phone" required placeholder="08xxxxxxxxxx" class="w-full px-5 py-4 bg-slate-50 border-0 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:bg-white outline-none transition-all text-sm text-slate-700 font-bold placeholder-slate-400">
                    <p class="text-[10px] text-slate-400 mt-2">*Akun akan dikirim Otomatis ke WhatsApp Anda saat pembayaran berhasil.</p>
                </div>

                <div class="py-6 border-t border-slate-100 flex justify-between items-center">
                    <div>
                        <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Pembayaran</p>
                        <h3 class="text-3xl font-black text-slate-900">Rp{{ number_format($amount, 0, ',', '.') }}</h3>
                    </div>
                    <button type="submit" class="py-4 px-8 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-all shadow-lg active:scale-[0.98] flex items-center gap-2">
                        Pilih Metode Pembayaran <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
