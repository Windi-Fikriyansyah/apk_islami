<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['TRIPAY_API_KEY'] ?? null;
$env = $_ENV['TRIPAY_ENVIRONMENT'] ?? 'sandbox';
$envSuffix = $env === 'production' ? 'api' : 'api-sandbox';

echo "Using API Key: $apiKey\n";
echo "Environment: $env ($envSuffix)\n";

$url = "https://tripay.co.id/{$envSuffix}/merchant/payment-channel";
echo "Fetching from: $url\n";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . str_replace('"', '', $apiKey)
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

echo "HTTP Code: $httpCode\n";
echo "Response: $response\n";
