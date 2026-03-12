@extends('layouts.admin')

@section('header', 'Konsultasi Islami')

@section('content')
<div x-data="konsultasiHandler()" class="max-w-4xl mx-auto space-y-6">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-indigo-700 to-indigo-900 rounded-[2.5rem] p-10 text-white relative overflow-hidden shadow-2xl">
        <div class="relative z-10 space-y-3">
            <h2 class="text-3xl font-bold italic"><span class="text-amber-400">Sahabat Konsultasi Muslim</span></h2>
            <p class="text-indigo-100/90 text-sm max-w-lg leading-relaxed">Ceritakan masalah hidup, kegelisahan hati, atau pertanyaan tentang iman dan kehidupan.</p>
        </div>
        <div class="absolute right-0 top-0 -mr-16 -mt-16 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        <i data-lucide="heart" class="absolute right-10 bottom-10 w-28 h-28 text-white/5 rotate-12"></i>
    </div>

    <!-- Input Section -->
    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8 space-y-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                <i data-lucide="message-circle" class="w-5 h-5"></i>
            </div>
            <h3 class="text-base font-bold text-slate-800">Ruang Curhat & Konsultasi</h3>
        </div>
        
        <div class="relative group">
            <textarea 
                x-model="masalah" 
                rows="5" 
                class="w-full px-6 py-5 bg-slate-50 border border-slate-200 rounded-3xl focus:ring-4 focus:ring-amber-500/10 focus:border-amber-400 outline-none transition-all text-sm text-slate-700 font-medium resize-none shadow-inner"
                placeholder="Ceritakan kegelisahan hati atau masalah yang sedang Anda hadapi dan apa yang ingin Anda tanyakan?"></textarea>
            <div class="absolute bottom-4 right-6 text-[10px] font-bold text-slate-400 select-none uppercase tracking-widest">Minimal 10 Huruf</div>
        </div>

        <button @click="solveProblem()" 
                :disabled="loading || masalah.length < 10"
                class="w-full py-5 bg-amber-500 text-white text-base font-bold rounded-[1.5rem] hover:bg-amber-600 transition-all flex items-center justify-center gap-3 shadow-lg shadow-amber-100 active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed">
            <template x-if="!loading">
                <span class="flex items-center gap-2">🌱 Hasilkan Jawaban</span>
            </template>
            <template x-if="loading">
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 border-3 border-white/30 border-t-white rounded-full animate-spin"></div>
                    <span>Sedang menyiapkan jawaban terbaik...</span>
                </div>
            </template>
        </button>
    </div>

    <!-- Result Area -->
    <div x-show="advice || loading" 
         x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0 transform translate-y-8"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden mb-12">
        
        <div class="px-8 py-4 border-b border-slate-50 flex items-center justify-between bg-amber-50/20">
            <div class="flex items-center gap-2">
                <div class="w-2.5 h-2.5 rounded-full bg-amber-500"></div>
                <h3 class="text-xs font-black text-amber-600 uppercase tracking-widest">Jawaban & Nasihat</h3>
            </div>
            <template x-if="advice && !loading">
                <button @click="copyAdvice()" class="text-amber-700 hover:text-amber-900 text-xs font-bold flex items-center gap-1">
                    <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                    Simpan Bimbingan
                </button>
            </template>
        </div>

        <div class="p-10">
            <template x-if="loading">
                <div class="space-y-6">
                    <div class="space-y-3">
                        <div class="h-4 bg-slate-50 rounded-full w-3/4 animate-pulse"></div>
                        <div class="h-4 bg-slate-50 rounded-full w-full animate-pulse"></div>
                        <div class="h-4 bg-slate-50 rounded-full w-5/6 animate-pulse"></div>
                    </div>
                </div>
            </template>

            <div x-show="!loading" class="prose prose-amber max-w-none">
                <div class="text-slate-700 leading-[2] text-[16px] font-medium whitespace-pre-wrap selection:bg-amber-100" x-text="advice"></div>
            </div>
        </div>
    </div>
</div>

<script>
function konsultasiHandler() {
    return {
        masalah: '',
        advice: '',
        loading: false,

        async solveProblem() {
            if (this.masalah.length < 10) return;
            
            this.loading = true;
            this.advice = '';

            try {
                const response = await fetch('{{ route('konsultasi.solve') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ masalah: this.masalah })
                });

                const data = await response.json();
                if (data.success) {
                    this.advice = data.advice;
                }
            } catch (error) {
                alert('Gagal mendapatkan bimbingan.');
            } finally {
                this.loading = false;
                lucide.createIcons();
            }
        },

        copyAdvice() {
            navigator.clipboard.writeText(this.advice).then(() => alert('Bimbingan disalin! Simpan di tempat yang aman.'));
        }
    }
}
</script>
@endsection
