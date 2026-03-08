@extends('layouts.admin')

@section('header', 'Tanya Jawab Islam')

@section('content')
<div x-data="tanyaJawabHandler()" class="max-w-4xl mx-auto space-y-6">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-xl">
        <div class="relative z-10 space-y-2">
            <h2 class="text-2xl font-bold">Konsultasi Syariah AI</h2>
            <p class="text-indigo-100 text-sm max-w-lg">Dapatkan jawaban atas pertanyaan Islam Anda berdasarkan Al-Quran, Hadits, dan penjelasan Ulama muktabar secara instan.</p>
        </div>
        <div class="absolute right-0 top-0 -mr-12 -mt-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        <i data-lucide="help-circle" class="absolute right-8 bottom-8 w-24 h-24 text-white/10 rotate-12"></i>
    </div>

    <!-- Main Q&A Section -->
    <div class="grid grid-cols-1 gap-6">
        <!-- Input Card -->
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600">
                    <i data-lucide="message-square" class="w-5 h-5"></i>
                </div>
                <h3 class="text-base font-bold text-slate-800">Ajukan Pertanyaan</h3>
            </div>
            
            <div class="relative">
                <textarea 
                    x-model="question" 
                    rows="4" 
                    class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition-all text-sm text-slate-700 font-medium resize-none shadow-inner"
                    placeholder="Contoh: Bagaimana cara meningkatkan kekhusyukan dalam shalat menurut Imam Al-Ghazali?"></textarea>
            </div>

            <button @click="askQuestion()" 
                    :disabled="loading || question.length < 10"
                    class="w-full py-4 bg-indigo-600 text-white text-base font-bold rounded-2xl hover:bg-indigo-700 transition-all flex items-center justify-center gap-3 shadow-lg shadow-indigo-100 active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed">
                <template x-if="!loading">
                    <span class="flex items-center gap-2">🚀 Kirim Pertanyaan</span>
                </template>
                <template x-if="loading">
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                        <span>Sedang Menelaah...</span>
                    </div>
                </template>
            </button>
        </div>

        <!-- Answer Section -->
        <div x-show="answer || loading" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden min-h-[200px]">
            
            <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></div>
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Jawaban AI Pakar</h3>
                </div>
                <template x-if="answer && !loading">
                    <button @click="copyAnswer()" class="text-indigo-600 hover:text-indigo-800 text-xs font-bold flex items-center gap-1 group">
                        <i data-lucide="copy" class="w-3.5 h-3.5 transition-transform group-hover:scale-110"></i>
                        Salin Jawaban
                    </button>
                </template>
            </div>

            <div class="p-8">
                <!-- Loading State -->
                <div x-show="loading" class="space-y-4">
                    <div class="h-4 bg-slate-100 rounded-full w-3/4 animate-pulse"></div>
                    <div class="h-4 bg-slate-100 rounded-full w-full animate-pulse"></div>
                    <div class="h-4 bg-slate-100 rounded-full w-5/6 animate-pulse"></div>
                    <div class="h-4 bg-slate-100 rounded-full w-2/3 animate-pulse"></div>
                </div>

                <!-- Content Area -->
                <div x-show="!loading" class="prose prose-indigo max-w-none">
                    <div class="text-slate-700 leading-[1.8] text-[15px] font-medium whitespace-pre-wrap selection:bg-indigo-100" x-text="answer"></div>
                </div>
            </div>
        </div>

        <!-- History / Recent Questions -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-800">Riwayat Pertanyaan</h3>
                <i data-lucide="history" class="w-4 h-4 text-slate-300"></i>
            </div>
            <div class="divide-y divide-slate-50">
                <template x-for="item in history" :key="item.id">
                    <div class="p-4 hover:bg-slate-50 transition-colors cursor-pointer group" @click="answer = item.answer; question = item.question">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                                    <i data-lucide="help-circle" class="w-4 h-4"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-800 truncate max-w-[200px] md:max-w-md" x-text="item.question"></p>
                            </div>
                            <span class="text-[10px] font-bold text-slate-400" x-text="item.date"></span>
                        </div>
                    </div>
                </template>
                <template x-if="history.length === 0">
                    <div class="p-8 text-center opacity-30">
                        <p class="text-xs font-bold">Belum ada riwayat pertanyaan</p>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
function tanyaJawabHandler() {
    return {
        question: '',
        answer: '',
        loading: false,
        history: [],

        async askQuestion() {
            if (this.question.length < 10) return;
            
            this.loading = true;
            this.answer = '';

            try {
                const response = await fetch('{{ route('tanyajawab.ask') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ question: this.question })
                });

                const data = await response.json();

                if (data.success) {
                    this.answer = data.answer;
                    this.history.unshift({
                        id: Date.now(),
                        question: this.question,
                        answer: this.answer,
                        date: new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'short' })
                    });
                } else {
                    alert(data.error || 'Terjadi kesalahan saat memproses pertanyaan.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal terhubung ke server.');
            } finally {
                this.loading = false;
                lucide.createIcons();
            }
        },

        copyAnswer() {
            navigator.clipboard.writeText(this.answer).then(() => {
                alert('Jawaban berhasil disalin!');
            });
        }
    }
}
</script>
@endsection
