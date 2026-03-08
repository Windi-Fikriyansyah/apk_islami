<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KonsultasiController extends Controller
{
    public function index()
    {
        return view('konsultasi');
    }

    public function solve(Request $request)
    {
        $request->validate([
            'masalah' => 'required|string|min:10',
        ]);

        $apiKey = config('services.openrouter.api_key');
        if (!$apiKey || $apiKey === 'your_api_key_here') {
            return response()->json(['error' => 'API Key OpenRouter belum dikonfigurasi.'], 500);
        }

        $prompt = "Masalah/Curhatan: {$request->masalah}
        
        Berikan bimbingan spiritual (Tazkiyatun Nafs) dan solusi praktis Islami untuk masalah tersebut.
        SYARAT BIMBINGAN:
        1. Gunakan bahasa yang tenang, mendalam, dan empati.
        2. WAJIB sertakan doa khusus dari Al-Quran atau Sunnah dengan Teks Arab berharakat dan terjemahannya.
        3. Sertakan amalan harian yang bisa dilakukan untuk mengatasi masalah tersebut.
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
                    ['role' => 'system', 'content' => 'Anda adalah pembimbing spiritual (spiritual coach) Islami yang bijaksana dan penuh kasih sayang.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.6,
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $content = $result['choices'][0]['message']['content'] ?? 'Maaf, saya tidak dapat memberikan bimbingan saat ini.';
                
                $content = preg_replace('/<thought>.*?<\/thought>/s', '', $content);
                $content = preg_replace('/^#+\s+/m', '', $content);
                $content = str_replace(['**', '##'], '', $content);

                return response()->json([
                    'success' => true,
                    'advice' => trim($content),
                ]);
            }
            return response()->json(['error' => 'Gagal memberikan konsultasi.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
