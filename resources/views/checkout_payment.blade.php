@extends('layouts.admin')

@section('header', 'Pilih Metode Pembayaran')

@section('content')
<div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">

    <!-- Detail Tagihan (Kiri) -->
    <div class="md:col-span-1 space-y-6">
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl overflow-hidden p-6 space-y-4">
            <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-widest border-b border-slate-100 pb-2">Ringkasan Tagihan</h3>
            
            <div>
                <p class="text-[10px] uppercase font-bold text-slate-500 tracking-wider">Paket Dipilih</p>
                <p class="font-bold text-slate-900">{{ $plan_name }}</p>
            </div>

            <div>
                <p class="text-[10px] uppercase font-bold text-slate-500 tracking-wider">Detail Pembeli</p>
                <ul class="text-xs font-semibold text-slate-800 space-y-1 mt-1">
                    <li><i data-lucide="user" class="inline w-3 h-3 text-indigo-400"></i> {{ $customer_name }}</li>
                    <li><i data-lucide="mail" class="inline w-3 h-3 text-indigo-400"></i> {{ $customer_email }}</li>
                    <li><i data-lucide="phone" class="inline w-3 h-3 text-indigo-400"></i> {{ $customer_phone }}</li>
                </ul>
            </div>

            <div class="pt-4 border-t border-slate-100">
                <p class="text-[11px] font-black text-slate-400 uppercase tracking-widest">Total Bayar</p>
                <p class="text-3xl font-black text-slate-900 mt-1">Rp{{ number_format($amount, 0, ',', '.') }}</p>
            </div>
            
        </div>
    </div>

    <!-- Pilihan Metode (Kanan) -->
    <div class="md:col-span-2 relative">
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl p-8 lg:p-10">
            <h2 class="text-xl font-black mb-6 flex items-center gap-3">
                <i data-lucide="wallet" class="w-6 h-6 text-indigo-500"></i> Pembayaran Tripay
            </h2>
            
            @if(session('error'))
                <div class="bg-red-50 text-red-600 border border-red-200 p-4 rounded-xl text-sm font-bold mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if(empty($channels))
                <div class="text-center bg-slate-50 p-6 rounded-2xl border border-slate-100">
                    <i data-lucide="alert-triangle" class="w-10 h-10 text-orange-400 mx-auto mb-3"></i>
                    <p class="text-sm font-bold text-slate-600">Terjadi kesalahan / Kunci Tripay belum dikonfigurasi.<br>Silakan hubungi administrator website.</p>
                </div>
            @else
                <form action="{{ route('checkout.process') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="plan" value="{{ $plan }}">
                    <input type="hidden" name="customer_name" value="{{ $customer_name }}">
                    <input type="hidden" name="customer_email" value="{{ $customer_email }}">
                    <input type="hidden" name="customer_phone" value="{{ $customer_phone }}">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($channels as $channel)
                            @if($channel['active'])
                                <label class="block relative group cursor-pointer">
                                    <input type="radio" name="method" value="{{ $channel['code'] }}" required class="peer sr-only">
                                    <div class="h-full p-4 border border-slate-200 rounded-2xl bg-slate-50 peer-checked:bg-indigo-50 peer-checked:border-indigo-500 peer-checked:ring-2 peer-checked:ring-indigo-200 transition-all flex items-center justify-between gap-4">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $channel['icon_url'] }}" alt="{{ $channel['name'] }}" class="w-auto h-6 object-contain">
                                            <div>
                                                <p class="text-xs font-bold text-slate-700">{{ $channel['name'] }}</p>
                                                <p class="text-[10px] text-slate-400">Biaya: Rp{{ number_format($channel['fee_customer']['flat'], 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <i data-lucide="check-circle" class="absolute top-4 right-4 w-5 h-5 text-indigo-500 opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                </label>
                            @endif
                        @endforeach
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <button type="submit" class="w-full py-4 bg-slate-900 text-white font-bold rounded-2xl hover:bg-slate-800 transition-all shadow-lg active:scale-[0.98] flex items-center justify-center gap-2">
                            <i data-lucide="lock" class="w-4 h-4"></i> Lanjut Pembayaran (Aman via Tripay)
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
