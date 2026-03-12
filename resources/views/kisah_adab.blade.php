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
                            <option value="Lainnya">Tema Lainnya...</option>
                        </select>
                    </div>

                    <div x-show="tema === 'Lainnya'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                        <label class="block text-[10px] font-bold text-emerald-600 mb-2 uppercase tracking-widest">Ketik Tema Anda</label>
                        <input type="text" x-model="temaLainnya" placeholder="Masukan tema custom..." class="w-full px-4 py-3 bg-emerald-50/50 border border-emerald-100 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition-all text-sm text-slate-700 font-medium shadow-inner">
                    </div>

                    <div class="pt-4 pb-2">
                        <hr class="border-slate-100">
                    </div>

                    <!-- Upload Foto Area -->
                    <div class="flex flex-col items-center pt-2">
                        <label for="foto-upload" class="cursor-pointer group">
                            <div class="w-32 h-32 rounded-[2.5rem] border-[3px] border-dashed border-slate-200 flex flex-col items-center justify-center bg-transparent group-hover:bg-slate-50 transition-all overflow-hidden relative" :class="{'border-emerald-500 border-solid': fotoPreview}">
                                <template x-if="fotoPreview">
                                    <img :src="fotoPreview" class="w-full h-full object-cover relative z-10">
                                </template>
                                <template x-if="!fotoPreview">
                                    <div class="flex flex-col items-center gap-2 text-slate-300 group-hover:text-slate-400 transition-colors">
                                        <i data-lucide="camera" class="w-8 h-8"></i>
                                        <span class="text-[10px] font-black uppercase tracking-widest">Pilih Foto</span>
                                    </div>
                                </template>
                            </div>
                            <input id="foto-upload" type="file" accept="image/*" class="hidden" @change="handleFotoUpload">
                        </label>
                        <p class="mt-4 text-[10px] font-bold text-orange-500 uppercase tracking-widest text-center">Pilih foto anak yang wajahnya menghadap ke depan.</p>
                    </div>

                    <!-- Nama Panggilan -->
                    <div>
                        <label class="block text-[11px] font-black text-slate-400 mb-2 uppercase tracking-widest">Nama Panggilan</label>
                        <input type="text" x-model="namaPanggilan" placeholder="Nama si kecil..." class="w-full px-5 py-4 bg-slate-50 border-0 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none transition-all text-sm text-slate-700 font-bold placeholder-slate-400">
                    </div>

                    <!-- Jenis Kelamin & Usia -->
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-[11px] font-black text-slate-400 mb-2 uppercase tracking-widest">Jenis Kelamin</label>
                            <div class="relative">
                                <select x-model="jenisKelamin" class="w-full px-5 py-4 bg-slate-50 border-0 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none transition-all text-sm text-slate-700 font-bold appearance-none">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <label class="block text-[11px] font-black text-slate-400 mb-2 uppercase tracking-widest">Usia</label>
                            <div class="relative">
                                <select x-model="usia" class="w-full px-5 py-4 bg-slate-50 border-0 rounded-2xl focus:ring-2 focus:ring-emerald-500 focus:bg-white outline-none transition-all text-sm text-slate-700 font-bold appearance-none">
                                    <template x-for="i in 15">
                                        <option :value="i + ' Tahun'" x-text="i + ' Tahun'" :selected="i === 5"></option>
                                    </template>
                                </select>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            </div>
                        </div>
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
                        <div @click="content = item.content; pages = item.pages || []" class="p-4 hover:bg-emerald-50/50 transition-colors cursor-pointer group">
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

                    <div x-show="pages.length > 0 && !loading" x-transition class="space-y-8">
                        <template x-for="(page, index) in pages" :key="index">
                            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 shadow-sm relative">
                                <span class="absolute -top-3 -left-3 w-8 h-8 bg-emerald-500 text-white rounded-full flex items-center justify-center font-bold text-sm shadow-md" x-text="index + 1"></span>
                                <div class="prose prose-emerald max-w-none mb-4">
                                    <p class="text-slate-700 leading-[1.8] text-lg font-medium whitespace-pre-wrap italic decoration-emerald-100 selection:bg-emerald-100" x-text="page.text"></p>
                                </div>
                                <div x-show="page.scenePrompt" x-data="{ loaded: false, error: false }" class="mt-4 rounded-2xl overflow-hidden shadow-sm border border-slate-100 bg-slate-100 aspect-video relative group">
                                    <!-- Fallback Loading spinner under the image -->
                                    <div x-show="!loaded && !error" class="absolute inset-0 flex flex-col items-center justify-center bg-slate-50 text-slate-400 gap-3">
                                        <div class="w-8 h-8 border-[3px] border-emerald-500/20 border-t-emerald-500 rounded-full animate-spin"></div>
                                        <span class="text-[10px] uppercase font-bold tracking-widest">Menggambar Ilustrasi...</span>
                                    </div>

                                    <!-- Error State -->
                                    <div x-show="error" class="absolute inset-0 flex flex-col items-center justify-center bg-slate-50 text-red-400 gap-3">
                                        <span class="text-3xl">⚠️</span>
                                        <span class="text-[10px] uppercase font-bold tracking-widest text-red-500">Gagal Memuat Gambar</span>
                                    </div>

                                    <!-- Dynamic Generated Image -->
                                    <img :src="'https://image.pollinations.ai/prompt/' + encodeURIComponent(page.scenePrompt) + '?nologo=true'" 
                                         x-on:load="loaded = true"
                                         x-on:error="error = true"
                                         x-show="loaded"
                                         class="w-full h-full object-cover relative z-10 transition-transform duration-700 group-hover:scale-105" 
                                         :alt="page.scenePrompt" 
                                         loading="lazy">
                                         
                                    <!-- Tooltip / Prompt Overlay -->
                                    <div x-show="loaded" class="absolute bottom-0 left-0 right-0 z-20 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-4 pt-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <p class="text-[11px] text-white/90 font-medium line-clamp-2" x-text="'🎨 ' + page.scenePrompt"></p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-show="content && typeof content === 'string' && pages.length === 0 && !loading" x-transition class="prose prose-emerald max-w-none">
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
        temaLainnya: '',
        foto: null,
        fotoPreview: null,
        namaPanggilan: '',
        jenisKelamin: 'Laki-laki',
        usia: '5 Tahun',
        content: null,
        pages: [],
        loading: false,
        history: [],

        handleFotoUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.foto = file;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.fotoPreview = e.target.result;
                    setTimeout(() => lucide.createIcons(), 50);
                };
                reader.readAsDataURL(file);
            } else {
                this.foto = null;
                this.fotoPreview = null;
                setTimeout(() => lucide.createIcons(), 50);
            }
        },

        async generateKisah() {
            const finalTema = this.tema === 'Lainnya' ? this.temaLainnya : this.tema;
            if (this.tema === 'Lainnya' && !this.temaLainnya) {
                alert('Silakan isi tema terlebih dahulu.');
                return;
            }

            let tokohDesc = '';
            if (this.namaPanggilan) {
                tokohDesc = `${this.namaPanggilan} (Anak ${this.jenisKelamin}, Usia ${this.usia})`;
            } else {
                tokohDesc = `Seorang anak ${this.jenisKelamin} berusia ${this.usia}`;
            }

            this.loading = true;
            this.content = null;
            this.pages = [];
            
            try {
                const response = await fetch('{{ route('kisah_adab.generate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ 
                        tema: finalTema, 
                        childName: this.namaPanggilan || 'Hamba Allah',
                        childGender: this.jenisKelamin,
                        childAge: parseInt(this.usia) || 5
                    })
                });

                const data = await response.json();
                if (data.success) {
                    let parsedContent = data.content;
                    if (typeof data.content === 'string') {
                        try {
                            parsedContent = JSON.parse(data.content);
                        } catch(e) {
                            console.error('Failed to parse JSON content from AI', e);
                        }
                    }
                    
                    if (parsedContent && parsedContent.pages) {
                        this.pages = parsedContent.pages;
                    }
                    
                    this.content = data.content; // Raw JSON or text cache
                    
                    this.history.unshift({
                        id: Date.now(),
                        tema: finalTema,
                        content: this.content,
                        pages: this.pages,
                        date: new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'short' })
                    });
                } else {
                    alert('Gagal menghasilkan kisah: ' + data.error);
                }
            } catch (error) {
                alert('Gagal menghasilkan kisah.');
            } finally {
                this.loading = false;
                lucide.createIcons();
            }
        },

        copyContent() {
            if (this.pages && this.pages.length > 0) {
                const textToCopy = this.pages.map((p, i) => `Halaman ${i+1}:\n${p.text}\nScene: ${p.scenePrompt}\n`).join('\n');
                navigator.clipboard.writeText(textToCopy).then(() => alert('Kisah disalin!'));
            } else {
                navigator.clipboard.writeText(this.content).then(() => alert('Teks disalin!'));
            }
        }
    }
}
</script>
@endsection
