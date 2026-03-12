@extends('layouts.admin')

@section('header', 'Buat Materi Dakwah')

@section('content')
<div x-data="{ 
    loading: false, 
    generated: false,
    content: '',
    title: '',
    formData: {
        jenis_konten: 'Khutbah Jumat',
        tema: 'sabar dalam menghadapi cobaan',
        detail: '',
        madzhab: 'Syafi\'i',
        gaya: 'Formal',
        audiens: 'Umum (Jamaah Masjid)',
        bahasa: 'ID Bahasa Indonesia',
        panjang: 'Sedang',
        dalil_type: 'Quran & Hadits'
    },
    history: [
        { id: 1, title: 'Menjaga Lisan dalam Islam', type: 'Khutbah Jumat', date: '08 Mar 2026' }
    ],
    async generateContent() {
        this.loading = true;
        this.generated = false;
        
        try {
            const response = await fetch('{{ route('ceramah.generate') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    ...this.formData,
                    dalil: this.formData.dalil_type !== 'Minimal'
                })
            });
            
            const data = await response.json();
            
            if (data.error) {
                alert(data.error);
            } else {
                this.content = data.content;
                this.title = data.title;
                this.generated = true;
                
                this.history.unshift({
                    id: Date.now(),
                    title: this.title,
                    type: this.formData.jenis_konten,
                    date: new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' })
                });
            }
        } catch (error) {
            alert('Gagal Generate: ' + error.message);
        } finally {
            this.loading = false;
        }
    }
}" class="space-y-8">
    
    <div class="grid lg:grid-cols-2 gap-8 items-start">
        
        <!-- Input Section -->
        <div class="space-y-6">
            
            <!-- Jenis Konten Card -->
            <div class="bg-white rounded-[1.5rem] border border-slate-100 shadow-sm p-6 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600">
                        <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 tracking-tight">Jenis Konten Dakwah</h3>
                </div>
                
                <div class="relative">
                    <select x-model="formData.jenis_konten" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all appearance-none text-sm text-slate-700 font-medium">
                        <option>🕌 Khutbah Jumat</option>
                        <option>🌙 Khutbah Idul Fitri</option>
                        <option>🐫 Khutbah Idul Adha</option>
                        <option>💍 Khutbah Nikah</option>
                        <option>🎤 Ceramah/Tausiyah</option>
                        <option>⏱️ Kultum (7 Menit)</option>
                        <option>🌙 Ceramah Ramadan</option>
                        <option>🎗️ Ceramah Tahlilan</option>
                        <option>📝 Artikel Islami</option>
                        <option>📱 Caption Sosial Media</option>
                        <option>🎬 Script Video Dakwah</option>
                        <option>🤲 Doa & Dzikir</option>
                    </select>
                </div>
            </div>

            <!-- Tema & Detail Card -->
            <div class="bg-white rounded-[1.5rem] border border-slate-100 shadow-sm p-6 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                        <i data-lucide="lightbulb" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 tracking-tight">Tema & Detail</h3>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-2">Topik/Tema Utama *</label>
                        <input type="text" x-model="formData.tema" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all text-sm text-slate-700 font-medium" placeholder="Masukkan tema utama...">
                    </div>
                    
                   

                    <div class="pt-2">
                        <label class="block text-xs font-bold text-slate-800 mb-2">Detail Tambahan (Opsional)</label>
                        <textarea x-model="formData.detail" rows="3" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all text-sm text-slate-700 font-medium resize-none" placeholder="Tambahkan konteks, poin yang ingin dibahas, atau instruksi khusus..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Pengaturan Card -->
            <div class="bg-white rounded-[1.5rem] border border-slate-100 shadow-sm p-6 space-y-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-400">
                        <i data-lucide="settings" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800 tracking-tight">Pengaturan</h3>
                </div>

                <div class="space-y-6">
                    <!-- Madzhab -->
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-2">Madzhab Rujukan</label>
                        <select x-model="formData.madzhab" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all appearance-none text-sm text-slate-700 font-medium">
                            <option>Syafi'i</option>
                            <option>Hanafi</option>
                            <option>Maliki</option>
                            <option>Hambali</option>
                            <option>Ahlus Sunnah (Umum)</option>
                        </select>
                    </div>

                    <!-- Gaya Bahasa -->
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-3">Gaya Bahasa</label>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="style in ['Formal', 'Semi Formal', 'Santai', 'Akademis', '🔥 Motivatif', '🤩 Humor & Pantun', '📖 Naratif/Kisah', '🤲 Spiritualis']">
                                <button type="button" 
                                    @click="formData.gaya = style"
                                    :class="formData.gaya === style ? 'bg-teal-700 text-white border-teal-700' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50'"
                                    class="px-4 py-2 rounded-full border text-[11px] font-bold transition-all"
                                    x-text="style">
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Target Audiens -->
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-2">Target Audiens</label>
                        <select x-model="formData.audiens" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all appearance-none text-sm text-slate-700 font-medium">
                            <option>Umum (Jamaah Masjid)</option>
                            <option>Remaja/Pemuda</option>
                            <option>Ibu-ibu/Majelis Taklim</option>
                            <option>Profesional/Kantoran</option>
                            <option>Akademisi/Mahasiswa</option>
                            <option>Anak-anak</option>
                        </select>
                    </div>

                    <!-- Bahasa Output -->
                    <div>
                        <label class="block items-center gap-2 text-xs font-bold text-slate-800 mb-2">
                            <span class="inline-flex items-center justify-center w-4 h-4 bg-blue-50 text-blue-500 rounded-full text-[9px] mr-1">🌐</span> Bahasa Output
                        </label>
                        <select x-model="formData.bahasa" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all appearance-none text-sm text-slate-700 font-medium">
                            <option>ID Bahasa Indonesia</option>
                            <option>AR Bahasa Arab</option>
                            <option>EN Bahasa Inggris</option>
                        </select>
                    </div>

                    <!-- Panjang Konten -->
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-2">Panjang Konten</label>
                        <select x-model="formData.panjang" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent outline-none transition-all appearance-none text-sm text-slate-700 font-medium">
                            <option>Sangat Pendek</option>
                            <option>Pendek</option>
                            <option>Sedang</option>
                            <option>Panjang</option>
                            <option>Sangat Panjang</option>
                        </select>
                    </div>

                    <!-- Sertakan Dalil -->
                    <div>
                        <label class="block text-xs font-bold text-slate-800 mb-3">Sertakan Dalil</label>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="d in ['Quran & Hadits', 'Quran Saja', 'Hadits Saja', 'Minimal']">
                                <button type="button" 
                                    @click="formData.dalil_type = d"
                                    :class="formData.dalil_type === d ? 'bg-teal-700 text-white border-teal-700' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50'"
                                    class="px-4 py-2 rounded-full border text-[11px] font-bold transition-all"
                                    x-text="d">
                                </button>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Generate Button -->
            <button @click="generateContent()" 
                    :disabled="loading"
                    class="w-full py-4 bg-teal-600 text-white text-base font-bold rounded-2xl hover:bg-teal-700 transition-all flex items-center justify-center gap-3 shadow-lg shadow-teal-100 active:scale-[0.98] disabled:opacity-70">
                <template x-if="!loading">
                    <span class="flex items-center gap-2">✨ Generate Konten</span>
                </template>
                <template x-if="loading">
                    <div class="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                </template>
            </button>

            
            
        </div>

        <!-- Preview Section -->
        <div class="sticky top-8 space-y-6">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-2xl min-h-[850px] flex flex-col overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-50 bg-white flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-2.5 h-2.5 bg-rose-500 rounded-full animate-pulse"></div>
                        <span class="text-xs font-black text-slate-800 uppercase tracking-[0.2em]">Live Preview</span>
                    </div>
                    <div x-show="generated" class="flex items-center gap-3">
                        <button class="p-2.5 text-slate-400 hover:text-teal-600 hover:bg-teal-50 rounded-xl transition-all" title="Salin Teks">
                            <i data-lucide="copy" class="w-5 h-5"></i>
                        </button>
                        <button class="p-2.5 text-slate-400 hover:text-teal-600 hover:bg-teal-50 rounded-xl transition-all" title="Unduh PDF">
                            <i data-lucide="download" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <div class="flex-1 p-8 overflow-y-auto bg-slate-50/20">
                    <!-- State: Empty -->
                    <div x-show="!loading && !generated" class="h-full flex flex-col items-center justify-center text-center space-y-4 opacity-40">
                        <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-slate-300">
                            <i data-lucide="eye-off" class="w-8 h-8"></i>
                        </div>
                        <p class="text-slate-800 font-bold text-lg">Preview Konten</p>
                    </div>

                    <!-- State: Loading -->
                    <div x-show="loading" class="h-full flex flex-col items-center justify-center space-y-6">
                        <div class="relative w-20 h-20">
                            <div class="absolute inset-0 border-4 border-teal-50 rounded-full blur-[2px]"></div>
                            <div class="absolute inset-0 border-4 border-teal-600 rounded-full border-t-transparent animate-spin"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <i data-lucide="bot" class="w-8 h-8 text-teal-600"></i>
                            </div>
                        </div>
                        <p class="text-slate-800 font-bold animate-pulse">AI sedang merangkai konten...</p>
                    </div>

                    <!-- State: Generated -->
                    <div x-show="generated" x-transition class="prose prose-teal max-w-none">
                        <div class="mb-6 pb-6 border-b border-slate-100">
                            <h2 class="text-xl font-bold text-slate-900 leading-tight mb-2" x-text="title"></h2>
                            <div class="flex gap-2">
                                <span class="text-[9px] font-bold text-teal-700 bg-teal-50 px-2 py-1 rounded-full uppercase tracking-wider" x-text="formData.jenis_konten"></span>
                                <span class="text-[9px] font-bold text-purple-700 bg-purple-50 px-2 py-1 rounded-full uppercase tracking-wider" x-text="formData.gaya"></span>
                            </div>
                        </div>
                        <div class="text-slate-700 leading-[1.7] text-[13px] font-medium whitespace-pre-wrap selection:bg-teal-100" x-text="content"></div>
                    </div>
                </div>
            </div>
            
            <!-- History Card -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-50 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-800">Riwayat</h3>
                    <div class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-[9px] font-bold text-slate-400" x-text="history.length"></div>
                </div>
                <div class="divide-y divide-slate-50 max-h-[250px] overflow-y-auto">
                    <template x-for="item in history" :key="item.id">
                        <div class="p-4 hover:bg-slate-50 transition-colors cursor-pointer group">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <i data-lucide="file-text" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800 group-hover:text-teal-700 transition-colors" x-text="item.title"></p>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-wider mt-1"><span x-text="item.type"></span> • <span x-text="item.date"></span></p>
                                    </div>
                                </div>
                                <i data-lucide="chevron-right" class="w-3 h-3 text-slate-300 group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    /* Styling for selects and ranges */
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 1.5rem center;
        background-repeat: no-repeat;
        background-size: 1.25em 1.25em;
    }
    
    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 24px;
        width: 24px;
        border-radius: 50%;
        background: #0f766e;
        cursor: pointer;
        border: 4px solid white;
        box-shadow: 0 4px 10px rgba(15, 118, 110, 0.3);
    }
</style>
@endsection
