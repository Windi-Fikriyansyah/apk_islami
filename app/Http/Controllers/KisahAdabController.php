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
            'childName' => 'required|string',
            'childGender' => 'required|string',
            'childAge' => 'required|integer',
            'tema' => 'required|string',
        ]);

        $apiKey = config('services.openrouter.api_key');
        if (!$apiKey || $apiKey === 'your_api_key_here') {
            return response()->json(['error' => 'API Key OpenRouter belum dikonfigurasi.'], 500);
        }

        $prompt = "Buatkan cerita anak islami 4 halaman tentang {$request->tema}. 
      
      PROFIL TOKOH UTAMA:
      - Nama: {$request->childName}
      - Jenis Kelamin: {$request->childGender}
      - Usia: {$request->childAge} Tahun
      
      INSTRUKSI KHUSUS:
      1. Sesuaikan tingkat bahasa dan alur cerita agar sangat RELATE dan SESUAI untuk anak usia {$request->childAge} tahun.
      2. Jika tokoh {$request->childGender}, pastikan konteks aktivitasnya wajar untuk anak {$request->childGender}.
      3. Tokoh utama harus menjadi teladan dalam cerita ini.
      
      ATURAN PENTING MENGENAI DOA:
      - Jika cerita mengandung adegan berdoa (misal: makan, tidur, masuk masjid, dll), JANGAN HANYA MENULIS \"dia membaca doa\".
      - WAJIB TULISKAN bunyi doanya secara LENGKAP dan BENAR (Latin atau Terjemahan yang indah).
      - Contoh: Jangan tulis \"Andi membaca doa makan\", tapi tulis \"Andi mengangkat tangan dan berdoa, 'Allahumma barik lana fi ma razaqtana wa qina adzaban nar'.\"
      
      ATURAN WAJIB EJAAN ISLAMI (JANGAN TYPO):
      - Gunakan \"Bismillah\" (bukan Bismilah)
      - Gunakan \"Alhamdulillah\" (bukan Alhamdulilah)
      - Gunakan \"Subhanallah\" (bukan Subhanalloh)
      - Gunakan \"Astaghfirullah\" (bukan Astagfirullah)
      - Gunakan \"Insya Allah\" (bukan Insha Allah)
      - Gunakan \"Assalamu'alaikum\" (bukan Assalamualaikum)

      Gunakan bahasa yang lembut, mendidik, dan penuh kasih sayang.
      Kembalikan hanya objek JSON murni: {\"pages\": [{\"text\": \"isi cerita\", \"scenePrompt\": \"cinematic illustration of a child doing [action]\"}]}";

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
                // Clean markdown json formatting if AI wraps it
                $content = preg_replace('/```json\s*/i', '', $content);
                $content = preg_replace('/```\s*$/i', '', $content);
                $content = trim($content);

                return response()->json([
                    'success' => true,
                    'content' => $content,
                ]);
            }
            return response()->json(['error' => 'Gagal generate kisah.'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
