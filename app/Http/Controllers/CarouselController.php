<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Slider;

class CarouselController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sira')->get(['gorsel', 'url', 'sira']);
        return response()->json($sliders);
    }
}
