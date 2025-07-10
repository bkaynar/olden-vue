<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $carouselItems = Slider::orderBy('sira')->get(['gorsel', 'url', 'sira'])->map(function ($item) {
            return [
                'image' => $item->gorsel,
                'url' => $item->url,
                'title' => '',
                'amount' => '',
                'currency' => '',
                'subtitle' => '',
                'buttonText' => '',
                'gradient' => ''
            ];
        });
        return Inertia::render('Home', [
            'carouselItems' => $carouselItems,
        ]);
    }
}
