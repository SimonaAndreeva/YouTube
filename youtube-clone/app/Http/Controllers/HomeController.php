<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $videos = Video::all();

        return view('home',
            [
                'videos' => $videos
            ]
    );
    }
}
