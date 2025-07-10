<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Models\Slider;

Route::get('/home', function () {
    // Slider verilerini çek
    $sliders = Slider::orderBy('sira')->get(['gorsel', 'url', 'sira']);
    
    return Inertia::render('Home', [
        'carouselItems' => $sliders
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
