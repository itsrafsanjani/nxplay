<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['videos'] = Video::paginate(18);
        $data['newVideos'] = Video::where('status', 1)->latest()->take(5)->get();
        return view('frontend.frontend', $data);
//        return $data;
    }
}
