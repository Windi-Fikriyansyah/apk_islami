<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // Step 1: Detail Pembeli
    public function detail(Request $request)
    {
        $plan = $request->query('plan');
        $amount = $plan === 'premium' ? 150000 : 99000;
        $plan_name = $plan === 'premium' ? 'PAKET PREMIUM' : 'PAKET STANDAR';

        return view('checkout_detail', compact('plan', 'amount', 'plan_name'));
    }

    // Step 2: Pilih Metode Pembayaran
    public function methods(Request $request)
    {
        $request->validate([
            'plan' => 'required',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        $amount = $request->plan === 'premium' ? 150000 : 99000;
        $plan_name = $request->plan === 'premium' ? 'PAKET PREMIUM' : 'PAKET STANDAR';

        // Get Tripay Channels (Using Tripay Sandbox/Production)
        $apiKey = config('services.tripay.api_key');
        $environment = config('services.tripay.environment');
        $envSuffix = $environment === 'production' ? 'api' : 'api-sandbox';
        
        $channels = [];
        if ($apiKey) {
            try {
                $response = Http::withToken($apiKey)->get("https://tripay.co.id/{$envSuffix}/merchant/payment-channel");
                if ($response->successful() && $response->json('success')) {
                    $channels = $response->json('data');
                } else {
                    \Log::error('Tripay API Error (Channels): ' . $response->body());
                }
            } catch (\Exception $e) {
                \Log::error('Tripay Connection Exception: ' . $e->getMessage());
            }
        } else {
            \Log::warning('Tripay API Key is missing in configuration.');
        }

        return view('checkout_payment', [
            'plan' => $request->plan,
            'plan_name' => $plan_name,
            'amount' => $amount,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'channels' => $channels
        ]);
    }

    // Step 3: Proses Pembayaran (Create Transaction to Tripay)
    public function process(Request $request)
    {
        $request->validate([
            'plan' => 'required',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'method' => 'required|string',
        ]);

        $amount = $request->plan === 'premium' ? 150000 : 99000;
        $plan_name = $request->plan === 'premium' ? 'PAKET PREMIUM' : 'PAKET STANDAR';

        $merchantCode = config('services.tripay.merchant_code');
        $apiKey = config('services.tripay.api_key');
        $privateKey = config('services.tripay.private_key');
        $environment = config('services.tripay.environment');
        $merchantRef = 'INV-' . time();

        $data = [
            'method'         => $request->method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'order_items'    => [
                [
                    'sku'      => $request->plan,
                    'name'     => $plan_name,
                    'price'    => $amount,
                    'quantity' => 1
                ]
            ],
            'return_url'   => url('/'),
            'expired_time' => (time() + (24 * 60 * 60)), // 24 hours
            'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
        ];

        $envSuffix = $environment === 'production' ? 'api' : 'api-sandbox';
        $response = Http::withToken($apiKey)->post("https://tripay.co.id/{$envSuffix}/transaction/create", $data);

        if ($response->successful() && $response->json('success')) {
            $tripayData = $response->json('data');

            // Save transaction to local DB
            $transaction = new Transaction();
            $transaction->reference = $tripayData['reference'];
            $transaction->merchant_ref = $merchantRef;
            $transaction->customer_name = $request->customer_name;
            $transaction->customer_email = $request->customer_email;
            $transaction->customer_phone = $request->customer_phone;
            $transaction->plan_name = $plan_name;
            $transaction->amount = $amount;
            $transaction->payment_method = $request->method;
            $transaction->status = 'UNPAID';
            $transaction->checkout_url = $tripayData['checkout_url'];
            $transaction->save();

            return redirect($tripayData['checkout_url']);
        }

        return back()->with('error', 'Gagal membuat transaksi Tripay. Pastikan konfigurasi API sudah benar.');
    }

    // Webhook from Tripay
    public function webhook(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, config('services.tripay.private_key'));

        if ($signature !== (string) $callbackSignature) {
            return response()->json(['success' => false, 'message' => 'Invalid signature'], 400);
        }

        if ('payment_status' !== $request->server('HTTP_X_CALLBACK_EVENT')) {
            return response()->json(['success' => false, 'message' => 'Unrecognized event'], 400);
        }

        $data = json_decode($json);

        if (is_array($data) && array_key_exists('status', $data) === false) {
            $data = $data[0] ?? null;
        }

        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Bad request Data'], 400);
        }

        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);

        $transaction = Transaction::where('reference', $tripayReference)->first();

        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
        }

        if ($transaction->status == 'PAID') {
            return response()->json(['success' => true, 'message' => 'Already paid']);
        }

        $transaction->status = $status;
        $transaction->save();

        if ($status === 'PAID') {
            // 1. Create User
            $passwordStr = Str::random(8);
            
            // Cek apakah email sudah ada, jika sudah, kita cukup update/beritahu passwordnya
            $user = User::where('email', $transaction->customer_email)->first();
            if(! $user) {
                $user = new User();
                $user->name = $transaction->customer_name;
                $user->email = $transaction->customer_email;
                $user->password = Hash::make($passwordStr);
                // Assign role or status to indicate premium forever if needed, for instance, adding 'role' logic
                $user->save();
            } else {
                $user->password = Hash::make($passwordStr);
                $user->save();
            }

            // 2. Send WA using Fonnte
            $this->sendWhatsappViaFonnte($transaction->customer_phone, $transaction->customer_name, $transaction->customer_email, $passwordStr, $transaction->plan_name);
        }

        return response()->json(['success' => true]);
    }

    private function sendWhatsappViaFonnte($phone, $name, $email, $password, $plan)
    {
        $fonnteToken = config('services.fonnte.api_key');
        if (!$fonnteToken) return;

        $message = "Halo $name! 🎉\n\nTerima kasih telah melakukan pembayaran untuk $plan.\nSekarang Anda memiliki akses SELAMANYA ke Islamic Masterpiece.\n\nBerikut adalah detail akses Anda:\n📧 Email: $email\n🔑 Password: $password\n\nSilakan login dan nikmati seluruh fiturnya. Raih pahala dan ilmu tanpa batas!\n\nSalam,\nTim Islamic Masterpiece";

        Http::withHeaders([
            'Authorization' => $fonnteToken
        ])->post('https://api.fonnte.com/send', [
            'target' => $phone,
            'message' => $message,
            'countryCode' => '62'
        ]);
    }
}
