<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShowChannelController;
use App\Http\Controllers\TrendingController;
use App\Livewire\Channel;
use App\Livewire\UploadVideo;
use App\Livewire\VideoPage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
