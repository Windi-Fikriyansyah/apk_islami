<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\CeramahController;

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/data-ceramah', [CeramahController::class, 'index'])->name('data.ceramah');
Route::post('/generate-ceramah', [CeramahController::class, 'generate'])->name('ceramah.generate');

use App\Http\Controllers\TanyaJawabController;
Route::get('/tanya-jawab', [TanyaJawabController::class, 'index'])->name('tanyajawab.index');
Route::post('/tanya-jawab/ask', [TanyaJawabController::class, 'ask'])->name('tanyajawab.ask');

use App\Http\Controllers\KisahAdabController;
Route::get('/kisah-adab', [KisahAdabController::class, 'index'])->name('kisah_adab.index');
Route::post('/kisah-adab/generate', [KisahAdabController::class, 'generate'])->name('kisah_adab.generate');

use App\Http\Controllers\KonsultasiController;
Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi.index');
Route::post('/konsultasi/solve', [KonsultasiController::class, 'solve'])->name('konsultasi.solve');

use App\Http\Controllers\AudioQuranController;
Route::get('/audio-quran', [AudioQuranController::class, 'index'])->name('audio_quran.index');

use App\Http\Controllers\PerpustakaanController;
Route::get('/perpustakaan', [PerpustakaanController::class, 'index'])->name('perpustakaan.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
