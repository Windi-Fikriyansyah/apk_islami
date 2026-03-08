<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KisahAdabController extends Controller
{
    public function index()
    {
        return view('kisah_adab');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'tokoh' => 'nullable|string',
            'tema' => 'required|string',
        ]);

        $apiKey = config('services.openrouter.api_key');
        if (!$apiKey || $apiKey === 'your_api_key_here') {
            return response()->json(['error' => 'API Key OpenRouter belum dikonfigurasi.'], 500);
        }

        $prompt = "Buatlah sebuah kisah inspiratif tentang Adab Islami.
        Tokoh utama: " . ($request->tokoh ?: 'Seorang anak shaleh / Sahabat Nabi') . "
        Tema/Pesan Moral: {$request->tema}
        
        SYARAT KONTEN:
        1. Gunakan bahasa naratif yang indah, menyentuh hati, dan mudah dipahami anak-anak maupun dewasa.
        2. Sertakan dalil (Al-Quran/Hadits) yang relevan dengan Teks Arab berharakat dan terjemahannya.
        3. Tampilkan hikmah atau poin-poin adab yang bisa dipelajari di akhir cerita.
        4. JANGAN gunakan simbol Markdown seperti # atau **. Gunakan baris baru untuk kerapihan.";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url'),
                'X-Title' => config('app.name'),
            ])->timeout(60)->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'nvidia/nemotron-3-nano-30b-a3b:free',
                'messages' => [
                    ['role' => 'system', 'content' => 'Anda adalah penulis kisah islami yang mahir merangkai cerita penuh hikmah dan adab.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.8,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $content = $result['choices'][0]['message']['content'] ?? '';
                
                $content = preg_replace('/<thought>.*?<\/thought>/s', '', $content);
                $content = preg_replace('/^#+\s+/m', '', $content);
                $content = str_replace(['**', '##'], '', $content);

                return response()->json([
                    'success' => true,
                    'content' => trim($content),
                ]);
            }
            return response()->json(['error' => 'Gagal generate kisah.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
