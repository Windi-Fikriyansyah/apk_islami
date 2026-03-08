<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CeramahController extends Controller
{
    public function index()
    {
        return view('ceramahs');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'jenis_konten' => 'required',
            'tema' => 'required',
        ]);

        $apiKey = config('services.openrouter.api_key');
        if (!$apiKey || $apiKey === 'your_api_key_here') {
            return response()->json(['error' => 'API Key OpenRouter belum dikonfigurasi di config/services.php atau .env'], 500);
        }

        $prompt = $this->buildPrompt($request->all());

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url'),
                'X-Title' => config('app.name'),
            ])->timeout(60)->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'nvidia/nemotron-3-nano-30b-a3b:free',
                'messages' => [
                    ['role' => 'system', 'content' => 'Anda adalah pakar pembuat konten dakwah Islam yang kompeten, bijaksana, dan memiliki kedalaman ilmu agama.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $fullContent = $result['choices'][0]['message']['content'] ?? '';
                
                // Clean up thinking process tags if present (common in thinking models)
                $fullContent = preg_replace('/<thought>.*?<\/thought>/s', '', $fullContent);
                
                // Misalkan baris pertama adalah judul
                $lines = explode("\n", ltrim($fullContent));
                $title = array_shift($lines);
                
                // Bersihkan markdown dari judul
                $title = trim(str_replace(['#', '*', '_'], '', $title));
                
                // Gabungkan sisa konten dan bersihkan simbol heading (##)
                $content = implode("\n", $lines);
                $content = preg_replace('/^#+\s+/m', '', $content); // Hapus # di awal baris
                $content = str_replace(['**', '##'], '', $content); // Hapus bold dan simbol h2

                return response()->json([
                    'success' => true,
                    'title' => $title,
                    'content' => trim($content),
                ]);
            }

            return response()->json(['error' => 'Gagal terhubung ke AI: ' . $response->body()], 500);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    private function buildPrompt($data)
    {
        $dalilInstruction = "";
        if (($data['dalil_type'] ?? 'Minimal') !== 'Minimal') {
            $dalilInstruction = "Sertakan dalil dari {$data['dalil_type']}. WAJIB menyertakan Teks Arab asli yang berharakat, diikuti dengan terjemahan dan penjelasan singkatnya.";
        }

        return "Buatlah konten {$data['jenis_konten']} yang sangat berkualitas dengan detail sebagai berikut:

        1. TOPIK UTAMA: {$data['tema']}
        2. DETAIL TAMBAHAN: " . ($data['detail'] ?? 'Sesuaikan dengan topik utama secara bijaksana.') . "
        3. GAYA BAHASA: " . ($data['gaya'] ?? 'Formal') . "
        4. TARGET AUDIENS: " . ($data['audiens'] ?? 'Umum') . "
        5. MADZHAB RUJUKAN: " . ($data['madzhab'] ?? 'Syafi\'i') . "
        6. BAHASA OUTPUT: " . ($data['bahasa'] ?? 'ID Bahasa Indonesia') . "
        7. ESTIMASI PANJANG: " . ($data['panjang'] ?? 'Sedang') . "

        STRUKTUR KONTEN:
        - Baris Pertama: Tulis Judul yang menarik tanpa simbol Markdown (Tanpa # atau *).
        - Pembukaan: Salam dan muqaddimah singkat (Gunakan teks Arab untuk salam/hamdalah jika sesuai).
        - Isi: Sampaikan poin-poin utama dengan mendalam, menyentuh hati, dan edukatif.
        - DALIL: {$dalilInstruction}
        - Penutup: Kesimpulan, doa singkat (Teks Arab + Terjemahan), dan salam penutup.

        INSTRUKSI KHUSUS:
        - Jangan gunakan simbol Markdown seperti # atau ## atau **. Gunakan spasi atau baris baru untuk pemisahan bagian.
        - Fokus pada kedalaman materi dan keakuratan sesuai Madzhab " . ($data['madzhab'] ?? 'Syafi\'i') . ".
        - Pastikan Teks Arab ditulis dengan benar dan berharakat lengkap.";
    }
}
