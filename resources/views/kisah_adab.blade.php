@extends('layouts.admin')

@section('header', 'Kisah Adab Islami')

@section('content')
<div x-data="kisahHandler()" class="max-w-5xl mx-auto space-y-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-emerald-600 to-teal-800 rounded-[2.5rem] p-8 md:p-12 text-white relative overflow-hidden shadow-2xl">
        <div class="relative z-10 max-w-2xl space-y-4">
            <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight">Menanamkan Adab <span class="text-emerald-200">Lewat Kisah</span></h2>
            <p class="text-emerald-50/80 text-lg">Hasilkan cerita islami yang penuh hikmah dan nilai-nilai akhlak mulia dalam hitungan detik untuk anak maupun dewasa.</p>
        </div>
        <div class="absolute right-0 top-0 -mr-16 -mt-16 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <i data-lucide="book-open" class="absolute right-12 bottom-12 w-32 h-32 text-white/5 rotate-6"></i>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Input Section (4 cols) -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6 space-y-6">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-2 uppercase tracking-widest">Tema / Pesan Moral</label>
                        <select x-model="tema" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm text-slate-700 font-medium appearance-none">
                            <option>Kejujuran (Sidiq)</option>
                            <option>Kesabaran (Sabar)</option>
                            <option>Berbakti Orang Tua (Birrul Walidain)</option>
                            <option>Adab Berteman</option>
                            <option>Adab Makan & Minum</option>
                            <option>Kedermawanan (Sakhawat)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-2 uppercase tracking-widest">Tokoh Utama (Opsional)</label>
                        <input type="text" x-model="tokoh" placeholder="Contoh: Ahmad, Aisyah, atau Sahabat" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm text-slate-700 font-medium">
                    </div>
                </div>

                <button @click="generateKisah()" 
                        :disabled="loading"
                        class="w-full py-4 bg-emerald-600 text-white font-bold rounded-2xl hover:bg-emerald-700 transition-all flex items-center justify-center gap-3 shadow-lg shadow-emerald-100 active:scale-[0.98] disabled:opacity-50">
                    <template x-if="!loading">
                        <span class="flex items-center gap-2">✨ Rangkai Kisah</span>
                    </template>
                    <template x-if="loading">
                        <div class="flex items-center gap-2">
                            <div class="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                            <span>Menulis...</span>
                        </div>
                    </template>
                </button>
            </div>

            <!-- History Section -->
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-800">Kisah Terakhir</h3>
                    <i data-lucide="history" class="w-4 h-4 text-emerald-400"></i>
                </div>
                <div class="divide-y divide-slate-50">
                    <template x-for="item in history" :key="item.id">
                        <div @click="content = item.content" class="p-4 hover:bg-emerald-50/50 transition-colors cursor-pointer group">
                            <p class="text-xs font-bold text-slate-800 truncate" x-text="item.tema"></p>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase" x-text="item.date"></p>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- content Section (8 cols) -->
        <div class="lg:col-span-8">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm min-h-[500px] flex flex-col relative overflow-hidden">
                <!-- Decor -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full -mr-16 -mt-16"></div>

                <div class="p-10 flex-1 relative z-10">
                    <template x-if="!content && !loading">
                        <div class="h-full flex flex-col items-center justify-center text-center space-y-4 opacity-40 py-20">
                            <i data-lucide="pen-tool" class="w-16 h-16 text-slate-300"></i>
                            <p class="text-slate-800 font-bold text-xl uppercase tracking-[0.2em]">Halaman Cerita</p>
                        </div>
                    </template>

                    <template x-if="loading">
                        <div class="space-y-6 pt-10">
                            <div class="h-4 bg-slate-50 rounded-full w-full animate-pulse"></div>
                            <div class="h-4 bg-slate-50 rounded-full w-5/6 animate-pulse"></div>
                            <div class="h-4 bg-slate-50 rounded-full w-4/6 animate-pulse"></div>
                        </div>
                    </template>

                    <div x-show="content && !loading" x-transition class="prose prose-emerald max-w-none">
                        <div class="text-slate-700 leading-[1.8] text-lg font-medium whitespace-pre-wrap italic decoration-emerald-100 selection:bg-emerald-100" x-text="content"></div>
                    </div>
                </div>

                <div x-show="content && !loading" class="px-10 py-6 border-t border-slate-50 bg-slate-50/30 flex justify-end">
                    <button @click="copyContent()" class="px-6 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all flex items-center gap-2">
                        <i data-lucide="copy" class="w-3.5 h-3.5"></i> Salin Kisah
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function kisahHandler() {
    return {
        tema: 'Kejujuran (Sidiq)',
        tokoh: '',
        content: '',
        loading: false,
        history: [],

        async generateKisah() {
            this.loading = true;
            this.content = '';
            
            try {
                const response = await fetch('{{ route('kisah_adab.generate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ tema: this.tema, tokoh: this.tokoh })
                });

                const data = await response.json();
                if (data.success) {
                    this.content = data.content;
                    this.history.unshift({
                        id: Date.now(),
                        tema: this.tema,
                        content: this.content,
                        date: new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'short' })
                    });
                }
            } catch (error) {
                alert('Gagal menghasilkan kisah.');
            } finally {
                this.loading = false;
                lucide.createIcons();
            }
        },

        copyContent() {
            navigator.clipboard.writeText(this.content).then(() => alert('Teks disalin!'));
        }
    }
}
</script>
@endsection
