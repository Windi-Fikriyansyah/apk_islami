<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TanyaJawabController extends Controller
{
    public function index()
    {
        return view('tanyajawab');
    }

    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string|min:10',
        ]);

        $apiKey = config('services.openrouter.api_key');
        if (!$apiKey || $apiKey === 'your_api_key_here') {
            return response()->json(['error' => 'API Key OpenRouter belum dikonfigurasi di config/services.php atau .env'], 500);
        }

        $prompt = $this->buildPrompt($request->question);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url'),
                'X-Title' => config('app.name'),
            ])->timeout(60)->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'nvidia/nemotron-3-nano-30b-a3b:free',
                'messages' => [
                    ['role' => 'system', 'content' => 'Anda adalah AI Pakar Fiqh dan Konsultasi Islam yang menjawab berdasarkan Al-Quran, Sunnah, Fatwa MUI, dan pendapat Ulama Muktabar.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.5,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $answer = $result['choices'][0]['message']['content'] ?? 'Maaf, saya tidak dapat memberikan jawaban saat ini.';
                
                // Content cleaning
                $answer = preg_replace('/<thought>.*?<\/thought>/s', '', $answer);
                $answer = preg_replace('/^#+\s+/m', '', $answer);
                $answer = str_replace(['**', '##'], '', $answer);

                return response()->json([
                    'success' => true,
                    'answer' => trim($answer),
                ]);
            }

            return response()->json(['error' => 'Gagal terhubung ke AI: ' . $response->body()], 500);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    private function buildPrompt($question)
    {
        return "Pertanyaan: {$question}

        Berikan jawaban yang bijaksana, akurat, dan mendalam. 
        SYARAT JAWABAN:
        1. Gunakan Bahasa Indonesia yang sopan dan mudah dipahami.
        2. WAJIB sertakan Dalil relevan (Al-Quran/Hadits).
        3. Dalil WAJIB menyertakan Teks Arab yang berharakat lengkap, diikuti terjemahan.
        4. WAJIB sertakan Fatwa MUI (Majelis Ulama Indonesia) yang relevan dengan topik pertanyaan jika tersedia.
        5. Jika ada perbedaan pendapat (khilafiyah), sampaikan secara bijak sesuai Madzhab Syafi'i sebagai referensi utama namun hargai pendapat lain.
        6. Berikan kesimpulan praktis di akhir jawaban.
        7. JANGAN gunakan simbol Markdown seperti # atau **. Gunakan baris baru untuk kerapihan.";
    }
}
