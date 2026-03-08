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

        $apiKey = env('OPENROUTER_API_KEY');
        if (!$apiKey || $apiKey === 'your_api_key_here') {
            return response()->json(['error' => 'API Key OpenRouter belum dikonfigurasi di .env'], 500);
        }

        $prompt = $this->buildPrompt($request->all());

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url'),
                'X-Title' => config('app.name'),
            ])->timeout(60)->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'arcee-ai/trinity-large-preview:free',
                'messages' => [
                    ['role' => 'system', 'content' => 'Anda adalah pakar pembuat konten dakwah Islam yang kompeten, bijaksana, dan memiliki kedalaman ilmu agama.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                return response()->json([
                    'content' => $result['choices'][0]['message']['content'] ?? 'Gagal menghasilkan konten.',
                    'title' => $request->tema
                ]);
            }

            return response()->json(['error' => 'Gagal terhubung ke AI: ' . $response->body()], 500);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    private function buildPrompt($data)
    {
        $jenis = $data['jenis_konten'];
        $tema = $data['tema'];
        $detail = $data['detail'] ?? 'Tidak ada detail tambahan';
        $madzhab = $data['madzhab'] ?? 'Umum';
        $gaya = $data['gaya'] ?? 'Formal';
        $audiens = $data['audiens'] ?? 'Umum';
        $bahasa = $data['bahasa'] ?? 'Bahasa Indonesia';
        $panjang = $data['panjang'] ?? 'Standar';
        $dalil = isset($data['dalil']) && $data['dalil'] ? 'Sertakan ayat Al-Qur\'an dan Hadist yang relevan (lengkap dengan teks Arab dan artinya)' : 'Tanpa menyertakan teks dalil secara eksplisit';

        return "Buatlah konten dakwah dengan spesifikasi sebagai berikut:
- Jenis Konten: $jenis
- Judul/Tema Utama: $tema
- Detail/Pesan Khusus: $detail
- Rujukan Madzhab: $madzhab
- Gaya Bahasa: $gaya
- Target Audiens: $audiens
- Bahasa Output: $bahasa
- Panjang Konten: $panjang
- Kelengkapan Dalil: $dalil

Struktur Konten:
1. Pembukaan (Muqaddimah) yang sesuai.
2. Isi Konten yang terstruktur rapi.
3. Dalil yang relevan (jika diminta).
4. Penutup dan Kesimpulan.

Gunakan format markdown yang menarik untuk output.";
    }
}
