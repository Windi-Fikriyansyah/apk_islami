<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AudioQuranController extends Controller
{
    public function index()
    {
        return view('audio_quran');
    }
}
