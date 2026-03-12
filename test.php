<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['OPENROUTER_API_KEY'] ?? null;
if (!$apiKey) {
    echo "No API Key found\n";
    exit(1);
}

$ch = curl_init('https://openrouter.ai/api/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'model' => 'nvidia/llama-nemotron-embed-vl-1b-v2:free',
    'messages' => [
        ['role' => 'user', 'content' => 'draw a cute cat']
    ]
]));

$response = curl_exec($ch);
echo "Response:\n$response\n";
